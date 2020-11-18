<?php
include_once 'db.php';

function getGeneralTasks(){
    try {
        $q = "SELECT g.name AS task_name, g.description, a.name AS author_name, g.date 
        FROM general_tasks g 
        LEFT JOIN authors a on g.author_id = a.id";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

function setGeneralTask($task_name, $description, $author_id, $date){

    try {
        $t = 'general_tasks';
        $v = array(
            'name' => $task_name,
            'description' => $description,
            'author_id' => $author_id,
            'date' => $date,
        );

        $sql = SQL::getInstance()->Insert($t, $v);
        $response = 'Задача добавлена';

    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
    return $response;
}