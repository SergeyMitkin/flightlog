<?php
require '../vendor/autoload.php';

saveDocx();
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

    $text = 'ТЕТРАДЬ общей подготовки к полётам 9';
    $section->addText(htmlspecialchars($text),
        array('size' => 18),
        array('align' => 'center', 'spaceBefore' => 6000)
    );

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $file = 'files/doc.docx';

    $objWriter->save($file);
    uploadDocx($file);
}

function uploadDocx($file){

    if (ob_get_length()) ob_end_clean();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="files/doc.docx"');
    header('Content-Transfer-Encoding: binary');
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file->path));
    if ($fd = fopen("files/doc.docx", 'rb')) {
        while (!feof($fd)) {
            print fread($fd, 1024);
        }
        fclose($fd);
    }
    exit;
}
