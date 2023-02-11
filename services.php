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


function validateRequest( array $ALLOWEEDARRAYPROPERTIES, object $request){

$requestProperties = array_keys((array) $request);

 //check for length and that id is in array

if ( count($requestProperties) < 2 || count($requestProperties) > 7  ) {
    echo "The request is too short or long";
    die();
}

if ( !(in_array("id",$requestProperties))) {
        echo "The request needs to contain an id";
        die();
}

// check that the request only contains alloweed parameters
$valid = true;
 foreach ($requestProperties as $key) {
       
    if(!in_array($key,$ALLOWEEDARRAYPROPERTIES)) {
        $valid = false;
    }
}

// //if goes through all checks, return true
return $valid;
}


