
let tableCategorias;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){

    tableCategorias = $('#tableCategorias').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Categorias/getCategorias",
            "dataSrc":""
        },
        "columns":[
            {"data":"idcategoria"},
            {"data":"nombre"},
            {"data":"descripcion"},
            {"data":"status"},
            {"data":"options"}
        ],

        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            },
            {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success"
            },
            {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger"
            },
            {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> csv",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info"
            }
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });

    if(document.querySelector("#foto")){
        let foto = document.querySelector("#foto");
        foto.onchange = function(e) {
            let uploadFoto = document.querySelector("#foto").value;
            let fileimg = document.querySelector("#foto").files;
            let nav = window.URL || window.webkitURL;
            let contactAlert = document.querySelector('#form_alert');
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    if(document.querySelector('#img')){
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto.value="";
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        if(document.querySelector('#img')){
                            document.querySelector('#img').remove();
                        }
                        document.querySelector('.delPhoto').classList.remove("notBlock");
                        let objeto_url = nav.createObjectURL(this.files[0]);
                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
                    }
            }else{
                alert("No selecciono foto");
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
            }
        }
    }
    
    if(document.querySelector(".delPhoto")){
        let delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            document.querySelector("#foto_remove").value = 1;
            removePhoto();
        }
    }

    //Envío de datos por medio de AJAX
    //NUEVA CATEGORÍA
    let formCategoria = document.querySelector("#formCategoria");

    formCategoria.onsubmit = function(e){         //al momento de que se envíe la información, lo que hace es que se ejecuta la función
        e.preventDefault();                 //prevenir a que se recarge la página

        let strNombre       = document.querySelector('#txtNombre').value;
        let strDescripcion  = document.querySelector('#txtDescripcion').value;
        let intStatus       = document.querySelector('#listStatus').value;

        //Verifica si los labels no están vacíos
        if(strNombre=='' || strDescripcion=='' || intStatus=='')
        {
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }

        //muestra un cargador
        divLoading.style.display = "flex";

        //objetos de acuerdo al navegador
        let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

        let ajaxUrl     = base_url +'/Categorias/setCategoria';
        let formData    = new FormData(formCategoria);

        //abrir por el metodo post para enviar la información
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        //Se va a obtener la información
        request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
                
                let objData = JSON.parse(request.responseText);

                if(objData.status) {

                    if (rowTable == "") {
                        tableCategorias.api().ajax.reload();
                    } else{

                        let htmlStatus = intStatus == 1 ? '<span class="badge badge-success" >Activo</span>':'<span class="badge badge-danger">Inactivo</span>';

                        rowTable.cells[1].textContent   = strNombre;
                        rowTable.cells[2].textContent   = strDescripcion;
                        rowTable.cells[3].innerHTML     = htmlStatus;

                        rowTable = "";
                    }
                    //Ocultar el modal
                    $('#modalFormCategorias').modal("hide");
                    //Resetear o limpiar campos
                    formCategoria.reset();
                    swal("Categorías", objData.msg,"success");

                    removePhoto();
                    
                    

                } else {
                    swal("Error", objData.msg, "error");
                }
            }

            //Oculta el cargador
            divLoading.style.display = "none";
            return false;
            //console.log(request);
        }

    }


},false);

function fntViewInfo(idcategoria){

    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl     = base_url + '/Categorias/getCategoria/'+idcategoria;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange  = function(){

        //Verifica si se ha devuelto la información
        if(request.readyState==4 && request.status == 200){
            //Convertir el formato JSON en un objeto todo lo que viene en request
            let objData = JSON.parse(request.responseText);

            if(objData.status){

                let estado = objData.data.status == 1 ? '<span class="badge badge-success">Activo</span>': '<span class="badge badge-danger">Inactivo</span>';


                document.querySelector("#celId").innerHTML          = objData.data.idcategoria;
                document.querySelector("#celNombre").innerHTML      = objData.data.nombre;
                document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;
                document.querySelector("#celEstado").innerHTML      = estado;
                document.querySelector("#imgCategoria").innerHTML   = '<img src="'+ objData.data.url_portada +'"></img>';

                $('#modalViewCategoria').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }

        }

    }

}


