<?php
include_once 'db.php';

// Получаем данные таблицы 'crew'
function getCrew(){
    try {
        $q = "SELECT * FROM crew";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

// Получаем данные таблицы 'exercises'
function getFlightExercises(){
    try {
        $q = "SELECT * FROM exercises";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    return $sql;
}

// Получаем данные составной таблицы полётов и членов экипажа, получем имена членов экипажа
// из таблицы 'crew'
function getFlightsCrew(){
    try {
        $q = "SELECT * FROM flights_crew
        LEFT JOIN crew c2 on flights_crew.crew_id = c2.id
        ";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    return $sql;
}

// Получаем данные таблицы 'flights'
function getFlights(){
    try {
        $q = "SELECT * FROM flights";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}

// Создаём новый полёт или редактируем
function setFlight($flight_id = 0, $flight_name, $date, $time_start, $time_end, $dawn_sunset, $exercise, $crew,
                   $individual_task, $security_measures, $self_preparation_task, $trainers, $self_preparation){

    // Если id полёта > 0, значит полёт редактируется
    // При редактировании, удаляем изначальных членов экипажа и упражнения из связанных таблиц
    if($flight_id > 0) {
        // Удаляем членов экипажа
        try{
            $table = 'flights_crew';
            $where = 'flight_id = ' . $flight_id;
            $sql = SQL::getInstance()->Delete($table, $where);
        }
        catch(PDOException $e){
            die("Error: ".$e->getMessage());
        }

        // Удаляем упражнения
        try{
            $table = 'exercises';
            $where = 'flight_id = ' . $flight_id;
            $sql = SQL::getInstance()->Delete($table, $where);
        }
        catch(PDOException $e){
            die("Error: ".$e->getMessage());
        }
    }

    // Добавляем запись в таблицу "flights" или редактируем
    try {
        $t = 'flights';
        $v = array(
            'name' => $flight_name,
            'date' => $date,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'dawn_sunset' => $dawn_sunset,
            'individual_task' => $individual_task,
            'security_measures' => $security_measures,
            'self_preparation_task' => $self_preparation_task,
            'trainers' => $trainers,
            'self_preparation' => $self_preparation
        );

        // Если Id полёта больше 0, значит полёт редактируется
        if($flight_id > 0) {
            $w = "id =" . $flight_id;
            $sql = SQL::getInstance()->Update($t, $v, $w);
        // Иначе добавляем новый полёт
        } else {
            $flight_id = SQL::getInstance()->Insert($t, $v);
        }
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

        try {
            $t = 'exercises';
            $v = $exercise_array;
            $sql = SQL::getInstance()->mulInsert($t, $v);
        }
        catch(PDOException $e){
            die("Error: ".$e->getMessage());
        }
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

    //header("Location: /training/");
}