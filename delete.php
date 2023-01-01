<?php 

require_once "./database.php";

if ($_SERVER["REQUEST_METHOD"] !== "DELETE"){
    createJSonResponse(405,"Only delete requests alloweed");
} 

$request = json_decode(file_get_contents('php://input'));

$pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
 "root", "");

$stmt = $pdo->prepare("DELETE FROM employees WHERE id=?");

print_r($request->id);


// if($stmt->execute(array($request->id))) {
//     createJSonResponse(200,"DB entry was deleted successfully");
// }

//  else {
//     createJSonResponse(400,'Request not succeeded');
//  }



