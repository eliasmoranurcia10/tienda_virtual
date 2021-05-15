
var tableRoles;

document.addEventListener('DOMContentLoaded', function(){

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

        var strNombre      = document.querySelector('#txtNombre').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var intStatus      = document.querySelector('#listStatus').value;

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
                        //Insertar funciones
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

            $('#modalFormRol').modal('show');
            
        });
    });
}

