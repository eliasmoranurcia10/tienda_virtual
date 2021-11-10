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

            $this->views->getView($this,"tienda",$data);
        }

        public function categoria($params){
            if (empty($params)) {
                header("Location: ". base_url());

            } else {

                $categoria = strClean($params);
                
                $data['page_tag']   = NOMBRE_EMPRESA. " | " .$categoria;
                $data['page_title'] = $categoria;
                $data['page_name']  = "categoria";
                $data['productos']  = $this->getProductosCategoriaT($categoria);
                $this->views->getView($this,"categoria",$data);
            }
            
        }

        public function producto($params)
        {
            if (empty($params)) {
                header("Location: ". base_url());

            } else {

                $producto = strClean($params);
                
                $data['page_tag']   = NOMBRE_EMPRESA. " | " .$producto;
                $data['page_title'] = $producto;
                $data['page_name']  = "producto";
                $data['producto']   = "";
                //$data['productos']  = $this->getProductosCategoriaT($producto);
                $this->views->getView($this,"producto",$data);
            }
        }

    }

?>