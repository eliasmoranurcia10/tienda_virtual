<?php

    class Productos extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();

            // Si la session esta vacía o muestra false entonces nos redirecciona a login
            if( empty($_SESSION['login']) )
            {
                header('location: ' . base_url().'/login');
            }

            //Llamar a la funcion para asignar los permisos
            getPermisos(4);
        }

        public function Productos(){

            if( empty($_SESSION['permisosMod']['r']) ) 
            {
                header("Location:" .base_url().'/dashboard' );
            }
            $data['page_tag']    = "Productos";
            $data['page_title']  = "PRODUCTOS <small>Tienda Virtual</small>";
            $data['page_name']   = "productos";
            $data['page_functions_js']  = "functions_productos.js";
            
            $this->views->getView($this,"productos",$data);

        }
    }
?>