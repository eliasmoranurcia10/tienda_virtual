
//Hacer visible la recuperación de contraseña
$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});


//Funciones que se va a cargar al momento de cargar la página
document.addEventListener('DOMContentLoaded', function(){

    if( document.querySelector("#formLogin") ){

        // let significa que va a ser utilizadasolamente dentro de la función
        let formLogin = document.querySelector("#formLogin");

        formLogin.onsubmit = function (e) {  

            e.preventDefault();

            let strEmail    = document.querySelector("#txtEmail").value;
            let strPassword = document.querySelector("#txtPassword").value;

            if(strEmail == "" || strPassword == "")
            {
                swal("Por favor", "Escribe usuario y contraseña.", "error");
                return false;
            } else {

                var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl     = base_url + '/Login/loginUser';
                var formData    = new FormData(formLogin);

                request.open("POST", ajaxUrl, true);
                request.send(formData);

                request.onreadystatechange = function(){

                    if( request.readyState != 4 ) return;
                    if( request.status == 200 ){

                        var objData = JSON.parse(request.responseText);

                        if( objData.status )
                        {
                            window.location = base_url + '/dashboard';
                        } else {
                            swal("Atención", objData.msg, "error");
                            document.querySelector("#txtPassword").value = "";
                        }
                    } else 
                    {
                        swal("Atención", "Error en el proceso", "error");
                    }

                    return false;

                }
            }


        }

    }

    if( document.querySelector("#formRecetPass") ){

        // let significa que va a ser utilizadasolamente dentro de la función
        let formRecetPass = document.querySelector("#formRecetPass");

        formRecetPass.onsubmit = function (e) {  

            e.preventDefault();

            let strEmail = document.querySelector("#txtEmailReset").value;

            if( strEmail == "" ){
                swal("Por favor", "Escribe tu correo electrónico.", "error");
                return false;
            } else {
                //Verificar en qué navegador estamos
                var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                //Definir ruta del controlador
                var ajaxUrl     = base_url + '/Login/resetPass';
                //Definir la data a enviar del formulario
                var formData    = new FormData(formRecetPass);

                //Abrir y enviar la conexión
                request.open("POST", ajaxUrl, true);
                request.send(formData);


                request.onreadystatechange = function(){
                    //console.log(request);

                    if( request.readyState != 4 ) return;

                    if( request.status == 200 ){

                        var objData = JSON.parse(request.responseText);

                        if( objData.status )
                        {   
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            }, function (isConfirm) {  

                                if(isConfirm){
                                    window.location = base_url;
                                }

                            });
                        } else {
                            swal("Atención", objData.msg, "error");
                        }
                    } else {
                        swal("Atención", "Error en el proceso", "error");
                    }

                    return false;
                }
            }

        }

    }

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

                //Verificar en qué navegador estamos
                var request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl     = base_url+'/Login/setPassword';
                var formData    = new FormData(formCambiarPass);

                request.open("POST",ajaxUrl, true);
                request.send(formData);

                //VALIDAR
                request.onreadystatechange = function () {  

                    if(request.readyState != 4) return;

                    if(request.status == 200 ){

                        console.log(request.responseText);

                    }

                }

            }

        }

    }

}, false);