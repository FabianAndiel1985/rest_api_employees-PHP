<?php

$request = json_decode(file_get_contents('php://input'));

validateRequest(PROPERTIES, $request, "PATCH",$_SERVER["REQUEST_METHOD"]);

$id = $request->id;

validateId($pdo,$id);

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


$stmt = $pdo->prepare($preparedStmntString);

try{
    $stmt->execute($requestValues);
    createJSonResponse(200,"Succeeded saving in DB");
}

catch(PDOException $exception){ 
    createJSonResponse(400,"Could not save entry in DB");
}




 
