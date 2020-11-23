<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?=$title?></title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
    </head>
    <body>
        <div id="header">
            <h1><?=$title?></h1>
        </div>

        <div id="menu">
            <a href="../">Тетрадь общей подготовки к полётам</a> |
            <a href="/training/">Тетрадь подготовки к полётам</a>
        </div>

        <div id="content">
            <?=$content?>
        </div>

        <div id="footer">
            Все права защищены.
        </div>
    </body>

    <script src="js/calendar.js"></script>
    <script src="js/general_training_page.js"></script>
    <script src="js/general_training_print.js"></script>
</html>