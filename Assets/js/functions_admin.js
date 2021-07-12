
//Con esta función se va a bloquear todas las teclas de letras para que solo se introduzcan números
function controlTag(e) {

    //Keycode: Capturar lo que se está escribiendo
    tecla = (document.all) ? e.keyCode : e.which;

    if(tecla==8) return true;
    else if (tecla==0 || tecla==9) return true;

    //Va a permitir números del 0 al 9
    patron = /[0-9\s]/;
    n = String.fromCharCode(tecla);

    //Verificar lo que es el patrón y va a testear los que se está escribiendo
    return patron.test(n);
}

function testText(txtString) { 
    // Indica que va a permitir el ingreso de letras de A a la Z y permite las vocales con tilde
    var stringText  = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);

    //Tiene que cumplir con la exxxpresión stringText
    if(stringText.test(txtString)){
        return true;
    } else{
        return false;
    }
}

function testEntero(intCant) {
    var intCantidad = new RegExp(/^([0-9])*$/);

    if(intCantidad.test(intCant)){
        return true;
    } else {
        return false;
    }
}

function fntEmailValidate(email){

    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

    if(stringEmail.test(email) == false){
        return false;
    } else {
        return true;
    }

}

function fntValidText() {  
    let validText = document.querySelectorAll(".validText");

    validText.forEach(function(validText){

        validText.addEventListener('keyup', function(){

            let inputValue = this.value;

            if(!testText(inputValue)){
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }

        });

    });
}

function fntValidNumber() {
    //Obtener en una variable todos los que tengan la clase validNumber
    let validNumber = document.querySelectorAll(".validNumber");

    validNumber.forEach(function (validNumber) {  

        validNumber.addEventListener('keyup', function(){

            let inputValue = this.value;

            if(!testEntero(inputValue)){
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

    });
}

function fntValidEmail() {  

    let validEmail = document.querySelectorAll(".validEmail");

    validEmail.forEach(function (validEmail) {  

        validEmail.addEventListener('keyup', function () {  

            let inputValue = this.value;

            if(!fntEmailValidate(inputValue) && inputValue!=""){
                this.classList.add('is-invalid');
            } else{
                this.classList.remove('is-invalid');
            }

        });

    });

}

window.addEventListener('load', function () {  
    fntValidText();
    fntValidEmail();
    fntValidNumber();
}, false);
