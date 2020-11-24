<?php
require '../vendor/autoload.php';

function editDocx($file_template, $output_file, $month_year, $general_tasks, $aviation_topics,
                    $aerodynamics_topics){

    $document = new \PhpOffice\PhpWord\TemplateProcessor($file_template);

    //print_r($aviation_topics);
    /*
    if ($general_tasks == null){
        $general_tasks = [
            ['gt' => ' ', 'task-title' => ' ', 'task-description' => ' ', 'task-author' => ' ', 'task-date' => ' ']
        ];
    }
    */

   // if ($aviation_topics == null){
    /*
       $aviation_topics = [
            ['av' => 'kkk', 'av-topic-title' => 'jjj', 'av-topic-description' => 'kkk', 'av-topic-author' => 'kkk', 'av-topic-date' => 'ooo']
       ];
    */
    //}
    //var_dump($aviation_topics);

    $document->setValue('date', $month_year);
    $document->cloneRowAndSetValues('gt', $general_tasks);
    $document->cloneRowAndSetValues('av', $aviation_topics);
    $document->cloneRowAndSetValues('aer', $aerodynamics_topics);

    $document->saveAs($output_file);
    uploadDocx($output_file);
    header("Location: /");

}

// uploadDocx('files/doc.docx');
// Сохраняем файл на сервер
/*
function saveDocx(){
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $phpWord->setDefaultFontName('Times New Roman');
    $phpWord->setDefaultFontSize(14);
    $properties = $phpWord->getDocInfo();
    $properties->setCreator('My name');
    $properties->setCompany('My factory');
    $properties->setTitle('My title');
    $properties->setDescription('My description');
    $properties->setCategory('My category');
    $properties->setLastModifiedBy('My name');
    $properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
    $properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
    $properties->setSubject('My subject');
    $properties->setKeywords('my, key, word');
    $sectionStyle = array();
    $section = $phpWord->addSection($sectionStyle);
    $text = 'ТЕТРАДЬ общей подготовки к полётам 9 /n
    ${var1}';
    $section->addText(htmlspecialchars($text),
        array('size' => 18),
        array('align' => 'center')
    );
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $file = 'files/doc.docx';
    $objWriter->save($file);
    uploadDocx($file);
}
*/

// Скачиваем файл
function uploadDocx($file){

    // Имя скачиваемого файла
    //$file = "files/doc.docx";

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
}