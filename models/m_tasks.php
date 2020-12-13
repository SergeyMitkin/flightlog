<?php
include_once 'db.php';

// Получаем данные таблицы 'tasks' со смежной таблицей авторов
function getGeneralTasks(){
    try {
        $q = "SELECT g.id, g.name AS task_name, g.description, a.id AS author_id, a.name AS author_name, g.date 
        FROM general_tasks g 
        LEFT JOIN authors a on g.author_id = a.id";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

// Добавляем задачу
function setGeneralTask($task_id = 0, $task_name, $description, $author_id, $date){

    try {
        $t = 'general_tasks';
        $v = array(
            'name' => $task_name,
            'description' => $description,
            'author_id' => $author_id,
            'date' => $date,
        );

        // Если Id полёта больше 0, значит полёт редактируется
        if($task_id > 0) {
            $w = "id =" . $task_id;
            $sql = SQL::getInstance()->Update($t, $v, $w);
            // Иначе добавляем новый полёт
        } else {
            $sql = SQL::getInstance()->Insert($t, $v);
        }


    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
    header("Location: /");
}