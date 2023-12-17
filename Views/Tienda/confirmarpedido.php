<?php
    headerTienda($data);
?>

    <br><br><br>

<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
        <h1 class="display-4">¡Gracias por tu compra!</h1>
        <p class="lead">Tu pedido fue procesado con éxito</p>
        <p>Nro. Orden: <strong> <?= $data['orden']; ?> </strong> </p>

        <?php
            if(!empty($data['transaccion'])){
        ?>
        <p> Transacción: <strong> <?= $data['transaccion']; ?>  </strong> </p>
        <?php
            }
        ?>
        <hr class="my-4">
        <p>Muy pronto estaremos en contacto para coordinar la entrega.</p>
        <p>Puedes ver el estado de tu pedido en la sección de pedidos de tu usuario</p>
        <br>
        <a class="btn btn-primary btn-lg" href="<?= base_url(); ?>" role="button">Continuar</a>

    </div>
</div>

<?php
    footerTienda($data);
?>