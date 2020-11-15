<?php
require_once('../config/config.php'); // Файл конфигураций
include_once('../controllers/C_Page.php'); // Контроллер страниц

// Получаем страницу из url
$url_array = explode("/", $_SERVER['REQUEST_URI']);
$page_name = $url_array[1];// --- ОТЛАДКА НАЧАЛО

// Если url пустой, переходим на главную
if($url_array[1] == ""){
    $page_name = "generalTraining";
}

// action для контроллера страниц
$action = 'action_';
$action .= $page_name;

$controller = new C_Page();

$controller->$action();
$controller->render();
