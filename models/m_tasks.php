<?php
include_once 'db.php';

function getGeneralTasks(){
    try {
        $q = "SELECT * FROM general_tasks";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}