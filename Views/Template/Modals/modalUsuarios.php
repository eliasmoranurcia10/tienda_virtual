
<!-- Modal de formulario para crear usuario o actualizar usuario-->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">


            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">


                <form id="formUsuario" name="formUsuario" class="form-horizonal">

                    <input type="hidden" id="idUsuario" name="idUsuario" value="" >

                    <p class="text-primary"> Todos los campos son obligatorios. </p>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtIdentificacion">Identificación</label>
                            <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtNombre">Nombres</label>
                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                        </div>

                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtApellido">Apellidos</label>
                            <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtTelefono">Teléfono</label>
                            <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
                        </div>

                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtEmail">Email</label>
                            <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="listRolid">Tipo usuario</label>
                            <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="listStatus">Status</label>
                            <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtPassword">Password</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword">
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
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <td>Tipo Usuario:</td>
                            <td id="celTipoUsuario">Jefe</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celEstado">Activo</td>
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

