

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