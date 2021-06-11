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

                #CÓDIGO PARA DEPURAR LA LISTA DE MÓDULOS Y LOS PERMISOS DEL ROL
                #dep($arrModulos);
                #dep($arrPemisosRol);

                $arrPermisos    = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
                $arrPermisoRol  = array('idrol' => $rolid);

                if (empty($arrPemisosRol)) 
                {
                    for ($i=0; $i < count($arrModulos) ; $i++) { 
                        
                        $arrModulos[$i]['permisos'] = $arrPermisos;

                    }
                } else {
                    for ($i=0 ; $i < count($arrModulos) ; $i++ ) 
                    {
                        $arrPemisosRol = array(
                            'r' => $arrPemisosRol[$i]['r'],
                            'w' => $arrPemisosRol[$i]['w'],
                            'u' => $arrPemisosRol[$i]['u'],
                            'd' => $arrPermisoRol[$i]['d']
                        );

                        if($arrModulos[$i]['idmodulo'] == $arrPemisosRol[$i]['moduloid'])
                        {
                            $arrModulos[$i]['permisos'] = $arrPermisos;
                        }

                    }
                }

                $arrPermisoRol['modulos'] = $arrModulos;
                //Colocamos los modals mediante Helpers, enviamos el array en el modal
                $html = getModal("modalPermisos",$arrPermisoRol);
                //dep($arrPermisoRol);

            }
            die();

        }

        public function setPermisos()
        {
            # code...
            dep($_POST);
            die();
        }

    }

?>