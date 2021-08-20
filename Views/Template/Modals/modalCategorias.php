
<!-- Modal de formulario para crear usuario o actualizar usuario-->
<div class="modal fade" id="modalFormCategorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">


            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">


                <form id="formCategoria" name="formCategoria" class="form-horizonal">

                    <input type="hidden" id="idUsuario" name="idUsuario" value="" >

                    <p class="text-primary"> Los campos con asterisco (<span class="required" >*</span>) son obligatorios. </p>

                    <div class="row">
                        <div class="col-md-6">

                            <input type="hidden" id="idCategoria" name="idCategoria" value="" >
                    
                            <div class="form-group">
                                <label class="control-label">Nombre <span class="required" >*</span> </label>
                                <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del rol" required="" >
                            </div>

                            <div class="form-group">
                                <label class="control-label">Descripción <span class="required" >*</span> </label>
                                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción del rol" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Estado <span class="required" >*</span> </label>
                                <select class="form-control" id="listStatus" name="listStatus" required="">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                                </select>
                            </div>

                        </div>


                        <div class="col-md-6">
                            
                        </div>
                    </div>

                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cerrar</button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>



<!-- Modal para visualizar a cada usuario-->
<div class="modal fade" id="modalViewCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">


            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Identificación:</td>
                            <td id="celIdentificacion">75492652</td>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td id="celNombre">Elias</td>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td id="celApellido">Moran</td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td id="celTelefono">933212236</td>
                        </tr>
                        <tr>
                            <td>Email (Usuario):</td>
                            <td id="celEmail">yoexer@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Identificación Tributaria:</td>
                            <td id="celIde">yxr</td>
                        </tr>
                        <tr>
                            <td>Nombre Fiscal:</td>
                            <td id="celNomFiscal">elias</td>
                        </tr>
                        <tr>
                            <td>Dirección Fiscal:</td>
                            <td id="celDirFiscal">Santa Rosa</td>
                        </tr>
                        <tr>
                            <td>Fecha de Registro:</td>
                            <td id="celFechaRegistro">10/08/1998</td>
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

