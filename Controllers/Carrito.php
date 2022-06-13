<?php

    require_once('Models/TCategoria.php');
    require_once('Models/TProducto.php');

    class Carrito extends Controllers{

        //Usando Traits "Ver seccion 3 cap 11"
        use TCategoria, TProducto;

        public function __construct(){

            parent::__construct();
            session_start();

        }

        public function carrito(){

            $data['page_tag']   = NOMBRE_EMPRESA . ' - Carrito';
            $data['page_title'] = 'Carrito de Compras';
            $data['page_name']  = "carrito";

            $this->views->getView($this,"carrito",$data);

        }
    }

?>