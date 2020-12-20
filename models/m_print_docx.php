<?php
// Подключемся к классам библиотеки PhpWord
require '../vendor/autoload.php';
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\TblWidth;

// Распечатываем документ полёта
function printFlight($file_template, $output_file, $date, $dawn_sunset, $time_start, $time_end,
                     $exercise, $crew, $individual_task, $security_measures, $self_preparation_task, $trainers, $self_preparation){

    // Объект для работы с шаблоном документа
    $document = new \PhpOffice\PhpWord\TemplateProcessor($file_template);

    // Определяем дату и время суток
    $day = explode('-', $date)[2];
    $month = getMonth(explode('-', $date)[1]);
    $year = explode('-', $date)[0];
    $d_s = ($dawn_sunset == 'Рассвет') ? 'РВ' : 'ЗТ';

    // Подставляем переменные в шаблон
    $document->setValue('day', $day);
    $document->setValue('month', $month);
    $document->setValue('year', $year);
    $document->setValue('d_s', $d_s);
    $document->setValue('time_start', $time_start);
    $document->setValue('time_end', $time_end);

    // Создаём таблицу для вывода упражнений
    $table = new Table(array('borderSize' => 6, 'borderColor' => 'green', 'width' => 9000, 'unit' => TblWidth::TWIP));

    // Проверяем на пустоту массив с упражнениями
    if ($exercise == null){
        $exercise = array();
        $exercise[0] = '';
    }

    $ex_array_div = array_chunk($exercise, 6); // Определяем максимум по 6 упражнений в строке
    $str_count = count($ex_array_div); // Определяем количество строк

    // Определяем количество пустых ячеек - вычитаем из максимального количества ячеек, количество элементов последнего массива с упражнениями
    $empty_cells_count = count($ex_array_div[0]) - count($ex_array_div[$str_count-1]);

    // Заполняем ячейки
    for ($i=0; $i<$str_count; $i++){
        // Записываем время упражнений в таблицу
        $table->addRow();
            $table->addCell(300)->addText('Время');
            for ($in=0; $in<count($ex_array_div[$i]); $in++){
                $table->addCell(300)->addText(explode('+php+', $ex_array_div[$i][$in])[1]);
            }
            // Вставляем пустые ячейки, если необходимо
            if ($i == $str_count-1){
                for ($ind=0; $ind<$empty_cells_count; $ind++){
                    $table->addCell(300)->addText(' ');
                }
            }

        // Записываем имена упражнений в таблицу
        $table->addRow();
            $table->addCell(300)->addText('УПР');
            for ($in=0; $in<count($ex_array_div[$i]); $in++){
                $table->addCell(300)->addText(explode('+php+', $ex_array_div[$i][$in])[0]);
            }
            // Вставляем пустые ячейки, если необходимо
            if ($i == $str_count-1){
                for ($ind=0; $ind<$empty_cells_count; $ind++){

                    $table->addCell(300)->addText(' ');
                }
            }
    }
    // Вставляем таблицу в шаблон
    $document->setComplexBlock('table', $table);

    // Вставляем в шаблон список с именами членов экипажа
    $crew_array = getCrew();
    $replacements = array();

    for ($i=0; $i<count($crew); $i++){

        for ($in=0; $in<count($crew_array); $in++){
            if ($crew_array[$in]['id'] == $crew[$i]){
                $replacements[$i]['crew_number'] = $i+1;
                $replacements[$i]['crew_name'] = $crew_array[$in]['name'];
            }
        }
    }

    $document->cloneBlock('crew', 0, true, false, $replacements);

    // Подставляем переменные в шаблон
    $document->setValue('individual_task', $individual_task);
    $document->setValue('security_measures', $security_measures);
    $document->setValue('self_preparation_task', $self_preparation_task);
    $document->setValue('trainers', $trainers);
    $document->setValue('self_preparation', $self_preparation);

    $document->saveAs($output_file); // Сохраняем файл
    uploadDocx($output_file); // Загружаем файл с сайта
    header("Location: /"); // Предотвращаем повторную отправку формы при обновлении страницы
}

