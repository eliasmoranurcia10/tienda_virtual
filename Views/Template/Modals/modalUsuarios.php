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
                            <label for="txtNombre">Nombre</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" required="">
                        </div>

                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtApellido">Apellidos</label>
                            <input type="text" class="form-control" id="txtApellido" name="txtApellido" required="">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtTelefono">Teléfono</label>
                            <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" required="">
                        </div>

                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="txtEmail">Email</label>
                            <input type="email" class="form-control" id="txtEmail" name="txtEmail" required="">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="listRolid">Tipo usuario</label>
                            <select class="form-control" id="listRolid" name="listRolid" required >
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <!-- 'for' nos permite que cuando demos click al label se redirigirá a la caja de texto-->
                            <label for="listStatus">Status</label>
                            <select class="form-control" id="listStatus" name="listStatus" required >
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

