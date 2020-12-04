<?php
require '../vendor/autoload.php';

use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

function addTable($file_template, $output_file){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($file_template);

    $table = new Table(array('borderSize' => 12, 'borderColor' => 'green', 'width' => 6000, 'unit' => TblWidth::TWIP));
    $table->addRow();
    $table->addCell(150)->addText('Cell A1');
    $table->addCell(150)->addText('Cell A2');
    $table->addCell(150)->addText('Cell A3');
    $table->addRow();
    $table->addCell(150)->addText('Cell B1');
    $table->addCell(150)->addText('Cell B2');
    $table->addCell(150)->addText('Cell B3');
    $templateProcessor->setComplexBlock('table', $table);

    $templateProcessor->saveAs($output_file);
    uploadDocx($output_file);
    header("Location: /");
}

function printFlight($file_template, $output_file, $date, $dawn_sunset, $time_start, $time_end,
                     $exercise){

    $document = new \PhpOffice\PhpWord\TemplateProcessor($file_template);

    $day = explode('-', $date)[2];
    $month = getMonth(explode('-', $date)[1]);
    $year = explode('-', $date)[0];
    $d_s = ($dawn_sunset == 'Рассвет') ? 'РВ' : 'ЗТ';

    $document->setValue('day', $day);
    $document->setValue('month', $month);
    $document->setValue('year', $year);
    $document->setValue('d_s', $d_s);
    $document->setValue('time_start', $time_start);
    $document->setValue('time_end', $time_end);

    $table = new Table(array('borderSize' => 12, 'borderColor' => 'green', 'width' => 6000, 'unit' => TblWidth::TWIP));


    $ex_array_div = array_chunk($exercise, 6);
    $str_count = count($ex_array_div);

    for ($i=0; $i<$str_count; $i++){
        $table->addRow();
            $table->addCell(150)->addText('Время');
            for ($in=0; $in<count($ex_array_div[$i]); $in++){
                $table->addCell(150)->addText(explode('+php+', $ex_array_div[$i][$in])[1]);
            }

        $table->addRow();
            $table->addCell(150)->addText('УПР');
            for ($in=0; $in<count($ex_array_div[$i]); $in++){
                $table->addCell(150)->addText(explode('+php+', $ex_array_div[$i][$in])[0]);
            }
    }

    $document->setComplexBlock('table', $table);

    $document->saveAs($output_file);
    uploadDocx($output_file);
    header("Location: /");

}

function editDocx($file_template, $output_file, $month_year, $general_tasks, $aviation_topics,
                    $aerodynamics_topics, $navigation_topics, $guidelines_topics, $tactics_topics){

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

    $document->setValue('date', $month_year);
    $document->cloneRowAndSetValues('gt', $general_tasks);
    $document->cloneRowAndSetValues('av', $aviation_topics);
    $document->cloneRowAndSetValues('aer', $aerodynamics_topics);
    $document->cloneRowAndSetValues('nav', $navigation_topics);
    $document->cloneRowAndSetValues('guide', $guidelines_topics);
    $document->cloneRowAndSetValues('tac', $tactics_topics);

    $document->saveAs($output_file);
    uploadDocx($output_file);
    header("Location: /");

}

// Скачиваем файл
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