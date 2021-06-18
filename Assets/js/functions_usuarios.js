
var tableUsuarios;

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
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });


    var formUsuario = document.querySelector("#formUsuario");

    //Indica que le estamos activando ese evento
    formUsuario.onsubmit = function (e) {  
        //Indica que al momento de darle click al botón "Guardar", evita que se recarge la página
        e.preventDefault();

        var strIdentificacion   = document.querySelector('#txtIdentificacion').value;
        var strNombre           = document.querySelector('#txtNombre').value;
        var strApellido         = document.querySelector('#txtApellido').value;
        var strEmail            = document.querySelector('#txtEmail').value;
        var intTelefono         = document.querySelector('#txtTelefono').value;
        var intTipousuario      = document.querySelector('#listRolid').value;
        var strPassword         = document.querySelector('#txtPassword').value;

        if (strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '') {

            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl     = base_url + '/Usuarios/setUsuario';
        var formData    = new FormData(formUsuario);

        //Abrimos la conexión y enviamos
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        //OBTENER LA RESPUESTA DEL CONTROLADOR
        request.onreadystatechange  = function(){

            if (request.readyState == 4 && request.status == 200) {
                
                var objData     = JSON.parse(request.responseText);

                if (objData.status) 
                {
                    //Ocultar el modal
                    $('#modalFormUsuario').modal("hide");
                    //resetear todos los campos
                    formUsuario.reset();
                    //Mostrar la alerta
                    swal("Usuarios", objData.msg, "success");

                    tableUsuarios.api().ajax.reload(function(){
                        fntViewUsuario();
                    });
                
                } else {
                    swal("Error", objData.msg, "error");
                }

            }

        }
    }

}, false);


window.addEventListener('load', function() {
    fntRolesUsuarios();
    fntViewUsuario();
}, false);

//Carga los roles en el select para ser seleccuonados en el modal
function fntRolesUsuarios() {

    var ajaxUrl = base_url + '/Roles/getSelectRoles';
    var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

    request.open("GET",ajaxUrl, true);
    request.send();

    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){

            document.querySelector('#listRolid').innerHTML  = request.responseText;
            document.querySelector('#listRolid').value      = 1;

            //Actualizar el select para que se muestren los registros
            $('#listRolid').selectpicker('render');
            //$('#listRolid).selectpicker('refresh');
        }

    }
}

//FUNCIÓN PARA VISUALIZAR A LOS USUARIOS
function fntViewUsuario(){

    var btnViewUsuario  = document.querySelectorAll(".btnViewUsuario");
    //Recorrer todos los elemntos 
    btnViewUsuario.forEach(function(btnViewUsuario){

        //AGREGAR EL EVENTO
        btnViewUsuario.addEventListener('click', function(){

            var idpersona = this.getAttribute("us");

            var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl     = base_url + '/Usuarios/getUsuario/'+idpersona;

            request.open("GET",ajaxUrl,true);
            request.send();

            $('#modalViewUser').modal('show');

        });

    });

}

function openModal(){
    
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