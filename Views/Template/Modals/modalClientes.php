
<!-- Modal de formulario para crear usuario o actualizar usuario-->
<div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">


            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">


                <form id="formCliente" name="formCliente" class="form-horizonal">

                    <input type="hidden" id="idUsuario" name="idUsuario" value="" >

                    <p class="text-primary"> Los campos con asterisco (<span class="required" >*</span>) son obligatorios. </p>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtIdentificacion">Identificación <span class="required" >*</span> </label>
                            <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required="">
                        </div>

                        <div class="form-group col-md-4">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtNombre">Nombres <span class="required" >*</span> </label>
                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                        </div>

                        <div class="form-group col-md-4">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtApellido">Apellidos <span class="required" >*</span> </label>
                            <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtTelefono">Teléfono <span class="required" >*</span> </label>
                            <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
                        </div>

                        <div class="form-group col-md-4">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtEmail">Email <span class="required" >*</span> </label>
                            <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                        </div>

                        <div class="form-group col-md-4">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtPassword">Password</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                        </div>

                    </div>

                    <hr>

                    <p class="text-primary">Datos Fiscales</p>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Identificación Tributario <span class="required" >*</span> </label>
                            <input class="form-control" type="text" id="txtNit" name="txtNit" required="" >
                        </div>

                        <div class="form-group col-md-6">
                            <label>Nombre Fiscal <span class="required" >*</span> </label>
                            <input class="form-control" type="text" id="txtNombreFiscal" name="txtNombreFiscal" required=""  >
                        </div>

                        <div class="form-group col-md-12">
                            <label>Dirección fiscal <span class="required" >*</span> </label>
                            <input class="form-control" type="text" id="txtDirFiscal" name="txtDirFiscal" required="" >
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

