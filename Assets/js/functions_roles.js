
var tableRoles;

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
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //NUEVO ROL
    var formRol = document.querySelector("#formRol");

    formRol.onsubmit = function(e){         //al momento de que se envíe la información, lo que hace es que se ejecuta la función
        e.preventDefault();                 //prevenir a que se recarge la página

        var intIdRol        = document.querySelector('#idRol').value;
        var strNombre       = document.querySelector('#txtNombre').value;
        var strDescripcion  = document.querySelector('#txtDescripcion').value;
        var intStatus       = document.querySelector('#listStatus').value;

        //Verifica si los labels no están vacíos
        if(strNombre=='' || strDescripcion=='' || intStatus=='')
        {
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }

        //objetos de acuerdo al navegador
        var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

        var ajaxUrl     = base_url +'/Roles/setRol';
        var formData    = new FormData(formRol);

        //abrir por el metodo post para enviar la información
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        //Se va a obtener la información
        request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);

                if(objData.status) {

                    $('#modalFormRol').modal("hide");
                    //Resetear o limpiar campos
                    formRol.reset();
                    swal("Roles de usuario", objData.msg,"success");
                    tableRoles.api().ajax.reload(function(){
                        //Insertar funciones, para que de nuevo funcionen los botones de editar
                        fntEditRol();
                        fntDelRol();
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }

            console.log(request);
        }

    }

});

$('#tableRoles').DataTable();

function openModal(){

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
    fntEditRol();
    fntDelRol();
}, false);

//EDITAR ROL PARA CADA UNO CUANDO SE HAGA CLICK
function fntEditRol(){
    var btnEditRol = document.querySelectorAll(".btnEditRol");
    btnEditRol.forEach(function(btnEditRol) {
        btnEditRol.addEventListener('click', function(){

            //Cambiar texto de las etiquetas
            document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
            document.querySelector('#btnText').innerHTML = "Actualizar";

            //Busca el identificador
            var idrol      = this.getAttribute("rl");
            //Validamos si estamos en un navegador
            var request    = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Roles/getRol/' + idrol; 

            request.open("GET",ajaxUrl,true);
            //Envío de la solicitud
            request.send();

            //Respuesta de la información
            request.onreadystatechange = function() {
                
                if(request.readyState==4 && request.status== 200){
                    // '''console.log(request.responseText);''' Se utiliza para comprobar los datos en la consola

                    var objData = JSON.parse(request.responseText);

                    if(objData.status)
                    {
                        document.querySelector("#idRol").value          = objData.data.idrol;
                        document.querySelector("#txtNombre").value       = objData.data.nombrerol;
                        document.querySelector("#txtDescripcion").value = objData.data.descripcion;

                        if(objData.data.status == 1){
                            var optionSelect = '<option value="1" selected style="display:none;">Activo</option>' ;
                        } else {
                            var optionSelect = '<option value="2" selected style="display:none;">Inactivo</option>';
                        }

                        var htmlSelect = `${optionSelect}
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
            
        });
    });
}

//FUNCION PARA ELIMINAR ROL
function fntDelRol() {
    //Dirigiendonos a todas las clases que lleven btnDelRol
    var btnDelRol = document.querySelectorAll(".btnDelRol");
    
    //Recorrer mediante forEach porque son varios elementos
    btnDelRol.forEach(function(btnDelRol){
        //Agregar el evento click
        btnDelRol.addEventListener('click', function(){
            var idrol = this.getAttribute("rl");

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
                        var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        //Ruta por la cual Llamamos al controlador y a su método delRol
                        var ajaxUrl  = base_url+'/Roles/delRol';
                        var strData     = "idrol="+idrol;

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
                                var objData = JSON.parse(request.responseText);

                                if(objData.status)
                                {
                                    //Emitir la alerta
                                    swal("Eliminar!", objData.msg, "success");
                                    //Actualizamos para que se recargue la tabla y sus funciones
                                    tableRoles.api().ajax.reload(function(){

                                        fntEditRol();
                                        fntDelRol();

                                    });
                                } else {
                                    swal("Atención!", objData.msg , "error");
                                }
                            }

                        }
                    }
                    
                }

            );
            
        });

    });
}

