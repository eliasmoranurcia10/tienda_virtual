
window.addEventListener('load', function() {
    fntRolesUsuarios();
}, false);

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