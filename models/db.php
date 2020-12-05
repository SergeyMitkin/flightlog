<?php

require_once('../config/config.php'); // Файл конфигураций

// Клас для работы с БД через PDO
class SQL{
    protected static $_instance; // Экземпляр класса
    protected $connect_str; // // Строка для подключения к БД
    protected $db; // Экземпляр класса PDO

    private function __construct(){
        setlocale(LC_ALL, 'ru_RU'.'UTF8'); // Устанавливаем локаль и кодировку
        $this->connect_str = $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME; // Строка для подключения к БД
        $this->db = new PDO($connect_str,DB_USER,DB_PASS); // Подключаемся к БД
        $this->db->exec("SET names UTF-8"); // Устанавливаем кодировку
        }

    // Метод для обращения к БД
    public static function getInstance(){
        if(empty(self::$_instance)){
            self::$_instance = new SQL;
        }
        return self::$_instance;
    }

    // Read
    public function Select($query){
        $q = $this->db->prepare($query);
        $q->execute();
        return $q->fetchAll();
    }

    // Create
    // Добавляем одну строку в БД
    public function Insert($table, $object){

        // Соотносим колонки таблицы с передаваемыми значениями
        $columns = array();
        foreach($object as $key=>$value) {
            $columns[] = $key;
            $masks[] = ":$key";
        }

            $columns_s = implode(',' ,$columns);
            $masks_s = implode(',' , $masks);

            $query = "INSERT INTO $table ($columns_s) VALUES ($masks_s)"; // Sql-запрос
            $q = $this->db->prepare($query); // Подготовленное выражение
            $q->execute($object); // Обращаемся к БД

            // Обработка ошибок
        if($q->errorCode() != PDO::ERR_NONE){
            $info = $q->errorInfo();
            die($info[2]);
        }
            return $this->db->lastInsertId();
        }

    // Добавляем несколько строк в БД
    public function mulInsert($table, $object){

        // Соотносим колонки таблицы с передаваемыми значениями
        $columns = array();
        foreach($object[0] as $key=>$value) {
            $columns[] = $key;
            $masks[] = "?";
        }

        $columns_s = implode(',' ,$columns);
        $masks_s = implode(',' , $masks);

        $query = "INSERT INTO $table ($columns_s) VALUES ($masks_s)"; // Sql-запрос
        $stmt = $this->db->prepare($query); // Подготовленное выражение

        // Связываем параметры
        for ($i=0; $i<count($columns); $i++) {
            $var = array_keys($object[0])[$i];
            $stmt->bindParam($i+1, $$var);
        }

        // Вставляем строки в БД
        for ($i=0; $i<count($object); $i++){

            for ($index=0; $index<count($object[0]); $index++){
                $var = array_keys($object[0])[$index];
                $$var = $object[$i][$var];
            }
            $stmt->execute();

            // Обработка ошибок
            if($stmt->errorCode() != PDO::ERR_NONE){
                $info = $stmt->errorInfo();
                die($info[2]);
            }
        }
    }

    // Update
    public function Update($table,$object,$where){
        $sets = array();

        // Соотносим колонки таблицы с передаваемыми значениями
        foreach($object as $key => $value){
            $sets[] = "$key=:$key";
            if($value === NULL){
                $object[$key]='NULL';
            }
        }

        $sets_s = implode(',',$sets);
        $query = "UPDATE $table SET $sets_s WHERE $where";

        $q = $this->db->prepare($query);
        $q->execute($object);

        // Обработка ошибок
        if($q->errorCode() != PDO::ERR_NONE){
            $info = $q->errorInfo();
            die($info[2]);
        }
        return $q->rowCount();
    }

    //Delete
    public function Delete($table, $where){
        $query = "DELETE FROM $table WHERE $where";  // Sql-запрос
        $q = $this->db->prepare($query); // Подготовленное выражение
        $q->execute(); // Обращаемся к БД

        // Обработка ошибок
        if($q->errorCode() != PDO::ERR_NONE){
            $info = $q->errorInfo();
            die($info[2]);
        }

        return $q->rowCount();
    }
}
