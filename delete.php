<?php 

require_once "./database.php";

$request = json_decode(file_get_contents('php://input'));

validateRequest(PROPERTIES, $request, "DELETE",$_SERVER["REQUEST_METHOD"]);

$id = $request->id;

validateId($pdo,$id);

$stmt = $pdo->prepare("DELETE FROM employees WHERE id=?");

$stmt->execute(array($request->id));

if ($stmt->rowCount() >  0 ) {
    createJSonResponse(200,'Request succeeded');
}

if($stmt->rowCount() <=  0 ) {
    createJSonResponse(400,'Request not succeeded');
}

$pdo = null;




