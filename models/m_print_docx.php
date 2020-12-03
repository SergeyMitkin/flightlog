<?php
require '../vendor/autoload.php';

function printFlight($flight_print, $file_template, $output_file){
    $document = new \PhpOffice\PhpWord\TemplateProcessor($file_template);

    $document->setValue('date', $flight_print);

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