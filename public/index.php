<?php
require_once('../config/config.php'); // Файл конфигураций
include_once('../controllers/C_Page.php'); // Контроллер страниц

session_start(); // Начинаем сессию

// Получаем страницу из url
$url_array = explode("/", $_SERVER['REQUEST_URI']);

$page_name = $url_array[1];

// Если url пустой, или есть только get-параметры, переходим на главную
if($url_array[1] == "" || substr($url_array[1], 0, 1) == "?"){
    $page_name = "generalTraining";
}

// action для контроллера страниц
$action = 'action_';
$action .= $page_name;

$controller = new C_Page();

$controller->$action(); // Переходим на страницу
$controller->render(); // Метод подстановки переменных в шаблон страницы
