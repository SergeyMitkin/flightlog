<?php
include_once 'db.php';

function getCrew(){
    try {
        $q = "SELECT * FROM crew";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}