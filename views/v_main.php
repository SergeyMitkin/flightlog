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

        <script>
            <?
            // Если пользователь - админ, сохраняем его логин в переменную JS
            if (isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == 'admin'){;?>
            var sessionUserLogin = "admin";
            <?} else { ?>
                var sessionUserLogin = "guest";
            <?}
            ?>
        </script>

        <div id="header">
            <h1>Журнал подготовки к полётам беспилотной авиационной системы</h1>

            <!-- Меню -->
            <div id="menu">
                <div id="navWrap">
                    <a id="menu-general-training-href" href="../">План общей подготовки</a>
                    <a id="menu-training-href" href="/training/">Подготовка к полётам</a>
                    <a id="menu-authors-href" href="/authors/">Авторы</a>
                    <a id="menu-crew-href" href="/crew/">Члены экипажа</a>
                    <a id="menu-<?=$auth?>-href" href="/<?=$auth?>/"><?=$login?></a>
                </div>
            </div>
        </div>

        <!-- Страницы сайта -->
        <div id="content">
            <?=$content?>
        </div>

        <div id="footer">
            Все права защищены.
        </div>
    </body>

    <script src="../js/main.js"></script>
    <script src="../js/utilities.js"></script>
</html>