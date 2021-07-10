<?php

    class Dashboard extends Controllers{
        public function __construct(){

            parent::__construct();

            session_start();

            // Si la session esta vacía o muestra false entonces nos redirecciona a login
            if( empty($_SESSION['login']) )
            {
                header('location: ' . base_url().'/login');
            }

            //getPermisos(1);
        }

        public function dashboard(){

            $data['page_id']     = 2;
            $data['page_tag']    = "Dashboard - Tienda Virtual";
            $data['page_title']  = "Dashboard - Tienda Virtual";
            $data['page_name']   = "dashboard";
            
            $this->views->getView($this,"dashboard",$data);

        }

        

    }

?>