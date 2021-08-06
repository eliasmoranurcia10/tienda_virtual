
let tableUsuarios;
let rowTable = "";
//Añadimos la variable que contiene un cargador
let divLoading = document.querySelector("#divLoading");

//Indica que al momento de cargar la vista, va a agregar los elementos que se van a configurar dentro de la función
document.addEventListener('DOMContentLoaded', function(){

    //Se cargan las tablas
	tableUsuarios = $('#tableUsuarios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpersona"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"email_user"},
            {"data":"telefono"},
            {"data":"nombrerol"},
            {"data":"status"},
            {"data":"options"}
        ],

        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            },
            {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success"
            },
            {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger"
            },
            {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> csv",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info"
            }
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //Agregar usuarios - en el formulario de usuarios
    if (document.querySelector("#formUsuario")) {

        let formUsuario = document.querySelector("#formUsuario");

        //Indica que le estamos activando ese evento
        formUsuario.onsubmit = function (e) {  
            //Indica que al momento de darle click al botón "Guardar", evita que se recarge la página
            e.preventDefault();

            let strIdentificacion   = document.querySelector('#txtIdentificacion').value;
            let strNombre           = document.querySelector('#txtNombre').value;
            let strApellido         = document.querySelector('#txtApellido').value;
            let strEmail            = document.querySelector('#txtEmail').value;
            let intTelefono         = document.querySelector('#txtTelefono').value;
            let intTipousuario      = document.querySelector('#listRolid').value;
            //let strPassword         = document.querySelector('#txtPassword').value;

            let intStatus           = document.querySelector('#listStatus').value;

            if (strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '') {

                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            //Verifica que todos estos elementos no tengan la clase is-invalid
            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++){

                if(elementsValid[i].classList.contains('is-invalid')){
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }

            }

            //muestra un cargador
            divLoading.style.display = "flex";

            let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl     = base_url + '/Usuarios/setUsuario';
            let formData    = new FormData(formUsuario);

            //Abrimos la conexión y enviamos
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            //OBTENER LA RESPUESTA DEL CONTROLADOR
            request.onreadystatechange  = function(){

                if (request.readyState == 4 && request.status == 200) {
                    
                    let objData     = JSON.parse(request.responseText);

                    if (objData.status) 
                    {
                        
                        if(rowTable == ""){
                            //Esta acción se realiza si no se está editando y se está creando nuevo usuario: asi que se recarga la página
                            tableUsuarios.api().ajax.reload();
                        } else{
                            //A continuación se actualiza la tabla con el usuario modificado sin recargar la tabla, quedandonos en la misma página :Para Elias del futuro :) 
                            let htmlStatus  = intStatus == 1? 
                            '<span class="badge badge-success">Activo</span>':'<span class="badge badge-danger">Inactivo</span>';

                            rowTable.cells[1].textContent   = strNombre;
                            rowTable.cells[2].textContent   = strApellido;
                            rowTable.cells[3].textContent   = strEmail;
                            rowTable.cells[4].textContent   = intTelefono;
                            rowTable.cells[5].textContent   = document.querySelector('#listRolid').selectedOptions[0].text;
                            rowTable.cells[6].innerHTML     = htmlStatus; 
                        }
                        //Ocultar el modal
                        $('#modalFormUsuario').modal("hide");
                        //resetear todos los campos
                        formUsuario.reset();
                        //Mostrar la alerta
                        swal("Usuarios", objData.msg, "success");

                        
                    
                    } else {
                        swal("Error", objData.msg, "error");
                    }

                }

                //Oculta el cargador
                divLoading.style.display = "none";
                return false;

            }
        }
    }

    //Actualizar Perfil
    if (document.querySelector("#formPerfil")) {

        let formPerfil = document.querySelector("#formPerfil");

        //Indica que le estamos activando ese evento
        formPerfil.onsubmit = function (e) {  
            //Indica que al momento de darle click al botón "Guardar", evita que se recarge la página
            e.preventDefault();

            let strIdentificacion   = document.querySelector('#txtIdentificacion').value;
            let strNombre           = document.querySelector('#txtNombre').value;
            let strApellido         = document.querySelector('#txtApellido').value;
            let intTelefono         = document.querySelector('#txtTelefono').value;
            let strPassword         = document.querySelector('#txtPassword').value;
            let strPasswordConfirm  = document.querySelector('#txtPasswordConfirm').value;

            if (strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '' ) {

                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            if( strPassword != "" || strPasswordConfirm != "" ){
                
                if( strPassword != strPasswordConfirm ){
                    swal("Atención", "Las contraseñas no son iguales.", "error");
                    return false;
                }

                if( strPassword.length < 5 ){

                    swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
                    return false;
                }
            }

            //Verifica que todos estos elementos no tengan la clase is-invalid
            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++){

                if(elementsValid[i].classList.contains('is-invalid')){
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }

            }
            //muestra un cargador
            divLoading.style.display = "flex";

            let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl     = base_url + '/Usuarios/putPerfil';
            let formData    = new FormData(formPerfil);

            //Abrimos la conexión y enviamos
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            
            //OBTENER LA RESPUESTA DEL CONTROLADOR
            request.onreadystatechange  = function(){

                if (request.readyState != 4) return;

                if (request.status == 200) {
                    
                    let objData     = JSON.parse(request.responseText);

                    if (objData.status) 
                    {
                        $('#modalFormPerfil').modal('hide');

                        swal({
                            title               : "",
                            text                : objData.msg,
                            type                : "success",
                            confirmButtonText   : "Aceptar",
                            closeOnConfirm      : false,

                        },function(inConfirm){

                            if(inConfirm){
                                location.reload();
                            }
                        });
                    
                    } else {
                        swal("Error", objData.msg, "error");
                    }

                }
                //Oculta el cargador
                divLoading.style.display = "none";
                return false;

            }
        }
    }

    //Actualizar Datos Fiscales
    if (document.querySelector("#formDataFiscal")) {

        let formDataFiscal = document.querySelector("#formDataFiscal");

        //Indica que le estamos activando ese evento
        formDataFiscal.onsubmit = function (e) {  
            //Indica que al momento de darle click al botón "Guardar", evita que se recarge la página
            e.preventDefault();

            let strNit          = document.querySelector('#txtNit').value;
            let strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
            let strDirFiscal    = document.querySelector('#txtDirFiscal').value;

            if (strNit == '' || strNombreFiscal == '' || strDirFiscal == '' ) {

                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            //muestra un cargador
            divLoading.style.display = "flex";

            let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl     = base_url + '/Usuarios/putDFiscal';
            let formData    = new FormData(formDataFiscal);

            //Abrimos la conexión y enviamos
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            
            //OBTENER LA RESPUESTA DEL CONTROLADOR
            request.onreadystatechange  = function(){

                if (request.readyState != 4) return;

                if (request.status == 200) {
                    
                    let objData     = JSON.parse(request.responseText);

                    if (objData.status) 
                    {
                        $('#modalFormPerfil').modal('hide');

                        swal({
                            title               : "",
                            text                : objData.msg,
                            type                : "success",
                            confirmButtonText   : "Aceptar",
                            closeOnConfirm      : false,

                        },function(inConfirm){

                            if(inConfirm){
                                location.reload();
                            }
                        });
                    
                    } else {
                        swal("Error", objData.msg, "error");
                    }

                }

                //Oculta el cargador
                divLoading.style.display = "none";
                return false;

            }
        }
    }

}, false);


