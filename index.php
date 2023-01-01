<?php 

require "./services.php";

$route = strtolower($_SERVER["PATH_INFO"]);

$possibleRoutes = ["/index","/new","/delete"];

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
    }
}

else {
    createJSonResponse(404,"The route doesn't exist");
}











