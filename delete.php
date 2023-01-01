<?php 

//VALDATION PACKAGE WITH COMPOSER

require_once "./database.php";

if ($_SERVER["REQUEST_METHOD"] !== "DELETE"){
    createJSonResponse(405,"Only delete requests alloweed");
} 

$request = json_decode(file_get_contents('php://input'));

$pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
 "root", "");

$stmt = $pdo->prepare("DELETE FROM employees WHERE id=?");

$stmt->execute(array($request->id));

if ($stmt->rowCount() >  0 ) {
    createJSonResponse(200,'Request succeeded');
}

if($stmt->rowCount() <=  0 ) {
    createJSonResponse(400,'Request not succeeded');
}

$pdo = null;

//Why doesnt this worK: 

// try {
//     $stmt->execute(array(2000));
//     echo "im here";
// }

// catch (error) {
//     createJSonResponse(400,'Request not succeeded');
// }





