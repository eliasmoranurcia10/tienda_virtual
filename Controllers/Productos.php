<?php

    class Productos extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();

            // Si la session esta vacía o muestra false entonces nos redirecciona a login
            if( empty($_SESSION['login']) )
            {
                header('location: ' . base_url().'/login');
            }

            //Llamar a la funcion para asignar los permisos
            getPermisos(4);
        }

        public function Productos(){

            if( empty($_SESSION['permisosMod']['r']) ) 
            {
                header("Location:" .base_url().'/dashboard' );
            }
            $data['page_tag']    = "Productos";
            $data['page_title']  = "PRODUCTOS <small>Tienda Virtual</small>";
            $data['page_name']   = "productos";
            $data['page_functions_js']  = "functions_productos.js";
            
            $this->views->getView($this,"productos",$data);

        }

        public function getProductos()
        {
            if($_SESSION['permisosMod']['r'])
            {
                $arrData    = $this->model->selectProductos();
                
                for ($i=0; $i < count($arrData); $i++) { 

                    $btnView    = '';
                    $btnEdit    = '';
                    $btnDelete  = '';

                    if($arrData[$i]['status'] == 1)
                    {
                        $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                    } else {
                        $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                    }

                    $arrData[$i]['precio']  = SMONEY.' '.formatMoney($arrData[$i]['precio']);

                    if( $_SESSION['permisosMod']['r'] )
                    {
                        $btnView    = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idproducto'].')" title="Ver Producto"><i class="far fa-eye"></i></button>';
                    }

                    if( $_SESSION['permisosMod']['u'] )
                    { 
                        
                        $btnEdit    = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo('.$arrData[$i]['idproducto'].')" title="Editar Producto"><i class="fas fa-edit"></i></button>';
                        
                    }

                    if( $_SESSION['permisosMod']['d'] )
                    {

                        $btnDelete  = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idproducto'].')" title="Eliminar Producto"><i class="far fa-trash-alt"></i></button>';
                        
                    }

                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }

                echo json_encode($arrData,JSON_UNESCAPED_UNICODE); // Forzarlo a que se convierta e un objeto
            }

            die(); //Finalizar el proceso
        }

        public function setProducto()
        {
            if($_POST){

                if( empty($_POST['txtNombre']) || empty($_POST['txtCodigo']) || empty($_POST['listCategoria']) || empty($_POST['txtPrecio']) || empty($_POST['listStatus']) ){

                    $arrResponse = array("status" => false, "msg" => 'Datos incompletos');

                } else {

                    //Limpiar toda la cadena para dejar data pura, esta función es creada en los Helpers
                    $idProducto     = intval($_POST['idProducto']); //function intval, si el id es vacío entonces le asigna 0
                    $strNombre      = strClean($_POST['txtNombre']);
                    $strDescripcion = strClean($_POST['txtDescripcion']);
                    $strCodigo      = strClean($_POST['txtCodigo']);
                    $intCategoriaId = intval($_POST['listCategoria']);
                    $strPrecio      = strClean($_POST['txtPrecio']);
                    $intStock       = intval($_POST['txtStock']);
                    $intStatus      = intval($_POST['listStatus']);

                    if ( $idProducto == 0 ) {
                        $option = 1;
                        $request_producto   = $this->model->insertProducto(
                            $strNombre,
                            $strDescripcion,
                            $strCodigo,
                            $intCategoriaId,
                            $strPrecio,
                            $intStock,
                            $intStatus
                        );

                    } else {
                        $option = 2;
                    }

                    if( $request_producto > 0 ){

                        if ( $option == 1 ) {
                            $arrResponse    = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente');
                        } else {

                        }

                    } else if ( $request_producto == 'exist' ) {
                        $arrResponse    = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado');
                    } else {
                        $arrResponse    = array('status' => false, 'msg' => 'No es posible almacenar los datos');
                    }

                }
                //Retornar el array en formato json
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            //detener el proceso
            die();

        }
    }
?>