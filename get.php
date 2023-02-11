<?php

require_once "./database.php";

if ($_SERVER["REQUEST_METHOD"] !== "GET"){
    createJSonResponse(405,"Only post requests alloweed");
} 




 $pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
 "root", "");

// $stmt = $pdo->prepare("INSERT INTO employees (id,firstname,lastname,street,housenumber,zip,country) VALUES (null,?,?,?,?,?,?)");

// try{
//     $stmt->execute(array($firstname, $lastname, $street, $housenumber, $zip, $country));
//     createJSonResponse(200,"Succeeded saving in DB");
// }

// catch(PDOException $exception){ 
//     createJSonResponse(400,"Could not save entry in DB");
// }

// $pdo = null;