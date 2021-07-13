<?php

    class Login extends Controllers{
        public function __construct(){

            session_start();

            //Verificar si la session esta abierta, si está abierta o es true entonces nos redirecciona al dashboard
            if( isset($_SESSION['login']) )
            {
                header('location: ' . base_url().'/dashboard');
            }

            parent::__construct();

        }

        public function login(){

            $data['page_tag']    = "Login - Tienda Virtual";
            $data['page_title']  = "Tienda Virtual - Edankia";
            $data['page_name']   = "login";
            $data['page_functions_js']  = "functions_login.js";
            $this->views->getView($this,"login",$data);

        }

        public function loginUser()
        {
            #dep($_POST);

            if($_POST){

                if( empty($_POST['txtEmail'] ) || empty( $_POST['txtPassword'] ) )
                {
                    $arrResponse    = array('status' => false , 'msg' => 'Error de datos');

                } else {
                    $strUsuario     = strtolower( strClean($_POST['txtEmail']) );
                    $strPassword    = hash("SHA256", $_POST['txtPassword']);

                    $requestUser    = $this->model->loginUser($strUsuario, $strPassword);

                    if( empty($requestUser) ){
                        $arrResponse    = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecta.');
                    } else {
                        $arrData = $requestUser;

                        if( $arrData['status'] == 1 ){
                            $_SESSION['idUser'] = $arrData['idpersona'];
                            $_SESSION['login']  = true;

                            $this->model->sessionLogin($_SESSION['idUser']);

                            sessionUser($_SESSION['idUser']);

                            $arrResponse    = array('status' => true , 'msg' => 'ok');
                        } else {
                            $arrResponse    = array('status' => false, 'msg' => 'Usuario inactivo');
                        }
                    }
                }
                //El sleep es para en caso se demore el servidor en proporcionar los datos
                //sleep(5);

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE );
            }

            die();
        }

        public function resetPass()
        {
            if($_POST)
            {

                if( empty($_POST['txtEmailReset']) )
                {
                    $arrResponse    = array('status' => false, 'msg' => 'Error de datos');
                } else {

                    $token      = token();
                    $strEmail   = strtolower( strClean($_POST['txtEmailReset']) );
                    //Comprobar si existe el email
                    $arrData    = $this->model->getUserEmail($strEmail);
                    //Si arrData esta vacio entonces se responderá con usuario no existente
                    if( empty($arrData) ){
                        $arrResponse    = array('status' => false, 'msg' => 'Usuario no existente.');

                    } else{
                        $idpersona      = $arrData['idpersona'];
                        $nombreUsuario  = $arrData['nombres'].' '. $arrData['apellidos'];

                        $url_recovery   = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;

                        //Modifico el token de la persona
                        $requestUpdate  = $this->model->setTokenUser($idpersona, $token);

                        $dataUsuario    = array(
                            'nombreUsuario' => $nombreUsuario,
                            'email'         => $strEmail,
                            'Asunto'        => 'Recuperar cuenta - '.NOMBRE_REMITENTE,
                            'url_recovery'  => $url_recovery
                        );

                        if( $requestUpdate )
                        {
                            //HACER CAMBIOS AL LANZAR AL HOSTING - SE ACTIVA LA FUNCION "$sendmail" Y SE ACTIVA EL IFELSE
                            
                            //Esta función se encuentra en Helpers
                            //$sendmail = sendEmail($dataUsuario, 'email_cambioPassword');

                            $arrResponse    = array('status' => true , 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
                            /*
                            if( $sendmail ){

                                $arrResponse    = array('status' => true , 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
                            } else {
                                $arrResponse    = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                            }
                            */
                            

                        } else {
                            $arrResponse    = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                        }

                    }
                }
                //sleep(3);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            
            die();
        }

        public function confirmUser(string $params)
        {

            if( empty($params) ){
                header('Location: '.base_url() );
            } else {
                //Crear un array de los datos que están separados por las comas.
                $arrParams      = explode(',',$params);

                $strEmail       = strClean( $arrParams[0] );
                $strToken       = strClean( $arrParams[1] );

                $arrResponse    = $this->model->getUsuario($strEmail, $strToken); 

                if ( empty($arrResponse) )
                {
                    header('Location: '.base_url() );
                } else {
                    $data['page_tag']    = "Cambiar contraseña";
                    $data['page_name']   = "cambiar_contrasenia";
                    $data['page_title']  = "Cambiar Contraseña";
                    $data['email']  = $strEmail;
                    $data['token']  = $strToken;
                    $data['idpersona']   = $arrResponse['idpersona'];

                    $data['page_functions_js']  = "functions_cambiar_password.js";

                    $this->views->getView($this,"cambiar_password",$data);
                }
        
            }

            die();
        }

        public function setPassword()
        {
            if( empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])  ) {

                $arrResponse = array('status' => false, 'msg' => 'Error de datos' );

            } else {

                $intIdpersona       = intval($_POST['idUsuario']);
                $strPassword        = $_POST['txtPassword'];
                $strPasswordConfirm = $_POST['txtPasswordConfirm'];
                $strEmail           = strClean($_POST['txtEmail']);
                $strToken           = strClean($_POST['txtToken']);

                if( $strPassword != $strPasswordConfirm ){

                    $arrResponse    = array('status' => false , 'msg' => 'Las contraseñas no son iguales.');

                } else {

                    $arrResponseUser    = $this->model->getUsuario($strEmail, $strToken); 

                    if ( empty($arrResponseUser) )
                    {
                        $arrResponse    = array('status' => false , 'msg' => 'Error de datos.');
                    } else {

                        $strPassword    = hash("SHA256", $strPassword);
                        $requestPass    = $this->model->insertPassword($intIdpersona, $strPassword);

                        if ($requestPass) {
                            # code...
                            $arrResponse    = array('status' => true , 'msg' => 'Contraseña actualizada con éxito.');
                        } else {
                            # code...
                            $arrResponse    = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente más tarde.' );
                        }
                    }
                }

            }
            sleep(3);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

    }

?>