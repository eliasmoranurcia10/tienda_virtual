<!DOCTYPE html>
<!-- lang="es" significa que colocará el idioma de nuestra página en español-->

<html lang="es" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Meta viewport para la vista responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Meta para mostrar el autor-->
    <meta name="author" content="Elias Moran" >

    <meta name="theme-color" content="#009688" >
    <!--ICONO DE LA PÁGINA-->
    <link rel="shortcut icon" href="<?=media();?>/images/favicon.ico">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=media();?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?=media();?>/css/style.css">

    <style>

      #divLoading{
        position: absolute;
        top:0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(254, 254, 255, .65);
        z-index: 1;
        display: none;
      }

      #divLoading img {
        width: 50px;
        height: 50px;
      }

    </style>

    <title><?php $data['page_tag']; ?></title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>

    <section class="login-content">

        <div class="logo">
            <h1><?= $data['page_title']; ?></h1>
        </div>

        <div class="login-box flipped">
          <div id="divLoading">
            <div>
              <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
            </div>
          </div>

          <!--FORMULARIO CAMBIAR DE CONTRASEÑA-->
          <form id="formCambiarPass" name="formCambiarPass" class="forget-form" action="">

            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $data['idpersona']; ?>" required >
            <input type="hidden" id="txtEmail"  name="txtEmail"  value="<?= $data['email']; ?>" required >
            <input type="hidden" id="txtToken"  name="txtToken"  value="<?= $data['token']; ?>" required >

            <h3 class="login-head"><i class="fas fa-key"></i> Cambiar contraseña</h3>

            <div class="form-group">
              <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Nueva contraseña" required >
            </div>

            <div class="form-group">
              <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" placeholder="Confirmar contraseña" required >
            </div>

            <div class="form-group btn-container">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
            </div>

          </form>


        </div>
    </section>

    <script>
      const base_url = "<?= base_url(); ?>";
    </script>

    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <!-- Font-icon css-->
    <script src="<?= media(); ?>/js/fontawesome.js"></script>


    <script src="<?= media(); ?>/js/main.js"></script>

    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>

    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>


    <!--Llama a su respectivo script js-->
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

  </body>
</html>