window.addEventListener('load', function() {
    fntRolesUsuarios();
    /*fntViewUsuario();
    fntEditUsuario();
    fntDelUsuario();*/
}, false);

//Carga los roles en el select para ser seleccuonados en el modal
function fntRolesUsuarios() {

    if ( document.querySelector('#listRolid') ) {

        let ajaxUrl = base_url + '/Roles/getSelectRoles';
        let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

        request.open("GET",ajaxUrl, true);
        request.send();

        request.onreadystatechange = function(){

            if(request.readyState == 4 && request.status == 200){

                document.querySelector('#listRolid').innerHTML  = request.responseText;
                //document.querySelector('#listRolid').value      = 1;

                //Actualizar el select para que se muestren los registros
                $('#listRolid').selectpicker('render');
                //$('#listRolid).selectpicker('refresh');
            }

        }
    }
}

//FUNCIÓN PARA VISUALIZAR A LOS USUARIOS
function fntViewUsuario(idpersona){

    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl     = base_url + '/Usuarios/getUsuario/'+idpersona;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange  = function(){

        //Verifica si se ha devuelto la información
        if(request.readyState==4 && request.status == 200){
            //Convertir el formato JSON en un objeto todo lo que viene en request
            let objData = JSON.parse(request.responseText);

            if(objData.status){

                let estadoUsuario   = objData.data.status == 1 ? '<span class="badge badge-success">Activo</span>':'<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML  = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML          = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML        = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML        = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML           = objData.data.email_user;
                document.querySelector("#celTipoUsuario").innerHTML     = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML          = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML   = objData.data.fechaRegistro;
                $('#modalViewUser').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }

        }

    }

}

