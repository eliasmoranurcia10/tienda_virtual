<?php

    class Roles extends Controllers{
        public function __construct(){

            parent::__construct();


        }

        public function Roles(){

            $data['page_id']     = 3;
            $data['page_tag']    = "Roles Usuario";
            $data['page_name']   = "rol_usuario";
            $data['page_title']  = "Roles Usuario <small>Tienda Virtual</small>";
            
            $this->views->getView($this,"roles",$data);

        }

        public function getRoles()
        {
            $arrData = $this->model->selectRoles();

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE); // Forzarlo a que se convierta e un objeto
            die(); //Finalizar el proceso
        }
    }

?>