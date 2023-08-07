<section class="listar-ventas">
    
    <div class="container container-table-productos-ventas mt-3 mb-3">
        <?php $session = session();
                $nombre = $session->get('nombre');
                $perfil = $session->get('perfil_id');
            ?>


        <h1><?php echo $titulo; ?></h1>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <?php if ($perfil == '1') : ?>
                            <th>Nombre Cliente</th>
                            <th>Fecha de Venta</th>
                            <th>Total de Venta</th>

                        <?php else : ?>
                            <th>Fecha de Compra</th>
                            <th>Total de Compra</th>
                        <?php endif; ?>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventaDetalle as $venta) : ?> 
                        <tr>
                            <td><?php echo isset($venta['id']) ? $venta['id'] : ''; ?></td> 
                            <?php if ($perfil == '1') : ?>
                                <td><?php echo isset($venta['nombre']) ? $venta['nombre'] : ''; ?>  <?php echo isset($venta['apellido']) ? $venta['apellido'] : ''; ?></td>
                            <?php endif; ?>
                            <td><?php echo isset($venta['fecha_venta']) ? $venta['fecha_venta'] : ''; ?></td>
                            <td><?php echo isset($venta['total_venta']) ? $venta['total_venta'] : ''; ?></td>
                            <td>
                                            <a <?php if ($perfil == '1') echo 'class="btn btn-dark btn-opciones"'; ?> href="<?= base_url('factura/' . $venta['id']) ?>" class="btn btn-primary btn-opciones">Ver Factura</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>