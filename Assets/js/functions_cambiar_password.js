
var divLoading = document.querySelector("#divLoading");

//Funciones que se va a cargar al momento de cargar la página
document.addEventListener('DOMContentLoaded', function(){

    if( document.querySelector("#formCambiarPass") ){

        let formCambiarPass = document.querySelector("#formCambiarPass");

        formCambiarPass.onsubmit = function (e) {  

            e.preventDefault();

            let strPassword         = document.querySelector('#txtPassword').value;
            let strPasswordConfirm  = document.querySelector('#txtPasswordConfirm').value;
            let idUsuario           = document.querySelector('#idUsuario').value;

            if (strPassword == "" || strPasswordConfirm == "") {
                
                swal("Por favor", "Escribe la nueva contraseña", "error");
                return false;
            } else {

                if( strPassword.length < 5 ){

                    swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
                    return false;
                }

                if( strPassword != strPasswordConfirm ){
                    swal("Atención", "Las contraseñas no son iguales.", "error");
                    return false;
                }

                //muestra el loading en el logeo
                divLoading.style.display = "flex";

                //Verificar en qué navegador estamos
                var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl     = base_url+'/Login/setPassword';
                var formData    = new FormData(formCambiarPass);

                request.open("POST",ajaxUrl, true);
                request.send(formData);

                //VALIDAR
                request.onreadystatechange = function(){ 

                    if(request.readyState != 4) return;

                    if(request.status == 200 ){
                        var objData = JSON.parse(request.responseText);

                        if( objData.status ){

                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Iniciar Sesión",
                                closeOnConfirm: false
                            }, function (isConfirm) {  

                                if(isConfirm){
                                    window.location = base_url + '/login';
                                }

                            });
                        } else {
                            swal("Atención", objData.msg, "error");
                        }

                    } else {
                        swal("Atención","Error en el proceso","error");
                    }

                    //oculta el loading en el logeo
                    divLoading.style.display = "none";

                }

            }

        }

    }

}, false);