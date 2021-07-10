<?php

    //Retorna la url del proyecto
    function base_url()
    {
        return BASE_URL;
    }

    //Función para buscar imágenes
    function media()
    {
        return BASE_URL."/Assets";
    }


    function headerAdmin($data="")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once($view_header);
    }

    function footerAdmin($data="")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once($view_footer);
    }

    //Nuestra información formateada
    function dep($data)
    {
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');

        return $format;
    }

    function getModal(string $nameModal, $data)
    {
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;
    }

    //Envía en email para la recuperación de la contraseña
    function sendEmail($data, $template)
    {
        $asunto         = $data['asunto'];
        $emailDestino   = $data['email'];
        $empresa        = NOMBRE_REMITENTE;
        $remitente      = EMAIL_REMITENTE;
        
        #ENVÍO DE CORREO ELECTRÓNICO
        //ENCABEZADOS PARA QUE EL CORREO SE ENVÍE CORRECTAMENTE
        $de = "MIME-Version: 1.0\r\n";
        #Tipo de contenido que se va a enviar
        $de.= "Content-type: text/html; charset=UTF-8\r\n";
        #Sirve para indicar quien esta enviando el correo
        $de.= "From: {$empresa} <{$remitente}>\r\n";

        //Cargar en memoria o en buffer un archivo
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        //devuelve el archivo que se ha cargado
        $mensaje    = ob_get_clean();
        //Función que hace el envío de correos
        $send       = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }

    function getPermisos(int $idmodulo)
    {
        # code...
        require_once("Models\PermisosModel.php");
        $objPermisos    = new PermisosModel();
        $idrol          = $_SESSION['userData']['idrol'];
        $arrPermisos    = $objPermisos->permisosModulo($idrol);

        $permisos       = '';
        $permisosMod    = '';

        if (count($arrPermisos) > 0) 
        {
            $permisos       = $arrPermisos;
 
            $permisosMod    = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
        }

        $_SESSION['permisos']   = $permisos;
        $_SESSION['permisosMod']= $permisosMod;
    }

    //Elimina exceso de espacios entre palabras 
    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }

    //Genera una contraseña de 10 caracteres
    function passGenerator($length = 10)
    {
        $pass = "";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }

    //Geenera un token
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }

    //Formato para valores monetarios
    function formatMoney($cantidad){
        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }

?>