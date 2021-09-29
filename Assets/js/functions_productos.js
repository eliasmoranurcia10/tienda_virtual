
document.write(`<script src="${base_url}/Assets/js/plugins/JsBarcode.all.min.js"></script>`);

let tableProductos;

//Superponer el editor para que los controles funcionen correctamente
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

//Codigo a ejecutarse a momento de cargar el documento
window.addEventListener('load', function() {

    tableProductos = $('#tableProductos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Productos/getProductos",
            "dataSrc":""
        },
        "columns":[
            {"data":"idproducto"},
            {"data":"codigo"},
            {"data":"nombre"},
            {"data":"stock"},
            {"data":"precio"},
            {"data":"status"},
            {"data":"options"}
        ],
        "columnDefs":[
            {'className':"textcenter", "targets": [3]},
            {'className':"textright" , "targets": [4]},
            {'className':"textcenter", "targets": [5]}
        ],

        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            },
            {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            },
            {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            },
            {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> csv",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info",
                "exportOptions":{
                    "columns":[0,1,2,3,4,5]
                }
            }
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });

    //VALIDACIÓN PARA VERIFICAR SI EXISTE EL FORMULARIO
    if( document.querySelector("#formProductos") ){

        let formProductos = document.querySelector("#formProductos");

        formProductos.onsubmit  = function (e) {  

            e.preventDefault();                 //prevenir a que se recarge la página

            let strNombre   = document.querySelector('#txtNombre').value;
            let intCodigo   = document.querySelector('#txtCodigo').value;
            let strPrecio   = document.querySelector('#txtPrecio').value;
            let intStock    = document.querySelector('#txtStock').value;

            if( strNombre=='' || intCodigo=='' || strPrecio=='' || intStock=='' ){
                swal("Atención","Todos los campos son obligatorios","error");
                return false;
            }

            if (intCodigo.length < 5) {
                swal("Atención","El código debe ser mayor que 5 dígitos","error");
                return false;
            }

            //muestra un cargador
            divLoading.style.display = "flex";
            //Pasa todo lo que tiene el editor al textArea, para pasarlo al Ajax
            tinyMCE.triggerSave();

            //objetos de acuerdo al navegador
            let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl     = base_url +'/Productos/setProducto';
            let formData    = new FormData(formProductos);

            request.open("POST",ajaxUrl,true);
            request.send(formData);

            //Se va a obtener la información
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status == 200){

                    let objData = JSON.parse(request.responseText);

                    if ( objData.status ) {
                        swal("", objData.msg, "success");
                        document.querySelector("#idProducto").value  = objData.idproducto;
                        tableProductos.api().ajax.reload();
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

    fntCategorias();  
}, false);

if(document.querySelector("#txtCodigo")){
    let inputCodigo = document.querySelector("#txtCodigo");
    //evento es cuando presionamos la tecla y presionamos
    inputCodigo.onkeyup = function () {  
        if(inputCodigo.value.length >= 5){
            document.querySelector('#divBarCode').classList.remove("notBlock");
            fntBarcode();
        } else {
            document.querySelector('#divBarCode').classList.add("notBlock");
        }
    }
}

tinymce.init({
	selector: '#txtDescripcion',
	width: "100%",
    height: 400,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

function fntCategorias() {
    if( document.querySelector('#listCategoria') ){

        let request     = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl     = base_url + '/Categorias/getSelectCategorias';
        
        request.open("GET",ajaxUrl,true);
        request.send();

        request.onreadystatechange  = function(){

            //Verifica si se ha devuelto la información
            if(request.readyState==4 && request.status == 200){
                //Se está devolviendo html como tal, es por eso que no se utiliza Json
                document.querySelector('#listCategoria').innerHTML  = request.responseText;

                $('#listCategoria').selectpicker('render');
            }
        }
    }
}


function fntBarcode() {  

    let codigo = document.querySelector("#txtCodigo").value;
    JsBarcode("#barcode",codigo);
}

function fntPrintBarcode(area) {
    let elementArea = document.querySelector(area);
    //abrir una nueva ventana
    let vprint      = window.open(' ', 'popimpr', 'height=400,width=600');

    vprint.document.write(elementArea.innerHTML);
    vprint.document.close();
    vprint.print();
    vprint.close();
}

function openModal(){
    //Se resetea el rowTable cada vez que se dea click en el nuevo usuario para que no guarde la tabla del usuario elegido
    //rowTable = "";

    document.querySelector('#idProducto').value      = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML    = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    //Limpiar todos los campos
    document.querySelector('#formProductos').reset();

    //Mostrar el modal
    $('#modalFormProductos').modal('show');

}