<?php

    class Categorias extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();

            // Si la session esta vacía o muestra false entonces nos redirecciona a login
            if( empty($_SESSION['login']) )
            {
                header('location: ' . base_url().'/login');
            }

            //Llamar a la funcion para asignar los permisos
            getPermisos(6);
        }

        public function Categorias(){

            if( empty($_SESSION['permisosMod']['r']) ) 
            {
                header("Location:" .base_url().'/dashboard' );
            }
            $data['page_tag']    = "Categorias";
            $data['page_title']  = "CATEGORIAS <small>Tienda Virtual</small>";
            $data['page_name']   = "categorias";
            $data['page_functions_js']  = "functions_categorias.js";
            
            $this->views->getView($this,"categorias",$data);

        }

        public function setCategoria()
        {
            if($_POST){

                if( empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus']) ){


                    $arrResponse = array("status" => false, "msg" => 'Datos incompletos');


                } else {

                    //Limpiar toda la cadena para dejar data pura, esta función es creada en los Helpers
                    $intIdcategoria = intval($_POST['idCategoria']);
                    $strCategoria   = strClean($_POST['txtNombre']);
                    $strDescripcion = strClean($_POST['txtDescripcion']);
                    $intStatus      = intval($_POST['listStatus']);

                    $foto           = $_FILES['foto'];
                    $nombre_foto    = $foto['name'];
                    $type           = $foto['type'];
                    $url_temp       = $foto['tmp_name'];
                    $imgPortada     = 'portada_categoria.png';


                    if($nombre_foto != ''){
                        //md5 es para poder encriptar la fecha
                        $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                    }

                    if($intIdcategoria == 0) {
                        //Crear
                        $request_categoria = $this->model->insertCategoria($strCategoria, $strDescripcion, $imgPortada ,$intStatus);
                        $option = 1;
        
                    } else {
                        //Actualizar
                        $request_categoria = $this->model->updateCategoria($intIdcategoria, $strCategoria, $strDescripcion, $imgPortada , $intStatus);
                        $option = 2;
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