function printGTPage($file_template, $output_file, $month_year, $general_tasks, $aviation_topics,
                    $aerodynamics_topics, $navigation_topics, $guidelines_topics, $tactics_topics){

    // Объект для работы с шаблоном документа
    $document = new \PhpOffice\PhpWord\TemplateProcessor($file_template);

    // Проверка на пустоту списков для печати
    if ($general_tasks == null){
        $general_tasks = [
            ['gt' => ' ', 'task-title' => ' ', 'task-description' => ' ', 'task-author' => ' ', 'task-date' => ' ']
        ];
    }

    if ($aviation_topics == null){
        $aviation_topics = [
            ['av' => ' ', 'av-topic-title' => ' ', 'av-topic-description' => ' ', 'av-topic-author' => ' ', 'av-topic-date' => ' ']
        ];
    }

    if ($aerodynamics_topics == null){
        $aerodynamics_topics = [
            ['aer' => ' ', 'aer-topic-title' => ' ', 'aer-topic-description' => ' ', 'aer-topic-author' => ' ', 'aer-topic-date' => ' ']
        ];
    }

    if ($navigation_topics == null){
        $navigation_topics = [
            ['nav' => ' ', 'nav-topic-title' => ' ', 'nav-topic-description' => ' ', 'nav-topic-author' => ' ', 'nav-topic-date' => ' ']
        ];
    }

    if ($guidelines_topics == null){
        $guidelines_topics = [
            ['guide' => ' ', 'guide-topic-title' => ' ', 'guide-topic-description' => ' ', 'guide-topic-author' => ' ', 'guide-topic-date' => ' ']
        ];
    }

    if ($tactics_topics == null){
        $tactics_topics = [
            ['tac' => ' ', 'tac-topic-title' => ' ', 'tac-topic-description' => ' ', 'tac-topic-author' => ' ', 'tac-topic-date' => ' ']
        ];
    }

    // Подставляем переменные в шаблон
    $document->setValue('date', $month_year);
    // Вставляем в шаблон списки с задачими и темами
    $document->cloneRowAndSetValues('gt', $general_tasks);
    $document->cloneRowAndSetValues('av', $aviation_topics);
    $document->cloneRowAndSetValues('aer', $aerodynamics_topics);
    $document->cloneRowAndSetValues('nav', $navigation_topics);
    $document->cloneRowAndSetValues('guide', $guidelines_topics);
    $document->cloneRowAndSetValues('tac', $tactics_topics);

    $document->saveAs($output_file); // Сохраняем файл
    uploadDocx($output_file); // Загружаем файл с сайта
    header("Location: /"); // Предотвращаем повторную отправку формы при обновлении страницы

}

// Загружаем файл с сайта
function uploadDocx($file){

// Контент-тип означающий скачивание
    header("Content-Type: application/octet-stream");

// Размер в байтах
    header("Accept-Ranges: bytes");

// Размер файла
    header("Content-Length: ".filesize($file));

// Расположение скачиваемого файла
    header("Content-Disposition: attachment; filename=".$file);

// Прочитать файл
    readfile($file);
    unlink($file);
}

// Подставляем названия месяцев
function getMonth($month_number){
    switch ($month_number){
        case '01':
            $month = 'января';
            break;
        case '02':
            $month = 'февраля';
            break;
        case '03':
            $month = 'марта';
            break;
        case '04':
            $month = 'апреля';
            break;
        case '05':
            $month = 'мая';
            break;
        case '06':
            $month = 'июня';
            break;
        case '07':
            $month = 'июля';
            break;
        case '08':
            $month = 'августа';
            break;
        case '09':
            $month = 'сентября';
            break;
        case '10':
            $month = 'октября';
            break;
        case '11':
            $month = 'ноября';
            break;
        case '12':
            $month = 'декабря';
            break;
    }
    return $month;
}