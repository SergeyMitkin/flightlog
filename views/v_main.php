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

        <!-- Меню -->
        <div id="menu">
            <a id="menu-general-training-href" href="../">Тетрадь общей подготовки к полётам</a> |
            <a id="menu-training-href" href="/training/">Тетрадь подготовки к полётам</a> |
            <a id="menu-authors-href" href="/authors/">Авторы</a>
        </div>

        <!-- Страницы сайта -->
        <div id="content">
            <?=$content?>
        </div>

        <div id="footer">
            Все права защищены.
        </div>
    </body>

    <script src="js/main.js"></script>
</html>