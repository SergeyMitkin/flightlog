<?php
include_once 'db.php';

function getAviationTechnologyTopics(){
    try {
        $q = "SELECT g.name AS topic_name, g.description, a.name AS author_name, g.date 
        FROM general_topics g 
        LEFT JOIN authors a on g.author_id = a.id
        WHERE type = 'aviation technology'";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

function getAerodynamicsTopics(){
    try {
        $q = "SELECT g.name AS topic_name, g.description, a.name AS author_name, g.date 
        FROM general_topics g 
        LEFT JOIN authors a on g.author_id = a.id
        WHERE type = 'aerodynamics'";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

function setGeneralTopic($task_name, $description, $author_id, $date){

    try {
        $t = 'general_tasks';
        $v = array(
            'name' => $task_name,
            'description' => $description,
            'author_id' => $author_id,
            'date' => $date,
        );

        $sql = SQL::getInstance()->Insert($t, $v);

    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
    header("Location: /");
}