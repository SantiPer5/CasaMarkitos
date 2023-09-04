<section class="carrito">

    <div class="container container-table-productos mt-3 mb-3" id="carrito">

        <div style="position: absolute; top: 10%; z-index: 1; left: 50%; transform: translateX(-50%);">
            <!--recuperamos datos con la función Flashdata para mostrarlos-->
            <?php if (session()->getFlashdata('succescompra')) {
                echo " <div class='h4 text-center alert alert-info alert-dismissible' style='border-radius: 40px;'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' style='font-size:1.2rem; color: red;'></button>" . session()->getFlashdata('succescompra') . "
                    </div>";
            }
            ?>
            <?php if (session()->getFlashdata('mensaje_stock')) {
                echo " <div class='h4 text-center alert alert-info alert-dismissible' style='border-radius: 40px;'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' style='font-size:1.2rem; color: red;'></button>" . session()->getFlashdata('mensaje_stock') . "
                    </div>";
            }
            ?>

        </div>

        <div class="carts">
            <div class="heading">
                <h2 style="margin-bottom: 60px; border-color: #023e8a;">Productos en tu Carrito</h2>
                <a href="<?php echo base_url('/catalogo'); ?>" class="btn btn-primary mt-2 mb-2">Seguir Comprando</a>
            </div>
            <div class="text" align="center">
                <?php

                $session = session();
                $cart = \Config\Services::cart();
                $cart = $cart->contents();

                // Si el carrito está vacio, mostrar el siguiente mensaje
                if (empty($cart)) {
                    echo 'Para agregar productos al carrito, click en "Comprar"';
                }
                ?>
            </div>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped ml-3">
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Producto</b></td>
                        <td><b>Precio</b></td>
                        <td><b>Cantidad</b></td>
                        <td><b>Total</b></td>
                        <td><b>Acción</b></td>
                    </tr>

                    <?php if ($cart == TRUE) : ?>
                        <?php
                        echo form_open('/actualizar_carrito');
                        $gran_total = 0;
                        $i = 1;

                        foreach ($cart as $item) :
                            echo  form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                            echo  form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                            echo  form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                            echo  form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                            echo  form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        ?>
                            <tr>
                                <td> <?php echo $i++; ?> </td>
                                <td> <?php echo $item['name']; ?> </td>
                                <td>$ <?php echo number_format($item['price'], 2); ?> </td>
                                <td>     <input type="number" name="cart[<?php echo $item['id']; ?>][qty]" value="<?php echo $item['qty']; ?>" min="1" style="max-width: 50px"> </td>
                                <?php $gran_total += ($item['price'] * $item['qty']); ?>
                                <td> $ <?php echo number_format($item['subtotal'], 2) ?> </td>
                                <!-- eliminar producto -->
                                <td>
                                    <a href="<?php echo base_url('carrito_elimina/' . $item['rowid']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                        <?php
                        endforeach;
                        ?>
                        <tr class="table-light">
                            <td colspan="4" style="vertical-align: middle;">
                                <b>Total: $
                                    <?php
                                    echo number_format($gran_total, 2);
                                    ?>
                                </b>
                            </td>
                            <td colspan="4" align="end">
                                <!-- actualizar carrito -->
                                <button type="submit" class="btn btn-info" id="actualizando-precios">Actualizar precios</button>
                                
                                <a href="<?php echo base_url('carrito-comprar'); ?>" class="btn btn-success" id="confirmar-pedido">Realizar Pedido</a>
                                <a href="<?php echo base_url('carrito_elimina/all'); ?>" class="btn btn-danger" id="vaciar-carrito">Vaciar</a>
                            </td>
                        </tr>
                        <?php echo form_close(); ?>
                    <?php endif; ?>
                </table>
                <p>IMPORTANTE! Si modifica la cantidad de productos, recuerde actualizar los precios antes de realizar el pedido.</p>
            </div>
        </div>
        <br>
    </div>
</section>

<script>
    document.getElementById('confirmar-pedido').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Confirmar Pedido?',
            text: '¿Estás seguro de que deseas realizar el pedido?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                 // Redirige al usuario para confirmar el pedido
                window.location.href = "<?php echo base_url('carrito-comprar'); ?>";
                /* Swal.fire(
                    'Hecho!',
                    'Tu pedido ya fue solicitado, en breve nos comunicaremos via email o whatsapp!',
                    'success'
                    ).then((result) => {
                        window.location.href = "<?php echo base_url('carrito-comprar'); ?>";
                    }) */
                
            }
        });
    });

    document.getElementById('vaciar-carrito').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Vaciar Carrito?',
            text: '¿Estás seguro de que deseas vaciar el carrito?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Vaciar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirige al usuario para vaciar el carrito
                window.location.href = "<?php echo base_url('carrito_elimina/all'); ?>";
            }
        });
    });

</script>



