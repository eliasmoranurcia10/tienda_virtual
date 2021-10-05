
<!-- Modal de formulario para crear usuario o actualizar usuario-->
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" >
        <div class="modal-content">


            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">


                <form id="formProductos" name="formProductos" class="form-horizonal">

                    <input type="hidden" id="idProducto" name="idProducto" value="" >

                    <p class="text-primary"> Los campos con asterisco (<span class="required" >*</span>) son obligatorios. </p>

                    <div class="row">
                        <div class="col-md-8">
                    
                            <div class="form-group">
                                <label class="control-label">Nombre Producto <span class="required" >*</span> </label>
                                <input class="form-control" id="txtNombre" name="txtNombre" type="text" required="" >
                            </div>

                            <div class="form-group">
                                <label class="control-label">Descripción Producto </label>
                                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="control-label">Código <span class="required" >*</span> </label>
                                <input class="form-control" id="txtCodigo" name="txtCodigo" type="text" placeholder="Código de barra" required="" >
                                <br>
                                <div id="divBarCode" class="notBlock textcenter">
                                    <div id="printCode">
                                        <svg id="barcode"></svg>
                                    </div>

                                    <button class="btn btn-success btn-sm" type="button" onclick="fntPrintBarcode('#printCode')" >
                                        <i class="fas fa-print"></i> Imprimir
                                    </button>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Precio <span class="required" >*</span> </label>
                                    <input class="form-control" id="txtPrecio" name="txtPrecio" type="text" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Stock  <span class="required" >*</span> </label>
                                    <input class="form-control" id="txtStock" name="txtStock" type="text" required="">
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="listCategoria">Categoría<span class="required" >*</span></label>
                                    <!--data-live-search="true" se va a habilitar un buscador en el select-->
                                    <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" required="" ></select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="listStatus">Estado<span class="required" >*</span></label>
                                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                                </div>

                                <div class="form-group col-md-6">
                                    <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tile-footer">
                        <div class="form-group col-md-12">
                            <div id="containerGallery">
                                <span>Galería de Fotos</span>
                                <button class="btnAddImage btn btn-info btn-sm" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <hr>
                            <div id="containerImages">
                                <div id="div24">
                                    <div class="prevImage">
                                        <img src="<?= media();?>/images/uploads/lavadora.jpg">
                                    </div>
                                    <input type="file" name="foto" id="img1" class="inputUploadfile">
                                    <label for="img1" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                                    <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')" ><i class="fas fa-trash-alt"></i></button>
                                </div>

                                <div id="div24">
                                    <div class="prevImage">
                                        <img class="loading" src="<?= media();?>/images/loading.svg">
                                    </div>
                                    <input type="file" name="foto" id="img1" class="inputUploadfile">
                                    <label for="img1" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                                    <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')" ><i class="fas fa-trash-alt"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>



<!-- Modal para visualizar a cada usuario-->
<div class="modal fade" id="modalViewCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">


            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de la categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>ID:</td>
                            <td id="celId"></td>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td id="celNombre"></td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celDescripcion"></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celEstado"></td>
                        </tr>
                        <tr>
                            <td>Foto:</td>
                            <td id="imgCategoria"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

