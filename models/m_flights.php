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

function setFlight($flight_name, $date, $time_start, $time_end, $dawn_sunset, $exercise, $crew){

    // Добавляем запись в таблицу "flights"
    try {
        $t = 'flights';
        $v = array(
            'name' => $flight_name,
            'date' => $date,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'dawn_sunset' => $dawn_sunset,
        );

        $flight_id = SQL::getInstance()->Insert($t, $v);
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    // Добавляем запись в таблицу "exercises"
    $exercise_array = array();
    for ($i=0; $i<count($exercise); $i++){
        $exercise_array[$i]['name'] = $exercise[$i];
        $exercise_array[$i]['flight_id'] = $flight_id;
    }

    try {
        $t = 'exercises';
        $v = $exercise_array;
        $sql = SQL::getInstance()->mulInsert($t, $v);
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
}