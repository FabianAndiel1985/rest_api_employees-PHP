<?php

require_once "./database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    createJSonResponse(405,"Only post requests alloweed");
} 

$request = json_decode(file_get_contents('php://input'));


$firstname=htmlspecialchars(strip_tags($request->firstname));
$lastname=htmlspecialchars(strip_tags($request->lastname));
$street=htmlspecialchars(strip_tags($request->street));
$housenumber=htmlspecialchars(strip_tags($request->housenumber));
$zip=htmlspecialchars(strip_tags($request->zip));
$country=htmlspecialchars(strip_tags($request->country));

$pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
"root", "");

$stmt = $pdo->prepare("INSERT INTO employees (id,firstname,lastname,street,housenumber,zip,country) VALUES (?,?,?,?,?,?,?)");

if($stmt->execute(array(null,$firstname, $lastname, $street, $housenumber, $zip, $country))) {
    createJSonResponse(405,"Succeeded saving in DB");
}

 else {
    createJSonResponse(400,'Request not succeeded');
 }