function fntEditInfo(element ,idcategoria){

    //Asigna como valor al padre del padre del padre del botón- va a obtener como elemnto padre a toda la fila
    rowTable    = element.parentNode.parentNode.parentNode;

    document.querySelector('#titleModal').innerHTML     = "Actualizar Categoría";
    document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
    document.querySelector('#btnText').innerHTML        = "Actualizar";

    let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl     = base_url + '/Categorias/getCategoria/'+idcategoria;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange  = function(){

        //Verifica si se ha devuelto la información
        if(request.readyState==4 && request.status == 200){
            //Convertir el formato JSON en un objeto todo lo que viene en request
            let objData = JSON.parse(request.responseText);

            if(objData.status){

                document.querySelector("#idCategoria").value    = objData.data.idcategoria;
                document.querySelector("#txtNombre").value      = objData.data.nombre;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                document.querySelector("#foto_actual").value    = objData.data.portada;
                document.querySelector("#foto_remove").value    = 0;
                
                if (objData.data.status == 1) {
                    
                    document.querySelector("#listStatus").value  = 1;
                } else {
                    document.querySelector("#listStatus").value  = 2;
                }
                //Para que refresque y muestre la opción
                $("#listStatus").selectpicker('render');

                //Colocar la imagen
                if (document.querySelector('#img')) {
                    document.querySelector('#img').src  = objData.data.url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML  = "<img id='img' src="+objData.data.url_portada+" >";
                }

                //Mostrar la X para eliminar la foto en caso de que exista
                if (objData.data.portada == 'portada_categoria.png') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                //Mostrar el modal
                $("#modalFormCategorias").modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }

        }

    }

}

//FUNCION PARA ELIMINAR CATEGORIA
function fntDelInfo(idCategoria) {

    swal(
        {
            title: "Eliminar Categoría",
            text: "¿Realmente quiere eliminar la Categoría?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "No, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm)
        {

            if(isConfirm){
                //Validamos el navegador - si es firefox o chrome se crea XMLHttpRequest - si es edge o iternet explorer se crea Microsoft.XMLHTTP 
                let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                //Ruta por la cual Llamamos al controlador y a su método delRol
                let ajaxUrl  = base_url+'/Categorias/delCategoria';
                let strData     = "idCategoria="+idCategoria;

                //Abrimos la conexión
                request.open("POST",ajaxUrl, true);
                //La forma cómo se van a enviar los datos
                request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                //Enviamos la solicitud con el parámetro
                request.send(strData);

                //Recibimos la respuesta
                request.onreadystatechange = function(){
                    //Validamos si la operació fué exitosa
                    if(request.readyState == 4 && request.status == 200)
                    {
                        let objData = JSON.parse(request.responseText);

                        if(objData.status)
                        {
                            //Emitir la alerta
                            swal("Eliminar!", objData.msg, "success");
                            //Actualizamos para que se recargue la tabla y sus funciones
                            tableCategorias.api().ajax.reload();

                        } else {
                            swal("Atención!", objData.msg , "error");
                        }
                    }

                }
            }
            
        }

    );
            
}

function removePhoto(){
    
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");

    /*if( document.querySelector('#img').parentElement != "null"){
        document.querySelector('#img').remove();
    }*/
    if( document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
    
}

function openModal(){
    //Se resetea el rowTable cada vez que se dea click en el nuevo usuario para que no guarde la tabla del usuario elegido
    rowTable = "";

    document.querySelector('#idCategoria').value      = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML    = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Categoría";
    //Limpiar todos los campos
    document.querySelector('#formCategoria').reset();

    //Mostrar el modal
    $('#modalFormCategorias').modal('show');

    removePhoto();
}