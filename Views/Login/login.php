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
      <div class="login-box">

        <div id="divLoading">
          <div>
            <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
          </div>
        </div>

        <form class="login-form" name="formLogin" id="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>

          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" autofocus>
          </div>

          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
          </div>

          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña ?</a></p>
            </div>
          </div>

          <div id="alertLogin" class="text-center"></div>

          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i>  INICIAR SESIÓN  </button>
          </div>

        </form>

        <!--FORMULARIO RECUPERACIÓN DE CONTRASEÑA-->

        <form id="formRecetPass" name="formRecetPass" class="forget-form" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿ Olvidaste tu contraseña ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
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