<?php 

class Database {
    public static function establishConnection () {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
            "root", "");
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Throwable $th) {
            echo "error";
        }
    }
}
