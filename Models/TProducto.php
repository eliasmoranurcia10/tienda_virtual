<?php
    require_once("Libraries/Core/Mysql.php");

    trait TProducto{

        private $con;
        private $strCategoria;
        private $intIdcategoria;

        public function getProductosT()
        {
            $this->con = new Mysql();

            $sql    =  "SELECT 
                            p.idproducto,
                            p.codigo,
                            p.nombre,
                            p.descripcion,
                            p.categoriaid,
                            c.nombre as categoria,
                            p.precio,
                            p.stock
                        FROM producto p
                        INNER JOIN categoria c
                        ON p.categoriaid = c.idcategoria
                        WHERE p.status != 0 ";

            $request= $this->con->select_all($sql);

            if (count($request)>0) {
                for ($c=0; $c < count($request) ; $c++) { 
                    $intIdProducto = $request[$c]['idproducto'];
                    $sqlImg = " SELECT img
                                FROM imagen
                                WHERE productoid = $intIdProducto";

                    $arrImg = $this->con->select_all($sqlImg);

                    if (count($arrImg)>0) {
                        for ($i=0; $i < count($arrImg) ; $i++) { 
                            $arrImg[$i]['url_image']    = media().'/images/uploads/'. $arrImg[$i]['img'];
                        }
                    }
                    $request[$c]['images'] = $arrImg;
                }
                
            }

            return $request;
        }

        public function getProductosCategoriaT(string $categoria)
        {
            $this->strCategoria = $categoria;
            $this->con = new Mysql();

            $sqlcat = "SELECT idcategoria FROM categoria WHERE nombre = '{$this->strCategoria}'";
            $request = $this->con->select($sqlcat);

            if (!empty($request)) {
                # code...
                $this->intIdcategoria = $request['idcategoria'];

                $sql    =  "SELECT 
                            p.idproducto,
                            p.codigo,
                            p.nombre,
                            p.descripcion,
                            p.categoriaid,
                            c.nombre as categoria,
                            p.precio,
                            p.stock
                        FROM producto p
                        INNER JOIN categoria c
                        ON p.categoriaid = c.idcategoria
                        WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria ";

                $request= $this->con->select_all($sql);

                if (count($request)>0) {
                    for ($c=0; $c < count($request) ; $c++) { 
                        $intIdProducto = $request[$c]['idproducto'];
                        $sqlImg = " SELECT img
                                    FROM imagen
                                    WHERE productoid = $intIdProducto";

                        $arrImg = $this->con->select_all($sqlImg);

                        if (count($arrImg)>0) {
                            for ($i=0; $i < count($arrImg) ; $i++) { 
                                $arrImg[$i]['url_image']    = media().'/images/uploads/'. $arrImg[$i]['img'];
                            }
                        }
                        $request[$c]['images'] = $arrImg;
                    }
                    
                }

            }

            return $request;
        }

    }

?>