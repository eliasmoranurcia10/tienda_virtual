

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

                console.log(request);
            }


        }

    }

}, false);