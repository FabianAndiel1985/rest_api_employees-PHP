<?php

$request = json_decode(file_get_contents('php://input'));



validateRequest(PROPERTIES, $request, "POST",$_SERVER["REQUEST_METHOD"]);

$firstname=htmlspecialchars(strip_tags($request->firstname));
$lastname=htmlspecialchars(strip_tags($request->lastname));
$street=htmlspecialchars(strip_tags($request->street));
$housenumber=htmlspecialchars(strip_tags($request->housenumber));
$zip=htmlspecialchars(strip_tags($request->zip));
$country=htmlspecialchars(strip_tags($request->country));

$stmt = $pdo->prepare("INSERT INTO employees (id,firstname,lastname,street,housenumber,zip,country) VALUES (null,?,?,?,?,?,?)");

try{
    $stmt->execute(array($firstname, $lastname, $street, $housenumber, $zip, $country));
    createJSonResponse(200,"Succeeded saving in DB");
}

catch(PDOException $exception){ 
    createJSonResponse(400,"Could not save entry in DB");
}

$pdo = null;