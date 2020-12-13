<?php
include_once 'db.php';

// Получаем темы общей подготовки по типу
function getGeneralTopics($type){
    try {
        $q = "SELECT g.id, g.name AS topic_name, g.description, g.type, a.id AS author_id, a.name AS author_name, g.date 
        FROM general_topics g 
        LEFT JOIN authors a on g.author_id = a.id
        WHERE type = '" . $type . "'";

        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

// Создаём новую тему общей подготовки
function setGeneralTopic($topic_id = 0, $topic_name, $description, $topic_type, $author_id, $date){
    try {
        $t = 'general_topics';
        $v = array(
            'name' => $topic_name,
            'description' => $description,
            'type' => $topic_type,
            'author_id' => $author_id,
            'date' => $date,
        );
        // Если Id темы больше 0, значит тема редактируется
        if($topic_id > 0) {
            $w = "id =" . $topic_id;
            $sql = SQL::getInstance()->Update($t, $v, $w);
            // Иначе добавляем новую задачу
        } else {
            $sql = SQL::getInstance()->Insert($t, $v);
        }
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
    header("Location: /");
}