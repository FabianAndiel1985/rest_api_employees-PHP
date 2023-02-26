<?php

require_once "./database.php";

$request = false;

validateRequest(PROPERTIES, $request, "GET",$_SERVER["REQUEST_METHOD"]);

$resultArray=[];

// hier noch abschliessen und dann ein Array mit Standard Obj bilden
 $preparedStmntString = "SELECT * FROM employees"; 
 

 foreach ($pdo->query($preparedStmntString) as $row) {
    // print_r($row);
    $obj = new stdClass();
    $obj->id = $row['id'];
    $obj->firstname = $row['firstname'];
    $obj->lastname = $row['lastname'];
    $obj->street = $row['street'];
    $obj->housenumber = $row['housenumber'];
    $obj->zip = $row['zip'];
    $obj->country = $row['country'];
    array_push($resultArray,$obj);
 }

 createJSonResponse(200,json_encode($resultArray));