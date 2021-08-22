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

            dep($_POST);
            dep($_FILES);
            exit;

            //Limpiar toda la cadena para dejar data pura, esta función es creada en los Helpers
            $intIdrol       = intval($_POST['idRol']);
            $strRol         = strClean($_POST['txtNombre']);
            $strDescripcion = strClean($_POST['txtDescripcion']);
            $intStatus      = intval($_POST['listStatus']);

            if($intIdrol == 0) {
                //Crear
                $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
                $option = 1;

            } else {
                //Actualizar
                $request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intStatus);
                $option = 2;
            }


            //Evaluar si ya se insertó el registro
            if($request_rol > 0) {

                if($option == 1){
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                } else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                }

            } else if($request_rol == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
            } else {
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos');
            }

            //sleep(5);
            //Retornar el array en formato json
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);


            //detener el proceso
            die();

        }
    }

?>