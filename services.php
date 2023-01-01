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

