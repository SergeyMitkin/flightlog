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