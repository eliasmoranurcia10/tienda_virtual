<?php

    require_once('Models/TCategoria.php');
    require_once('Models/TProducto.php');

    class Home extends Controllers{

        //Usando Traits "Ver seccion 3 cap 11"
        use TCategoria, TProducto;

        public function __construct(){

            parent::__construct();


        }

        public function home(){

            $data['page_tag']   = NOMBRE_EMPRESA;
            $data['page_title'] = NOMBRE_EMPRESA;
            $data['page_name']  = "tienda_virtual";
            $data['slider']     = $this->getCategoriasT(CAT_SLIDER);
            $data['banner']     = $this->getCategoriasT(CAT_BANNER);
            $data['productos']  = $this->getProductosT();


            $this->views->getView($this,"home",$data);

        }
    }

?>