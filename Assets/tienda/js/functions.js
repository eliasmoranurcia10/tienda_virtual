

$(".js-select2").each(function(){
    $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
    });
});

$('.parallax100').parallax100();

$('.gallery-lb').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
            enabled:true
        },
        mainClass: 'mfp-fade'
    });
});

$('.js-addwish-b2').on('click', function(e){
    e.preventDefault();
});

$('.js-addwish-b2').each(function(){
    var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
    $(this).on('click', function(){
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-b2');
        $(this).off('click');
    });
});

$('.js-addwish-detail').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

    $(this).on('click', function(){
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-detail');
        $(this).off('click');
    });
});

/*---------------------------------------------*/

$('.js-addcart-detail').each(function(){
    var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
    $(this).on('click', function(){

        let id      = this.getAttribute('id');
        let cant    = document.querySelector('#cant-product').value;

        if (isNaN(cant) || cant < 1) {
            swal("", "La cantidad debe ser mayor o igual que 1", "error");
            return;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Tienda/addCarrito';
        let formData = new FormData();
        formData.append('id', id);
        formData.append('cant', cant);

        request.open('POST', ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function() {
            if(request.readyState != 4) return;
            if (request.status == 200) {

                let objData = JSON.parse(request.responseText);

                if (objData.status) {
                    document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;
                    //document.querySelectorAll(".cantCarrito")[0].setAttribute("data-notify",objData.cantCarrito);
                    //document.querySelectorAll(".cantCarrito")[1].setAttribute("data-notify",objData.cantCarrito);

                    const cants = document.querySelectorAll(".cantCarrito");
                    cants.forEach(element =>{
                        element.setAttribute("data-notify",objData.cantCarrito)
                    });

                    swal(nameProduct, "¡Se agregó al carrito!", "success");
                } else{
                    swal("",objData.msg, "error");
                }
            }
            return false;
        }

        
    });
});

$('.js-pscroll').each(function(){
    $(this).css('position','relative');
    $(this).css('overflow','hidden');
    var ps = new PerfectScrollbar(this, {
        wheelSpeed: 1,
        scrollingThreshold: 1000,
        wheelPropagation: false,
    });

    $(window).on('resize', function(){
        ps.update();
    });
});

/*==================================================================
[ +/- num product ]*/
$('.btn-num-product-down').on('click', function(){
    let numProduct = Number($(this).next().val());
    let idpr = this.getAttribute('idpr');
    if(numProduct > 1) $(this).next().val(numProduct - 1);
    let cant = $(this).next().val();
    if(idpr != null){
        fntUpdateCant(idpr,cant);
    }
    
});

$('.btn-num-product-up').on('click', function(){
    let numProduct = Number($(this).prev().val());
    let idpr = this.getAttribute('idpr');
    $(this).prev().val(numProduct + 1);
    let cant = $(this).prev().val();
    if(idpr != null){
        fntUpdateCant(idpr,cant);
    }
});
/*=====================================================================
[ ACTUALIZAR PRODUCTO] Escribir */

if (document.querySelector(".num-product")) {
    let inputCant = document.querySelectorAll(".num-product");
    inputCant.forEach(function(inputCant) {  
        inputCant.addEventListener('keyup',function() {  
            let idpr = this.getAttribute('idpr');
            let cant = this.value;
            if(idpr != null){
                fntUpdateCant(idpr,cant);
            }
        });
    });

}


//Agregar o Editar clientes - en el formulario de clientes
if (document.querySelector("#formRegister")) {

    let formRegister = document.querySelector("#formRegister");

    //Indica que le estamos activando ese evento
    formRegister.onsubmit = function (e) {  
        //Indica que al momento de darle click al botón "Guardar", evita que se recarge la página
        e.preventDefault();

        let strNombre           = document.querySelector('#txtNombre').value;
        let strApellido         = document.querySelector('#txtApellido').value;
        let intTelefono         = document.querySelector('#txtTelefono').value;
        let strEmail            = document.querySelector('#txtEmailCliente').value;


        if ( strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == ''  ) {

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
        let ajaxUrl     = base_url + '/Tienda/registro';
        let formData    = new FormData(formRegister);

        //Abrimos la conexión y enviamos
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        //OBTENER LA RESPUESTA DEL CONTROLADOR
        request.onreadystatechange  = function(){

            if (request.readyState == 4 && request.status == 200) {
                
                let objData     = JSON.parse(request.responseText);

                if (objData.status) 
                {   
                    window.location.reload(false);
                
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

if (document.querySelector(".methodpago")) {
    let optmetodo = document.querySelectorAll(".methodpago");

    optmetodo.forEach(function(optmetodo) {
        optmetodo.addEventListener('click',function() {
            if (this.value == "Paypal") {
                document.querySelector("#divpaypal").classList.remove("notBlock");
                document.querySelector("#divtipopago").classList.add("notBlock");
            } else {
                document.querySelector("#divpaypal").classList.add("notBlock");
                document.querySelector("#divtipopago").classList.remove("notBlock");
            }
        });
    });
}


function fntdelItem(element) {  
    //console.log(element);
    //Option 1 = Modal
    //Option 2 = Vista Carrito
    let option = element.getAttribute("op");
    let idpr   = element.getAttribute("idpr");

    if( option == 1 || option == 2 ){

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Tienda/delCarrito';
        let formData = new FormData();
        formData.append('id', idpr);
        formData.append('option', option);

        request.open('POST', ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function() {
            if(request.readyState != 4) return;
            if (request.status == 200) {

                let objData = JSON.parse(request.responseText);

                
                if (objData.status) {

                    if (option == 1) {
                        document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;
                        
                        const cants = document.querySelectorAll(".cantCarrito");
                        cants.forEach(element =>{
                            element.setAttribute("data-notify",objData.cantCarrito)
                        });

                    } else {
                        element.parentNode.parentNode.remove();
                        document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                        document.querySelector("#totalCompra").innerHTML    = objData.total;

                        if ( document.querySelectorAll("#tblCarrito tr").length == 1 ) {
                            window.location.href = base_url;
                        }
                    }
                    
                } else{
                    swal("",objData.msg, "error");
                }
            }
            return false;
        }
    }
}


function fntUpdateCant(pro,cant) {


    if (cant <= 0) {
        document.querySelector("#btnComprar").classList.add("notBlock");
    } else {
        document.querySelector("#btnComprar").classList.remove("notBlock");

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Tienda/udpCarrito';
        let formData = new FormData();

        formData.append('id',pro);
        formData.append('cantidad',cant);
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function() {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.status) {
                    let colSubtotal = document.getElementsByClassName(pro)[0];
                    colSubtotal.cells[4].textContent = objData.totalProducto;
                    document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                    document.querySelector("#totalCompra").innerHTML = objData.total;
                } else {
                    swal("",objData.msg, "error");
                }
            } 
        }
    }
    
}

if (document.querySelector("#txtDireccion")) {
    let direccion = document.querySelector("#txtDireccion");
    direccion.addEventListener('keyup',function() {  
        let dir = this.value;
        fntViewPago();
    });
}

if (document.querySelector("#txtCiudad")) {
    let ciudad = document.querySelector("#txtCiudad");
    ciudad.addEventListener('keyup',function() {  
        let c = this.value;
        fntViewPago();
    });
}

function fntViewPago() {
    let direccion = document.querySelector("#txtDireccion").value;
    let ciudad = document.querySelector("#txtCiudad").value;

    if ( direccion == "" || ciudad == "" ) {
        document.querySelector("#divMetodoPago").classList.add("notBlock");
    } else {
        document.querySelector("#divMetodoPago").classList.remove("notBlock");
        
    } 
}

if( document.querySelector("#btnComprar") ){

    let btnPago = document.querySelector("#btnComprar"); 
    btnPago.addEventListener('click', function () {  

        let txtDireccion = document.querySelector("#txtDireccion").value;
        let txtCiudad = document.querySelector("#txtCiudad").value;
        let inttipopago = document.querySelector("#listtipopago").value;

        if( txtDireccion == "" || txtCiudad == "" || inttipopago == "" ){
            swal("", "Complete datos de envío", "error");
            return;
        } else{

            divLoading.style.display = "flex";

            let request = (window.XMLHttpRequest) ? 
	                    new XMLHttpRequest() : 
	                    new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Tienda/procesarVenta';

            let formData = new FormData();
            formData.append('direccion',txtDireccion);
            formData.append('ciudad',txtCiudad);
            formData.append('inttipopago',inttipopago);

            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){

                if(request.readyState != 4) return;

                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        window.location = base_url+"/tienda/confirmarpedido/";
                    } else {
                        swal("", objData.msg , "error" );
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }


    }, false);
}