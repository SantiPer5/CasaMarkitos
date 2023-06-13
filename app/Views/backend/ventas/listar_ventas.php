<h1><?php echo $titulo; ?></h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Fecha compra</th>
                <th>Total de la venta</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <!-- Agrega aquí las columnas adicionales que deseas mostrar -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventaDetalle as $venta) : ?>
                <tr>
                    <td><?php echo isset($venta['id_cliente']) ? $venta['id_cliente'] : ''; ?></td>
                    <!-- Traigo el nombre del id cliente -->
                    <td><?php echo isset($venta->id_cliente->nombre) ? $venta->id_cliente->nombre : ''; ?></td>
                    <td><?php echo isset($venta['fecha_venta']) ? $venta['fecha_venta'] : ''; ?></td>
                    <td><?php echo isset($venta['total_venta']) ? $venta['total_venta'] : ''; ?></td>
                    <td><?php echo isset($venta['precio']) ? $venta['precio'] : ''; ?></td>
                    <!-- Agrega aquí las celdas adicionales que deseas mostrar -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
