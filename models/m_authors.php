<?php
include_once 'db.php';

function getAuthors(){
    try {
        $q = "SELECT * FROM authors";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}