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
                dep($_POST);
                die();

                if( empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus']) ){


                    $arrResponse = array("status" => false, "msg" => 'Datos incompletos');


                } else {

                    //Limpiar toda la cadena para dejar data pura, esta función es creada en los Helpers
                    $intIdcategoria = intval($_POST['idCategoria']);
                    $strCategoria   = strClean($_POST['txtNombre']);
                    $strDescripcion = strClean($_POST['txtDescripcion']);
                    $intStatus      = intval($_POST['listStatus']);

                    $foto               = $_FILES['foto'];
                    $nombre_foto        = $foto['name'];
                    $type               = $foto['type'];
                    $url_temp           = $foto['tmp_name'];
                    $imgPortada         = 'portada_categoria.png';
                    $request_categoria  = "";


                    if($nombre_foto != ''){
                        //md5 es para poder encriptar la fecha
                        $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                    }

                    if($intIdcategoria == 0) {
                        //Crear
                        if($_SESSION['permisosMod']['w'])
                        {
                            $request_categoria = $this->model->insertCategoria($strCategoria, $strDescripcion, $imgPortada ,$intStatus);
                            $option = 1;
                        }
        
                    } else {
                        //Actualizar
                        if($_SESSION['permisosMod']['u'])
                        {
                            if ($nombre_foto == '') {

                                if ( $_POST['foto_actual'] != 'portada_categoria.png' && $_POST['foto_remove'] == 0 ) {
                                    $imgPortada = $_POST['foto_actual'];
                                }

                            }

                            $request_categoria = $this->model->updateCategoria($intIdcategoria, $strCategoria, $strDescripcion, $imgPortada ,$intStatus);
                            $option = 2;
                        }
                    }

                    //Evaluar si ya se insertó el registro
                    if($request_categoria > 0) {

                        if($option == 1){
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                            //Estamos validando si es que subimos una foto
                            if ($nombre_foto != '') {

                                uploadImage($foto,$imgPortada);
                            }

                        } else{
                            $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');

                            if ($nombre_foto != '') {

                                uploadImage($foto,$imgPortada);
                            }
                            // No estamos enviando imagen y eliminando imagen O Si enviamos una foto y cambiamos de imagen
                            if ( ( $nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png') || ( $nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria-png' ) ) {

                                deleteFile($_POST['foto_actual']);
                            }
                        }

                    } else if($request_categoria == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! La Categoría ya existe.');
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos');
                    }

                }
                //sleep(5);
                //Retornar el array en formato json
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            //detener el proceso
            die();

        }
    }
?>