<?php

    class Home extends Controllers{
        public function __construct(){

            parent::__construct();


        }

        public function home(){

            $data['page_tag']    = NOMBRE_EMPRESA;
            $data['page_title']  = NOMBRE_EMPRESA;
            $data['page_name']   = "tienda_virtual";
            $this->views->getView($this,"home",$data);

        }

        

    }

?>