<?php
/**
 * Основной шаблон
 */
?>
<!-- Шаблон авторизации -->
<div class="auth-container">
    <!-- Выводим сообщение об ошибке -->
    <p class="red"><?=$autherror?></p>

    <!-- Форма авторизации -->
    <form method="post">
        <h1>Авторизация</h1>
        <div class="form-group">
            <label for="login">Введите логин</label>
            <input type="text" id="login" name="login" placeholder="Логин"/>
        </div>

        <div class="form-group">
            <label for="password">Введите пароль</label>
            <input type="password" id="password" name="password" placeholder="Пароль"/>
        </div>

        <div class="group">
            <button class="btn create-button">Войти</button>
        </div>
    </form>
</div>





