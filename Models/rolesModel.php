<?php

    class RolesModel extends Mysql
    {
        public $intIdrol;
        public $strRol;
        public $strDescripcion;
        public $intStatus;

        public function __construct(){

            parent::__construct();

        }

        public function selectRoles()
        {
            $whereAdmin = "";
            if( $_SESSION['idUser'] != 1 )
            {
                $whereAdmin = " AND idrol != 1 ";
            }

            $sql = "SELECT * FROM rol WHERE status != 0 ".$whereAdmin;
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectRol(int $idrol)
        {
            # Busca Rol
            $this->intIdrol = $idrol;
            $sql = "SELECT * FROM rol WHERE idrol = $this->intIdrol";
            $request = $this->select($sql);

            return $request;

        }

        public function insertRol(string $rol, string $descripcion, int $status)
        {
            # code...
            $return = "";
            $this->strRol         = $rol;
            $this->strDescripcion = $descripcion;
            $this->intStatus      = $status;

            $sql = "SELECT * FROM rol WHERE nombrerol = '$this->strRol' ";

            $request = $this->select_all($sql);

            if(empty($request)){
                $query_insert   = "INSERT INTO rol(nombrerol,descripcion,status) VALUES (?,?,?)";
                $arrData        = array($this->strRol, $this->strDescripcion, $this->intStatus);
                $request_insert = $this->insert($query_insert, $arrData); 
                $return = $request_insert;

            } else {
                $return = "exist";
            }

            return $return;
        }

        public function updateRol(int $idrol, string $rol, string $descripcion, int $status)
        {
            # code...
            $this->intIdrol         = $idrol;
            $this->strRol           = $rol;
            $this->strDescripcion   = $descripcion;
            $this->intStatus        = $status;

            $sql = "SELECT * FROM rol WHERE nombrerol= '$this->strRol' AND idrol != $this->intIdrol ";

            $request = $this->select_all($sql);

            if (empty($request)) {
                # code...
                $sql = "UPDATE rol SET nombrerol= ?, descripcion = ?, status = ? WHERE idrol = $this->intIdrol ";
                $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);

                $request = $this->update($sql,$arrData);
            } else{
                $request = "exist";
            }

            return $request;
        }

        public function deleteRol(int $idrol)
        {
            # code...
            $this->intIdrol = $idrol;
            #verificamos si el rol está asociado a un usuario, integridad referencial de los datos
            $sql        = "SELECT * FROM persona WHERE rolid = $this->intIdrol";
            $request    = $this->select_all($sql);

            if (empty($request)) 
            {
                # code...
                $sql        = "UPDATE rol SET status = ? WHERE idrol = $this->intIdrol";
                $arrData    = array(0);
                $request    = $this->update($sql, $arrData);
                
                if ($request) 
                {
                    $request = 'ok';
                } else 
                {
                    $request = 'error';
                }
                

            } else {
                $request = 'exist';
            }
            
            return $request;
        }

    }

?>