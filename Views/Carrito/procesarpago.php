<?php
    headerTienda($data);
    $subtotal   = 0;
    $total      = 0;

    foreach ( $_SESSION['arrCarrito'] as $producto) {
        $subtotal += $producto['precio'] * $producto['cantidad'];
    }
    $total = $subtotal + COSTOENVIO;
?>
    <br><br><br>
    <hr>

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?= base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Inicio
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
                <?= $data['page_title'] ?>
			</span>
		</div>
	</div>
	<br>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div>
                        <div>
                            <label for="tipopago">Dirección de envío</label>
                            <div class="bor8 bg0 m-b-12">
                                <input id="txtDireccion" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="Dirección de envío">
                            </div>
                            <div class="bor8 bg0 m-b-22">
                                <input id="txtCiudad" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Ciudad / Estado">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Resumen
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span id="subTotalCompra" class="mtext-110 cl2">
                                <?= SMONEY.formatMoney($subtotal)  ?>
                            </span>
                        </div>

                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Envío:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                <?= SMONEY.formatMoney(COSTOENVIO)  ?>
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span id="totalCompra" class="mtext-110 cl2">
                                <?= SMONEY.formatMoney($total)  ?>
                            </span>
                        </div>
                    </div>

                    <button type="submit" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Pagar
                    </button>
                </div>
            </div>

        </div>
    </div>


<?php
    footerTienda($data);
?>