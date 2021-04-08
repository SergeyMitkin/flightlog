<?php
include_once 'db.php';

// Получаем данные таблицы 'crew'
/*
function getCrew(){

    try {
        $q = "SELECT * FROM crew";
        $sql = SQL::getInstance()->Select($q);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    return $sql;
}
*/
// Добавляем члена экипажа
function setCrew($crew_id = 0, $crew_name){

    try {
        $t = 'crew';
        $v = array(
            'name' => $crew_name,
        );

        // Если Id члена экипажа больше 0, значит он редактируется
        if($crew_id > 0) {
            $w = "id =" . $crew_id;
            $sql = SQL::getInstance()->Update($t, $v, $w);
            // Иначе добавляем нового члена экипажа
        } else {
            $sql = SQL::getInstance()->Insert($t, $v);
        }
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    header("Location: /crew/");
}

// Удаляем члена экипажа
function deleteCrew($crew_id){

    try{
        $table = 'crew';
        $where = "id = " . $crew_id;
        $sql = SQL::getInstance()->Delete($table, $where);
    }
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
}