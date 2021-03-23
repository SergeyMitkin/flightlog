<?php
include_once 'db.php';

// Получаем данные таблицы 'authors'
function getAuthors(){

    try {
        $q = "SELECT * FROM authors";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

// Добавляем автора
function setAuthor($author_id = 0, $author_name){

    try {
        $t = 'authors';
        $v = array(
            'name' => $author_name,
        );

        // Если Id автора больше 0, значит автор редактируется
        if($author_id > 0) {
            $w = "id =" . $author_id;
            $sql = SQL::getInstance()->Update($t, $v, $w);
            // Иначе добавляем нового атвора
        } else {
            $sql = SQL::getInstance()->Insert($t, $v);
        }
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    header("Location: /authors/");
}

// Удаляем автора
// При удалении автора удаляются связанные с ним задачи и темы общей подготовки
function deleteAuthor($author_id){

    try{
        $table = 'authors';
        $where = "id = " . $author_id;
        $sql = SQL::getInstance()->Delete($table, $where);
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
}