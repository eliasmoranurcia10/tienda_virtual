<?php

    class LoginModel extends Mysql{

        private $intIdUsuario;
        private $strUsuario;
        private $strPassword;
        private $strToken;

        public function __construct(){

            parent::__construct();

        }

        public function loginUser(string $usuario, string $password)
        {
            $this->strUsuario   = $usuario;
            $this->strPassword  = $password;

            $sql = "SELECT idpersona, status FROM persona WHERE 
                    email_user = '$this->strUsuario' AND 
                    password = '$this->strPassword' AND 
                    status != 0 ";

            $request = $this->select($sql);

            return $request;
        }

    }

?>