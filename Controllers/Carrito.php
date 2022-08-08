<?php

    require_once('Models/TCategoria.php');
    require_once('Models/TProducto.php');
    require_once('Models/TTipoPago.php');
    require_once('Models/TCliente.php');

    class Carrito extends Controllers{

        //Usando Traits "Ver seccion 3 cap 11"
        use TCategoria, TProducto, TTipoPago, TCliente;

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

        public function procesarpago(){

            if ( empty($_SESSION['arrCarrito']) ) {
                header("Location: ".base_url());
                die();
            }
            /*
            if (isset( $_SESSION['login'] )) {
                $this->setDetalleTemp();
            }
            */
            $data['page_tag']   = NOMBRE_EMPRESA . ' - Procesar Pago';
            $data['page_title'] = 'Procesar Pago';
            $data['page_name']  = "procesarpago";
            $data['tipospago']  = $this->getTiposPagoT();

            $this->views->getView($this,"procesarpago",$data);

        }
        /*
        public function setDetalleTemp(){
            $sid = session_id();

            $arrPedido = array(
                'idcliente' => $_SESSION['idUser'],
                'idtransaccion' => $sid,
                'productos' => $_SESSION['arrCarrito']
            );
            
            $this->insertDetalleTemp($arrPedido);
        }
        */

    }

?>