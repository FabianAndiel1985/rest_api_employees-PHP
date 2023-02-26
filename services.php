<?php

function createJSonResponse(int $code, string $text) {
    header( "Content-type: application/json" );
    http_response_code($code);

    $jsonAnswer = array('message' => "{$text}");
    echo json_encode($jsonAnswer);
    die();
}

function routeExists ( $route, $possibleRoutes){
    $routeExists = false;
    foreach ($possibleRoutes as $value) {
        if(strcmp($value,$route) == 0) {
            return true;     
        }
      }
      return false;
}


function validateRequest( array $ALLOWEEDARRAYPROPERTIES,  $request, string $allowedMethod, string $requestMethod) {

    if ($requestMethod !== "{$allowedMethod}") {
        $allowedMethod = strtolower($allowedMethod);
        createJSonResponse(405,"Only {$allowedMethod} request alloweed");
        die();
    } 

    if($allowedMethod !== "GET") {
        $requestProperties = array_keys((array) $request);
        //check for length 
        if(count($requestProperties) < 1 || count($requestProperties) > 7 && $allowedMethod !== "GET" ) {
            echo "The request is too short or long";
            die();
        }

    // check that the request contains id
    if ( !(in_array("id",$requestProperties)) && $allowedMethod === "DELETE" || $allowedMethod === "UPDATE") {
            echo "The request needs to contain an id";
            die();
        }

    // check that the request only contains alloweed parameters
    if ($allowedMethod !== "GET") {
    $valid = true;
    foreach ($requestProperties as $key) {
        if(!in_array($key,$ALLOWEEDARRAYPROPERTIES)) {
            $valid = false;
        }
    }
    if(!$valid) {
        createJSonResponse(404,"The request contains not alloweed parameters");
        die();
    }
}
}
}

function getIdArrayFromDB ($pdo) {
    $preparedStmntString = "SELECT * FROM employees"; 
    $idArray = [];
    foreach ($pdo->query($preparedStmntString) as $row) {
        array_push($idArray,$row['id']);
     }
     return $idArray;
}

function validateId($pdo,$requestId) {
    $idArray = getIdArrayFromDB ($pdo);
    if(!in_array($requestId, $idArray)) {
        createJSonResponse(404,"There is no entry with the id {$id}");
        die();
    }
    return null;
}

