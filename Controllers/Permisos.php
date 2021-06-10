<?php

    class Permisos extends Controllers{
        public function __construct(){

            parent::__construct();


        }

        public function getPermisosRol(int $idrol)
        {
            $rolid = intval($idrol);

            #Verifica si tiene un rolid válido
            if($rolid > 0){

                $arrModulos     = $this->model->selectModulos();

                $arrPemisosRol  = $this->model->selectPermisosRol($rolid);

                dep($arrModulos);
                dep($arrPemisosRol);

            }

        }

    }

?>