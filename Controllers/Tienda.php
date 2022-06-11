<?php

    require_once('Models/TCategoria.php');
    require_once('Models/TProducto.php');

    class Tienda extends Controllers{

        //Usando Traits "Ver seccion 3 cap 11"
        use TCategoria, TProducto;

        public function __construct(){

            parent::__construct();
            session_start();

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

                $arrParams = explode(",", $params);
                $idcategoria    = intval($arrParams[0]);
                $ruta           = strClean($arrParams[1]);
                $infoCategoria  = $this->getProductosCategoriaT($idcategoria, $ruta);

                $categoria          = strClean($infoCategoria['categoria']);
                $data['page_tag']   = NOMBRE_EMPRESA. " | " .$categoria;
                $data['page_title'] = $categoria;
                $data['page_name']  = "categoria";
                $data['productos']  = $infoCategoria['productos'];
                $this->views->getView($this,"categoria",$data);
            }
            
        }

        public function producto($params)
        {
            if (empty($params)) {
                header("Location: ". base_url());

            } else {
                
                $arrParams = explode(",", $params);
                $idproducto    = intval($arrParams[0]);
                $ruta          = strClean($arrParams[1]);
                $infoProducto  = $this->getProductoT($idproducto, $ruta);

                if (empty($infoProducto)) {
                    header("Location: ". base_url());
                }

                $data['page_tag']   = NOMBRE_EMPRESA. " | " .$infoProducto['nombre'];
                $data['page_title'] = $infoProducto['nombre'];
                $data['page_name']  = "producto";
                $data['producto']   = $infoProducto;
                // r -> aleatoria, a -> ascendente, d -> descendente
                $data['productos']  = $this->getProductosRamdom($infoProducto['categoriaid'],8,"r");

                $this->views->getView($this,"producto",$data);
            }
        }

        public function addCarrito()
        {
            if($_POST){
                //unset($_SESSION['arrCarrito']);exit;
                $arrCarrito = array();
                $cantCarrito = 0;
                $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
                $cantidad   = $_POST['cant'];

                if( is_numeric($idproducto) and is_numeric($cantidad) ){

                    $arrInfoProducto = $this->getProductoIDT($idproducto);

                    if (!empty($arrInfoProducto)) {
                        # code...
                        $arrProducto = array(
                            'idproducto' => $idproducto,
                            'producto'   => $arrInfoProducto['nombre'],
                            'cantidad'   => $cantidad,
                            'precio'     => $arrInfoProducto['precio'],
                            'imagen'     => $arrInfoProducto['images'][0]['url_image']
                        );
                        if (isset($_SESSION['arrCarrito'])) {
                            #  Variable de sesion...
                            $on = true;
                            $arrCarrito = $_SESSION['arrCarrito'];

                            for ($pr=0; $pr < count($arrCarrito) ; $pr++) { 
                                # code...
                                if ($arrCarrito[$pr]['idproducto'] == $idproducto) {
                                    $arrCarrito[$pr]['cantidad'] += $cantidad;
                                    $on = false;
                                }
                            }

                            if ($on) {
                                # code...
                                array_push($arrCarrito, $arrProducto);
                            }

                            $_SESSION['arrCarrito'] = $arrCarrito;

                        } else {
                            //Agregar un elemento a un array
                            array_push($arrCarrito,$arrProducto);
                            $_SESSION['arrCarrito'] = $arrCarrito;
                        }

                        foreach ( $_SESSION['arrCarrito'] as $pro){
                            
                            $cantCarrito += $pro['cantidad'];
                        }

                        $htmlCarrito= getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);
                        
                        $arrResponse = array(
                            "status"        => true,
                            "msg"           => '¡Se agregó al carrito!',
                            "cantCarrito"   => $cantCarrito,
                            "htmlCarrito"   => $htmlCarrito
                        );

                    } else {
                        $arrResponse = array(
                            'status' => false,
                            'msg' => 'Producto no existente'
                        );
                    }

                } else {
                    $arrResponse    = array(
                        "status"    => false,
                        "msg"   => "Dato incorrecto"
                    );
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

    }

?>