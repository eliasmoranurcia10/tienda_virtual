<?php

    class Clientes extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            //Hacemos que el id de sesion anterior se elimine
            session_regenerate_id(true);

            // Si la session esta vacía o muestra false entonces nos redirecciona a login
            if( empty($_SESSION['login']) )
            {
                header('location: ' . base_url().'/login');
            }

            //Llamar a la funcion para asignar los permisos
            getPermisos(3);
        }

        public function Clientes(){

            if( empty($_SESSION['permisosMod']['r']) ) 
            {
                header("Location:" .base_url().'/dashboard' );
            }
            $data['page_tag']    = "Clientes";
            $data['page_title']  = "CLIENTES <small>Tienda Virtual</small>";
            $data['page_name']   = "clientes";
            $data['page_functions_js']  = "functions_clientes.js";
            
            $this->views->getView($this,"clientes",$data);

        }

        public function setCliente()
        {
            dep($_POST);
            die();
        }


    }

?>