
let tableRoles;
let rowTable = "";
//Añadimos la variable que contiene un cargador
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function(){

    //Se cargan las tablas
	tableRoles = $('#tableRoles').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Roles/getRoles",
            "dataSrc":""
        },
        "columns":[
            {"data":"idrol"},
            {"data":"nombrerol"},
            {"data":"descripcion"},
            {"data":"status"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 3,
        "order":[[0,"desc"]]  
    });

    //NUEVO ROL
    let formRol = document.querySelector("#formRol");

    formRol.onsubmit = function(e){         //al momento de que se envíe la información, lo que hace es que se ejecuta la función
        e.preventDefault();                 //prevenir a que se recarge la página

        let intIdRol        = document.querySelector('#idRol').value;
        let strNombre       = document.querySelector('#txtNombre').value;
        let strDescripcion  = document.querySelector('#txtDescripcion').value;
        let intStatus       = document.querySelector('#listStatus').value;

        //Verifica si los labels no están vacíos
        if(strNombre=='' || strDescripcion=='' || intStatus=='')
        {
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }

        //muestra un cargador
        divLoading.style.display = "flex";

        //objetos de acuerdo al navegador
        let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

        let ajaxUrl     = base_url +'/Roles/setRol';
        let formData    = new FormData(formRol);

        //abrir por el metodo post para enviar la información
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        //Se va a obtener la información
        request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
                
                let objData = JSON.parse(request.responseText);

                if(objData.status) {

                    if (rowTable == "") {
                        tableRoles.api().ajax.reload();
                    } else {
                        let htmlStatus  = intStatus == 1? 
                        '<span class="badge badge-success">Activo</span>':'<span class="badge badge-danger">Inactivo</span>';

                        rowTable.cells[1].textContent   = strNombre;
                        rowTable.cells[2].textContent   = strDescripcion;
                        rowTable.cells[3].innerHTML     = htmlStatus; 
                    }

                    $('#modalFormRol').modal("hide");
                    //Resetear o limpiar campos
                    formRol.reset();
                    swal("Roles de usuario", objData.msg,"success");
                    

                } else {
                    swal("Error", objData.msg, "error");
                }
            }

            //Oculta el cargador
            divLoading.style.display = "none";
            return false;
            //console.log(request);
        }

    }

});

$('#tableRoles').DataTable();

function openModal(){
    rowTable = "";

    document.querySelector('#idRol').value          = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML    = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRol").reset();

    $('#modalFormRol').modal('show');
}


//Se a agregar el evento load cuando se cargue todo el documento
window.addEventListener('load', function() {
    /*fntEditRol();
    fntDelRol();
    fntPermisos();*/
}, false);

//EDITAR ROL PARA CADA UNO CUANDO SE HAGA CLICK
function fntEditRol(element ,idrol){

    //Se visualiza los elementos padre del rol elegido en la tabla
    rowTable    = element.parentNode.parentNode.parentNode;
    console.log(rowTable);

    //Cambiar texto de las etiquetas
    document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
    document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    //Validamos si estamos en un navegador
    let request    = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Roles/getRol/' + idrol; 

    request.open("GET",ajaxUrl,true);
    //Envío de la solicitud
    request.send();

    //Respuesta de la información
    request.onreadystatechange = function() {
        
        if(request.readyState==4 && request.status== 200){
            // '''console.log(request.responseText);''' Se utiliza para comprobar los datos en la consola

            let objData = JSON.parse(request.responseText);
            let optionSelect = "";

            if(objData.status)
            {
                document.querySelector("#idRol").value          = objData.data.idrol;
                document.querySelector("#txtNombre").value       = objData.data.nombrerol;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;

                if(objData.data.status == 1){
                    optionSelect = '<option value="1" selected style="display:none;">Activo</option>' ;
                } else {
                    optionSelect = '<option value="2" selected style="display:none;">Inactivo</option>';
                }

                let htmlSelect = `${optionSelect}
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                `;

                document.querySelector("#listStatus").innerHTML =  htmlSelect;
                $('#modalFormRol').modal('show');

            } else {
                swal("Error", objData.msg , "error");
            }

        }
    }
}

//FUNCION PARA ELIMINAR ROL
function fntDelRol(idrol) {

    swal(
        {
            title: "Eliminar Rol",
            text: "¿Realmente quiere eliminar el Rol?",
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
                let ajaxUrl  = base_url+'/Roles/delRol';
                let strData     = "idrol="+idrol;

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
                            tableRoles.api().ajax.reload();
                        } else {
                            swal("Atención!", objData.msg , "error");
                        }
                    }

                }
            }
            
        }

    );
}


//FUNCIÓN PARA LOS PERMISOS DE LOS ROLES DE USUARIO
function fntPermisos(idrol) {

    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl    = base_url + '/Permisos/getPermisosRol/' + idrol;

    request.open("GET", ajaxUrl, true);
    request.send();

    //Validación
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200) {

            //console.log(request.responseText);
            //Se hace referencia al html que se obtiene en el controlador Permisos.php
            document.querySelector('#contentAjax').innerHTML = request.responseText;

            $('.modalPermisos').modal('show');

            document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos, false);

        }
    }
}

function fntSavePermisos(evnet) {
    //Evita que se recargue la página al presionar Guardar
    evnet.preventDefault();
    //validar el navegador
    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl     = base_url+'/Permisos/setPermisos';
    //Seleccionamos los elementos del formulario #formPermisos
    let formElement = document.querySelector("#formPermisos");
    let formData    = new FormData(formElement);
    //Abriendo la conexión
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    //Script de validación
    request.onreadystatechange = function(){
        //quiere decir que si se hizo la petición y si está devolviendo datos
        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                swal("Permisos de usuario", objData.msg, "success")
            } else {
                swal("Error", objData.msg, "error");
            }

        }

    }
    
}



