<?php

    class UsuariosModel extends Mysql{

        private $intIdUsuario;
        private $strIdentificacion;
        private $strNombre;
        private $strApellido;
        private $intTelefono;
        private $strEmail;
        private $strPassword;
        private $strToken;
        private $intTipoId;
        private $intStatus;

        public function __construct(){

            parent::__construct();

        }

        public function insertUsuario(string $identificacion, string $nombre, string $apellido, string $telefono, string $email, string $password, int $tipoid, int $status)
        {
            $this->strIdentificacion    = $identificacion;
            $this->strNombre            = $nombre;
            $this->strApellido          = $apellido;
            $this->intTelefono          = $telefono;
            $this->strEmail             = $email;
            $this->strPassword          = $password;
            $this->intTipoId            = $tipoid;
            $this->intStatus            = $status;

            $return = 0;

            $sql        = "SELECT * FROM persona WHERE email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";

            $request    = $this->select_all($sql);


            if( empty($request) )
            {
                $query_insert   = "INSERT INTO persona(identificacion, nombres, apellidos, telefono, email_user, password, rolid, status) VALUES (?,?,?,?,?,?,?,?) ";

                $arrData    = array(
                    $this->strIdentificacion,
                    $this->strNombre,
                    $this->strApellido,
                    $this->intTelefono,
                    $this->strEmail,
                    $this->strPassword,
                    $this->intTipoId,
                    $this->intStatus
                );

                $request_insert = $this->insert($query_insert, $arrData);
                $return         = $request_insert;

            } else {
                $return     = "exist";
            }
            return $return;
        }

        public function selectUsuarios()
        {
            $sql    =  "SELECT p.idpersona, p.identificacion, p.nombres, p.apellidos, p.telefono, p.email_user, p.status, r.nombrerol 
                        FROM persona p
                        INNER JOIN rol r
                        ON p.rolid = r.idrol
                        WHERE p.status != 0 ";

            $request    = $this->select_all($sql);

            return $request;
            
        }

    }

?>