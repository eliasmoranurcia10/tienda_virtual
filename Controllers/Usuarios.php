<?php

    class Usuarios extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();

            // Si la session esta vacía o muestra false entonces nos redirecciona a login
            if( empty($_SESSION['login']) )
            {
                header('location: ' . base_url().'/login');
            }

            //Llamar a la funcion para asignar los permisos
            getPermisos(2);
        }

        public function Usuarios(){

            if( empty($_SESSION['permisosMod']['r']) ) 
            {
                header("Location:" .base_url().'/dashboard' );
            }
            $data['page_tag']    = "Usuarios";
            $data['page_title']  = "USUARIOS <small>Tienda Virtual</small>";
            $data['page_name']   = "usuarios";
            $data['page_functions_js']  = "functions_usuarios.js";
            
            $this->views->getView($this,"usuarios",$data);

        }

        public function setUsuario()
        {
            //Validar si se ha realizado una petición vía POST
            if($_POST){

                if ( empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) ) {

                    $arrResponse    =  array("status" => false, "msg" => 'Datos incorrectos.');

                } else {

                    $idUsuario          = intval($_POST['idUsuario']);
                    $strIdentificacion  = strClean($_POST['txtIdentificacion']);
                    $strNombre          = ucwords( strClean($_POST['txtNombre']) );
                    $strApellido        = ucwords( strClean($_POST['txtApellido']) );
                    $intTelefono        = intval(strClean($_POST['txtTelefono']));
                    $strEmail           = strtolower( strClean($_POST['txtEmail']) );
                    $intTipoId          = intval(strClean($_POST['listRolid']));
                    $intStatus          = intval(strClean($_POST['listStatus']));

                    if($idUsuario == 0)
                    {
                        $option     = 1;

                        //hash tiene la función de encriptar la contraseña
                        $strPassword        = empty( $_POST['txtPassword'] ) ? hash("SHA256", passGenerator() ) : hash("SHA256", $_POST['txtPassword']);

                        $request_user       = $this->model->insertUsuario(
                            $strIdentificacion,
                            $strNombre,
                            $strApellido,
                            $intTelefono,
                            $strEmail,
                            $strPassword,
                            $intTipoId,
                            $intStatus
                        );

                    } else {

                        $option     = 2;

                        $strPassword        = empty( $_POST['txtPassword'] ) ? "" : hash("SHA256", $_POST['txtPassword']);

                        $request_user       = $this->model->updateUsuario(
                            $idUsuario,
                            $strIdentificacion,
                            $strNombre,
                            $strApellido,
                            $intTelefono,
                            $strEmail,
                            $strPassword,
                            $intTipoId,
                            $intStatus
                        );

                    }

                    

                    if( $request_user > 0)
                    {
                        if($option == 1 ){
                            $arrResponse    = array('status' => true , 'msg' => 'Datos guardados correctamente.');
                        } else {
                            $arrResponse    = array('status' => true , 'msg' => 'Datos Actualizados correctamente.');
                        }
                        
                    } else if( $request_user == 'exist' )
                    {
                        $arrResponse    = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');

                    } else 
                    {
                        $arrResponse    = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                    }

                }
                //Convertir en formato JSON la variable arrResponse para retornar la función
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            }
            die();
        }

        public function getUsuarios()
        {
            $arrData    = $this->model->selectUsuarios();

            //dep($arrData);
            
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

                if( $_SESSION['permisosMod']['r'] )
                {
                    $btnView    = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idpersona'].')" title="Ver Usuario"><i class="far fa-eye"></i></button>';
                }

                if( $_SESSION['permisosMod']['u'] )
                {
                    //ELADMINISTRADOR NORMAL NO PUEDEN MODIFICAR A OTROS ADMINISTRADOR NI MODIFICARSE A SÍ MISMO
                    if ( ($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || 
                        ($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ) 
                    {
                        $btnEdit    = '<button class="btn btn-primary btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['idpersona'].')" title="Editar Usuario"><i class="fas fa-user-edit"></i></i></button>';
                    } else {
                        $btnEdit    = '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-user-edit"></i></i></button>';
                    }

                    
                }

                if( $_SESSION['permisosMod']['d'] )
                {
                    
                    if ( ($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || 
                        ($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and 
                        ($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'] ) ) 
                    {
                        $btnDelete  = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar Usuario"><i class="far fa-trash-alt"></i></button>';
                    } else{
                        $btnDelete  = '<button class="btn btn-secondary btn-sm" disabled><i class="far fa-trash-alt"></i></button>';
                    }
                    
                }

                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE); // Forzarlo a que se convierta e un objeto
            
            die(); //Finalizar el proceso
        }

        public function getUsuario(int $idpersona)
        {
            # echo $idpersona;
            
            $idusuario = intval($idpersona);

            if($idusuario > 0){

                $arrData    = $this->model->selectUsuario($idusuario);

                if(empty($arrData))
                {
                    $arrResponse    = array('status' => false, 'msg' => 'Datos no encontrados.');
                
                } else
                {
                    $arrResponse    = array('status' => true  , 'data' => $arrData);
                }

                //Convertir en formato json el array
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();

        }

        public function delUsuario()
        {
            if( $_POST )
            {
                $intIdpersona   = intval($_POST['idUsuario']);
                $requestDelete  = $this->model->deleteUsuario($intIdpersona);

                if( $requestDelete ){

                    $arrResponse    = array('status' => true , 'msg' => 'Se ha eliminado el usuario.');

                } else {

                    $arrResponse    = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
                }

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

    }

?>