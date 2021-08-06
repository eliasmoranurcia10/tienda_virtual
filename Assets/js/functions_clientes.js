
let tableClientes;
//Añadimos la variable que contiene un cargador
let divLoading = document.querySelector("#divLoading");


//Indica que al momento de cargar la vista, va a agregar los elementos que se van a configurar dentro de la función
document.addEventListener('DOMContentLoaded', function(){

    tableClientes = $('#tableClientes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Clientes/getClientes",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpersona"},
            {"data":"identificacion"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"email_user"},
            {"data":"telefono"},
            {"data":"options"},
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

    //Agregar o Editar clientes - en el formulario de clientes
    if (document.querySelector("#formCliente")) {

        let formCliente = document.querySelector("#formCliente");

        //Indica que le estamos activando ese evento
        formCliente.onsubmit = function (e) {  
            //Indica que al momento de darle click al botón "Guardar", evita que se recarge la página
            e.preventDefault();

            let strIdentificacion   = document.querySelector('#txtIdentificacion').value;
            let strNombre           = document.querySelector('#txtNombre').value;
            let strApellido         = document.querySelector('#txtApellido').value;
            let intTelefono         = document.querySelector('#txtTelefono').value;
            let strEmail            = document.querySelector('#txtEmail').value;
            //let strPassword         = document.querySelector('#txtPassword').value;

            let strNit              = document.querySelector('#txtNit').value;
            let strNomFiscal        = document.querySelector('#txtNombreFiscal').value;
            let strDirFiscal        = document.querySelector('#txtDirFiscal').value;

            if (strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || strNit == '' || strNomFiscal == '' || strDirFiscal == '' ) {

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
            let ajaxUrl     = base_url + '/Clientes/setCliente';
            let formData    = new FormData(formCliente);

            //Abrimos la conexión y enviamos
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            //OBTENER LA RESPUESTA DEL CONTROLADOR
            request.onreadystatechange  = function(){

                if (request.readyState == 4 && request.status == 200) {
                    
                    let objData     = JSON.parse(request.responseText);

                    if (objData.status) 
                    {
                        //Ocultar el modal
                        $('#modalFormCliente').modal("hide");
                        //resetear todos los campos
                        formCliente.reset();
                        //Mostrar la alerta
                        swal("Usuarios", objData.msg, "success");

                        tableClientes.api().ajax.reload();
                    
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



//FUNCIÓN PARA VISUALIZAR A LOS USUARIOS
function fntViewInfo(idpersona){

    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl     = base_url + '/Clientes/getCliente/'+idpersona;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange  = function(){

        //Verifica si se ha devuelto la información
        if(request.readyState==4 && request.status == 200){
            //Convertir el formato JSON en un objeto todo lo que viene en request
            let objData = JSON.parse(request.responseText);

            if(objData.status){

                document.querySelector("#celIdentificacion").innerHTML  = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML          = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML        = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML        = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML           = objData.data.email_user;
                document.querySelector("#celIde").innerHTML             = objData.data.nit;
                document.querySelector("#celNomFiscal").innerHTML       = objData.data.nombrefiscal;
                document.querySelector("#celDirFiscal").innerHTML       = objData.data.direccionfiscal;
                document.querySelector("#celFechaRegistro").innerHTML   = objData.data.fechaRegistro;

                $('#modalViewCliente').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }

        }

    }

}

//FUNCIÓN PARA EDITAR LOS USUARIOS
function fntEditInfo(idpersona){

    document.querySelector('#titleModal').innerHTML     = "Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
    document.querySelector('#btnText').innerHTML        = "Actualizar";


    //Verificación del navegador 
    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl     = base_url + '/Clientes/getCliente/'+idpersona;

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
                
                document.querySelector('#txtNit').value             = objData.data.nit;
                document.querySelector('#txtNombreFiscal').value    = objData.data.nombrefiscal;
                document.querySelector('#txtDirFiscal').value       = objData.data.direccionfiscal;

            }

        }

        $('#modalFormCliente').modal('show');

    }

}

//FUNCION PARA ELIMINAR USUARIO
function fntDelInfo(idpersona) {

    swal(
        {
            title: "Eliminar Cliente",
            text: "¿Realmente quiere eliminar el Cliente?",
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
                let ajaxUrl  = base_url+'/Clientes/delCliente';
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
                            tableClientes.api().ajax.reload();

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
    //rowTable = "";

    document.querySelector('#idUsuario').value      = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML    = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    //Limpiar todos los campos
    document.querySelector('#formCliente').reset();

    //Mostrar el modal
    $('#modalFormCliente').modal('show');
}