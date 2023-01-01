<?php 

class Database {
    public static function establishConnection () {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
            "root", "");
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,"false");
            return $pdo;
        } catch (\Throwable $th) {
        }
    }
}
