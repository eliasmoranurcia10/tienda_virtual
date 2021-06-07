<?php

    $controller = ucwords($controller);  //Covertir la primera letra en Mayuscula

    //COMUNICACIÓN CON LOS CONTROLADORES
    $controllerFile = "Controllers/".$controller.".php";

    if(file_exists($controllerFile)) {
        require_once($controllerFile);
        $controller = new $controller();

        if(method_exists($controller, $method)){
            //LLama a la función del controlador
            $controller->{$method}($params);
        } else {
            require_once("Controllers/Error.php");
        }

    } else {
        require_once("Controllers/Error.php");
    }

?>