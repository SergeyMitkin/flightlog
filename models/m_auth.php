<?php
require_once('db.php');

/**
 * Модель авторизации
 */

// Залогиниваем по логину и паролю
function authWithCredentials(){
    // Получаем данные из формы авторизации
    $user_login = $_POST['login'];
    $password = $_POST['password'];

    try{
        // Получаем данные пользователя по логину из БД
        $q = "SELECT id, login, password FROM users WHERE login = '$user_login'";
        $sql = SQL::getInstance()->Select($q);
        $row = $sql['0'];

        // Данные пользователя, полученные из БД
        $id = $row['id'];
        $login = $row['login'];
        $hash_password = $row['password'];
        $isAuth = 0;

        // Проверяем соответствие логина и пароля
        if ($login && $hash_password) {
            if(checkPassword($password, $hash_password)){
                $isAuth = 1;
            }
        }

        // сохраняем данные в сессию
        $_SESSION['user'] = $row;
    }

    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
    return $isAuth;
}

// Проверяем пароль
function checkPassword($password, $hash){
    return crypt($password, $hash) === $hash;
}

// Проверяем залогинен ли уже пользователь
function alreadyLoggedIn(){
    return isset($_SESSION['user']);
}

// Добавляем нового пользователя
function setAdmin($login = 'admin', $password = 'qwerty'){
    try {

        $hash_password = hashPassword($password);

        $t = 'users';
        $v = array('login' => $login, 'password' => $hash_password);

        $sql = SQL::getInstance()->Insert($t, $v);
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
}

// Шифруем введённый пароль
function hashPassword($password)
{
    $salt = md5(uniqid(SALT2, true));
    $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
    return crypt($password, '$2a$08$' . $salt);
}