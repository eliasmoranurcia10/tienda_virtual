


function openModal(){
    //Se resetea el rowTable cada vez que se dea click en el nuevo usuario para que no guarde la tabla del usuario elegido
    //rowTable = "";

    document.querySelector('#idCategoria').value      = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML    = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Categoría";
    //Limpiar todos los campos
    document.querySelector('#formCategoria').reset();

    //Mostrar el modal
    $('#modalFormCategorias').modal('show');
}