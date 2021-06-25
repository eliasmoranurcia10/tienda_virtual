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
            <!--FORMULARIO CAMBIAR DE CONTRASEÑA-->

            <form id="formCambiarPass" name="formCambiarPass" class="forget-form" action="">

                <input type="hidden" id="idUsuario" name="idUsuario" value="<?php $data['idpersona']; ?>" required >

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

                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar Sesión</a></p>
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