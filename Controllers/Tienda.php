<?php

    require_once('Models/TCategoria.php');
    require_once('Models/TProducto.php');

    class Tienda extends Controllers{

        //Usando Traits "Ver seccion 3 cap 11"
        use TCategoria, TProducto;

        public function __construct(){

            parent::__construct();


        }

        public function tienda(){

            $data['page_tag']   = NOMBRE_EMPRESA;
            $data['page_title'] = NOMBRE_EMPRESA;
            $data['page_name']  = "tienda";
            $data['productos']  = $this->getProductosT();

            $this->views->getView($this,"home",$data);
        }

        public function categoria($params){
            if (empty($params)) {
                header("Location: ". base_url());

            } else {
                $categoria = strClean($params);
                $data['page_tag']   = $categoria;
                $data['page_title'] = $categoria;
                $data['page_name']  = "categoria";
                
                $this->views->getView($this,"categoria",$data);
            }
            
        }

    }

?>