//FUNCIÓN PARA EDITAR LOS USUARIOS
function fntEditUsuario(element,idpersona){
    //Se visualiza los elementos padre del usuario elegido en la tabla
    rowTable    = element.parentNode.parentNode.parentNode;

    //rowTable.cells[1].textContent = "Julio";
    //console.log(rowTable);

    document.querySelector('#titleModal').innerHTML     = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
    document.querySelector('#btnText').innerHTML        = "Actualizar";


    //Verificación del navegador 
    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl     = base_url + '/Usuarios/getUsuario/'+idpersona;

    //Abriendo la conexión mediante la petición GET
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange  = function(){

        if(request.readyState==4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

            if(objData.status){

                document.querySelector('#idUsuario').value          = objData.data.idpersona;
                document.querySelector('#txtIdentificacion').value  = objData.data.identificacion;
                document.querySelector('#txtNombre').value          = objData.data.nombres;
                document.querySelector('#txtApellido').value        = objData.data.apellidos;
                document.querySelector('#txtTelefono').value        = objData.data.telefono;
                document.querySelector('#txtEmail').value           = objData.data.email_user;
                document.querySelector('#listRolid').value          = objData.data.idrol;

                //REnderiza nuevamente los options y asigne el valor que se le está colocando
                $('#listRolid').selectpicker('render');

                if (objData.data.status == 1) {
                    document.querySelector('#listStatus').value     = 1;
                } else {
                    document.querySelector('#listStatus').value     = 2;
                }
                $('#listStatus').selectpicker('render');
                
            }

        }

        $('#modalFormUsuario').modal('show');

    }

}

//FUNCION PARA ELIMINAR USUARIO
function fntDelUsuario(idpersona) {


    swal(
        {
            title: "Eliminar Usuario",
            text: "¿Realmente quiere eliminar el Usuario?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "No, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm)
        {

            if(isConfirm){
                //Validamos el navegador - si es firefox o chrome se crea XMLHttpRequest - si es edge o iternet explorer se crea Microsoft.XMLHTTP 
                let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                //Ruta por la cual Llamamos al controlador y a su método delRol
                let ajaxUrl  = base_url+'/Usuarios/delUsuario';
                let strData     = "idUsuario="+idpersona;

                //Abrimos la conexión
                request.open("POST",ajaxUrl, true);
                //La forma cómo se van a enviar los datos
                request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                //Enviamos la solicitud con el parámetro
                request.send(strData);

                //Recibimos la respuesta
                request.onreadystatechange = function(){
                    //Validamos si la operació fué exitosa
                    if(request.readyState == 4 && request.status == 200)
                    {
                        let objData = JSON.parse(request.responseText);

                        if(objData.status)
                        {
                            //Emitir la alerta
                            swal("Eliminar!", objData.msg, "success");
                            //Actualizamos para que se recargue la tabla y sus funciones
                            tableUsuarios.api().ajax.reload();

                        } else {
                            swal("Atención!", objData.msg , "error");
                        }
                    }

                }
            }
            
        }

    );
            
}

function openModal(){
    //Se resetea el rowTable cada vez que se dea click en el nuevo usuario para que no guarde la tabla del usuario elegido
    rowTable = "";

    document.querySelector('#idUsuario').value      = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML    = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    //Limpiar todos los campos
    document.querySelector('#formUsuario').reset();

    //Mostrar el modal
    $('#modalFormUsuario').modal('show');
}

function openModalPerfil() {
    
    $('#modalFormPerfil').modal('show');
}


