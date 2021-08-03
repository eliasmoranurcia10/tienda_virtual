
//Indica que al momento de cargar la vista, va a agregar los elementos que se van a configurar dentro de la función
document.addEventListener('DOMContentLoaded', function(){

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
            let strPassword         = document.querySelector('#txtPassword').value;

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

                        //tableUsuarios.api().ajax.reload();
                    
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


function openModal(){
    //Se resetea el rowTable cada vez que se dea click en el nuevo usuario para que no guarde la tabla del usuario elegido
    rowTable = "";

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