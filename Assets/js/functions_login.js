
//Hacer visible la recuperación de contraseña
$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});

var divLoading = document.querySelector("#divLoading");

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
                //muestra el loading en el logeo
                divLoading.style.display = "flex";

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
                            //window.location = base_url + '/dashboard';
                            //estamos recargando la página 
                            window.location.reload(false);
                        } else {
                            swal("Atención", objData.msg, "error");
                            document.querySelector("#txtPassword").value = "";
                        }
                    } else 
                    {
                        swal("Atención", "Error en el proceso", "error");
                    }
                    //oculta el loading en el logeo
                    divLoading.style.display = "none";

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
                //muestra el loading en el logeo
                divLoading.style.display = "flex";

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

                    //oculta el loading en el logeo
                    divLoading.style.display = "none";

                    return false;
                }
            }

        }

    }

}, false);