<?php

    class Usuarios extends Controllers{
        public function __construct(){

            parent::__construct();


        }

        public function Usuarios(){

            $data['page_tag']    = "Usuarios";
            $data['page_title']  = "USUARIOS <small>Tienda Virtual</small>";
            $data['page_name']   = "usuarios";
            
            $this->views->getView($this,"usuarios",$data);

        }

        public function setUsuario()
        {
            //Validar si se ha realizado una petición vía POST
            if($_POST){
                //dep($_POST);

                if ( empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) ) {

                    $arrResponse    =  array("status" => false, "msg" => 'Datos incorrectos.');

                } else {

                    $strIdentificacion  = strClean($_POST['txtIdentificacion']);
                    $strNombre          = ucwords( strClean($_POST['txtNombre']) );
                    $strApellido        = ucwords( strClean($_POST['txtApellido']) );
                    $intTelefono        = intval(strClean($_POST['txtTelefono']));
                    $strEmail           = strtolower( strClean($_POST['txtEmail']) );
                    $intTipoId          = intval(strClean($_POST['listRolid']));
                    $intStatus          = intval(strClean($_POST['listStatus']));

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

                    if( $request_user > 0)
                    {
                        $arrResponse    = array('status' => true , 'msg' => 'Datos guardados correctamente.');
                        
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
                if($arrData[$i]['status'] == 1)
                {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                $arrData[$i]['options'] = '<div class="text-center">
                <button class="btn btn-info btn-sm btnViewUsuario" us="'.$arrData[$i]['idpersona'].'" title="Ver Usuario"><i class="far fa-eye"></i></button>
                <button class="btn btn-primary btn-sm btnEditUsuario" us="'.$arrData[$i]['idpersona'].'" title="Editar Usuario"><i class="fas fa-user-edit"></i></i></button>
				<button class="btn btn-danger btn-sm btnDelUsuario" us="'.$arrData[$i]['idpersona'].'" title="Eliminar Usuario"><i class="far fa-trash-alt"></i></button>                           
                </div>';
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

    }

?>