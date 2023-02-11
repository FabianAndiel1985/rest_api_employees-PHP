<?php 

require "./services.php";

$route = strtolower($_SERVER["PATH_INFO"]);

$possibleRoutes = ["/index","/new","/delete","/update","/get"];

const PROPERTIES=["id","firstname","lastname","street","housenumber","zip","country"];


if(routeExists($route,$possibleRoutes)) {
    
    switch ($route) {
        case "/index":
            echo "its index";
            break;
        case "/new":
            require "./post.php";
            break;
        case "/delete":
            require "./delete.php";
        break;
        case "/update":
            require "./update.php";
        break;
        case "/get":
            require "./get.php";
        break;
    }
}

else {
    createJSonResponse(404,"The route doesn't exist");
}











