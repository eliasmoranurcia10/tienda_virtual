<?php

    require_once("Config/Config.php");
    require_once("Helpers/Helpers.php");

    //Si es que no está vacio la url --> imprime home/home
    $url = !empty( $_GET['url'] ) ? $_GET['url'] : 'home/home';
    $arrUrl = explode("/", $url);
    $controller = $arrUrl[0];
    $method = $arrUrl[0];
    $params = "";

    if(!empty($arrUrl[1]) && $arrUrl[1] != ""){

        $method = $arrUrl[1];

    }

    if(!empty($arrUrl[2]) && $arrUrl[2] != ""){
            
        for($i =2; $i < count($arrUrl); $i++){
            $params .= $arrUrl[$i].',';
        }

        $params = trim($params,',');    //Elimina el último caracter , en este caso la coma
        
    }

    require_once("Libraries/Core/Autoload.php");
    require_once("Libraries/Core/Load.php");

?>