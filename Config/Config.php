<?php

    const BASE_URL = "http://localhost/tienda_virtual";


    //Zona horaria
    date_default_timezone_set('America/Lima');
    
    //Datos a la conexión de la  base de datos
    const DB_HOST     = "localhost";
    const DB_NAME     = "db_tiendavirtual";
    const DB_USER     = "admin";
    const DB_PASSWORD = "admin";
    const DB_CHARSET  = "utf8"; 

    //Delimitadores decimal y millar Ej. 24,1989.0
    const SPD = ".";
    const SPM = ",";

    //Simbolo de moneda
    const SMONEY = "S/.";

    //Datos envío de correo
    const NOMBRE_REMITENTE  = "Tienda Virtual";
    const EMAIL_REMITENTE   = "no-reply@edankia.store";
    const NOMBRE_EMPRESA    = "Tienda Virtual";
    const WEB_EMPRESA       = "www.edankia.store";

?>