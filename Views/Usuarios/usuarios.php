<?php headerAdmin($data); ?>
    <main class="app-content">
<?php
  getModal("modalUsuarios",$data);

  if( empty($_SESSION['permisosMod']['r']) ) {
?>
  <p>Acceso restringido</p>

<?php } else { ?>

      <div class="app-title">
        <div>
            <h1>
                <i class="fas fa-user-tag"> </i>  <?= $data['page_title'] ?> 

                <?php if( $_SESSION['permisosMod']['w'] ) { ?>
                <button class="btn btn-primary" type="button" onclick= "openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
                <?php } ?>

            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/usuarios"> <?= $data['page_title'] ?> </a></li>
        </ul>
      </div>

      <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="tableUsuarios">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>E-mail</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Status</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
    <?php } ?>
    </main>

<?php footerAdmin($data); ?>