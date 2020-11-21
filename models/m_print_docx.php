<?php
require '../vendor/autoload.php';

// Сохраняем файл на компьютер
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

    $text = 'ТЕТРАДЬ общей подготовки к полётам';
    $section->addText(htmlspecialchars($text),
        array('size' => 18),
        array('align' => 'center', 'spaceBefore' => 6000)
    );

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $filename = 'files/doc.docx';
    if ($objWriter->save('files/doc.docx')){
        uploadDocx($filename);
    }
}

function uploadDocx($filename){
    echo 'upload';
}
