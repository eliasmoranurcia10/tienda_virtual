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

                            $arrData =  $this->model->sessionLogin($_SESSION['idUser']);
                            $_SESSION['userData'] = $arrData;

                            $arrResponse    = array('status' => true , 'msg' => 'ok');
                        } else {
                            $arrResponse    = array('status' => false, 'msg' => 'Usuario inactivo');
                        }
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE );
            }

            die();
        }

        public function resetPass()
        {
            dep($_POST);
            die();
        }

    }

?>