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
    const SMONEY = "S/";
    const SDOLAR = "$";
    const CURRENCY = "USD";
    const CONVERTDOLAR = 0.26;

    //Api Paypal
    //SANBOX PAYPAL
    const IDCLIENTE = "AUGQ4oNSCiUc4m_lR-r354eXnJYdqN-LLOo428f21sqGY3H-yS5CAJ1eHuRLZM-OCQZ3Gz33YEL-lEIm";
    //LIVE PAYPAL
    //const IDCLIENTE = "ASEU67ep3VL0Mu4r6N1kBD88izG0CFS-Pslt_7b9B7eU_X3ILyA4HrXu2WPqZfaVC-9CBuPGgGDgPqHe";

    //Datos envío de correo
    const NOMBRE_REMITENTE  = "Tienda Virtual";
    const EMAIL_REMITENTE   = "no-reply@edankia.store";
    const NOMBRE_EMPRESA    = "SISTEMA DE VENTAS EDANKIA STORE";
    const WEB_EMPRESA       = "www.edankia.store";

    //Datos Empresa
    const DIRECCION     = "Calle Hipolito Unanue #802, Santa Rosa, Chiclayo, Perú";
    const TELEMPRESA    = "+51 938724975";
    const EMAIL_EMPRESA = "yoexereliasmoranurcia@gmail.com";
    const EMAIL_PEDIDOS = "yoexereliasmoranurcia@gmail.com";

    //IDs que se mostrarán en el Slider y banner
    const CAT_SLIDER = "1,25,26,27,28,29";
    const CAT_BANNER = "1,9,25,26,27,28,29";

    //Datos para Encriptar / Desencriptar
    const KEY               = "edankia";
    const METHODENCRIPT     = "AES-128-ECB";

    //Envío
    const COSTOENVIO    = 0;

?>