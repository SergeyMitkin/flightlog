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

function setAuthor($author_id = 0, $author_name){

}