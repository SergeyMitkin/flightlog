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
    try {
        $t = 'flights';
        $v = array(
            'name' => $flight_name,
            'date' => $date,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'dawn_sunset' => $dawn_sunset,
        );

        $sql = SQL::getInstance()->Insert($t, $v);


    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
   // header("Location: /");
}