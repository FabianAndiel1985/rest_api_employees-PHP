<?php

require_once "./database.php";

//Todo das checken ob der Request nur erlaubte properties hat verlagern in den service
//In der post methode auch checken ob ALLE PROPERTIES VORHANDEN SIND
//GET METHIDE MACHEN
//AUF GITHUB VERÖFFENTLICHEN LETZTE REST API MIT PLAIN PHP


if ($_SERVER["REQUEST_METHOD"] !== "PATCH"){
    createJSonResponse(405,"Only patch requests alloweed");
} 

$request = json_decode(file_get_contents('php://input'));

$validatedResult = validateRequest(PROPERTIES, $request);

if($validatedResult != 1) {
    createJSonResponse(404,"The request contains not alloweed parameters");
    die();
}

$id = $request->id;

$pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
"root", "");

$preparedStmntString = "SELECT * FROM employees"; 

$idArray = []; 

foreach ($pdo->query($preparedStmntString) as $row) {
    array_push($idArray,$row['id']);
 }

if(!in_array($id, $idArray)) {
    createJSonResponse(404,"The is not entry with the id {$id}");
    die();
}


$requestArray = get_object_vars($request);

$filteredRequestArr = array_filter($requestArray, fn ($key) => $key !== "id", ARRAY_FILTER_USE_KEY);

$requestValues = array_values($filteredRequestArr);

array_push($requestValues, $id);

$requestKeys = array_keys($filteredRequestArr);

$preparedStmntValues = "";

foreach ($requestKeys as $key=>$value) {
    if($key != count($requestKeys)-1) {
        $preparedStmntValues .= " {$value}=?,";
    }
    else {
        $preparedStmntValues .= " {$value}=?";
    }                      
};

$preparedStmntString = "UPDATE employees SET ".$preparedStmntValues." WHERE id=?";                                                                                                                                

$pdo = new PDO("mysql:host=localhost;dbname=rest_api_employees;charset=utf8",
"root", "");

$stmt = $pdo->prepare($preparedStmntString);

try{
    $stmt->execute($requestValues);
    createJSonResponse(200,"Succeeded saving in DB");
}

catch(PDOException $exception){ 
    createJSonResponse(400,"Could not save entry in DB");
}




 
