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

function getFlightExercises(){
    try {
        $q = "SELECT * FROM exercises";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    return $sql;
}

function getFlights(){
    try {
        $q = "SELECT * FROM flights";
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
    // Создаём массив для добавления строк в БД
    if ($exercise !== null) {
        $exercise_array = array();
        for ($i = 0; $i < count($exercise); $i++) {
            $exercise_array[$i]['name'] = explode('+php+', $exercise[$i])[0];
            $exercise_array[$i]['time'] = explode('+php+', $exercise[$i])[1];
            $exercise_array[$i]['flight_id'] = $flight_id;
        }
    }

    try {
        $t = 'exercises';
        $v = $exercise_array;
        $sql = SQL::getInstance()->mulInsert($t, $v);
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    // Добавляем запись в таблицу "flights_crew"
    // Создаём массив для добавления строк в БД
    $crew_array = array();
    for ($i=0; $i<count($crew); $i++){
        $crew_array[$i]['flight_id'] = $flight_id;
        $crew_array[$i]['crew_id'] = $crew[$i];
    }

    try {
        $t = 'flights_crew';
        $v = $crew_array;
        $sql = SQL::getInstance()->mulInsert($t, $v);
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    header("Location: /training/");
}