<?php

    class Logout{

        public function __construct(){

            //Inicializamos la sesion
            session_start();
            //Limpiamos todas las variables de sesion
            session_unset();
            //Destruir todas las sesiones
            session_destroy();

            //Nos va a redirecionar a la ruta 
            header('location: ' . base_url().'/login');

        }

    }

?>