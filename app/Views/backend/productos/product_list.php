

<div class="container">
    <h2 class="mt-4 mb-4">Lista de Productos</h2>
    <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success mt-4">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <a href="<?php echo base_url('/agregar_producto'); ?>" class="btn btn-primary mt-2 mb-2">Agregar Producto</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Producto</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php if ($productos): ?>
                    <?php foreach ($productos as $prod): ?>
                            <tr class="table-row">
                                <td><?php echo $prod['producto_id']; ?></td>
                                <td><?php echo $prod['nombre_prod']; ?></td>
                                <td>
                                    <?php
                                    $categoria = '';
                                    switch ($prod['categoria_id']) {
                                        case 0:
                                            $categoria = 'OFERTAS';
                                            break;
                                        case 1:
                                            $categoria = 'Articulos de kiosco';
                                            break;
                                        case 2:
                                            $categoria = 'Bazar';
                                            break;
                                        case 3:
                                            $categoria = 'Electrodomesticos';
                                            break;
                                        case 4:
                                            $categoria = 'Libreria';
                                            break;
                                        case 5:
                                            $categoria = 'Varios';
                                            break;
                                    }
                                    echo $categoria;
                                    ?>
                                </td>
                                <td><?php echo $prod['precio']; ?></td>
                                <td><?php echo $prod['descripcion']; ?></td>
                                <td><?php echo $prod['stock']; ?></td>
                                <td>
                                    <?php if ($prod['estado'] == 0): ?>
                                        No disponible
                                    <?php else: ?>
                                        Disponible
                                    <?php endif; ?>
                                </td>
                                <?php $imagen = $prod['imagen']; ?>
                                <?php $id = $prod['producto_id']; ?>
                                <td><img class="img-thumbnail" height="70px" width="85px" src="<?= base_url() ?>/assets/uploads/<?= $imagen ?>" alt="imagen-producto"></td>
                                <td>
                                    <a href="<?php echo base_url('editar/' . $prod['producto_id']); ?>" class="btn btn-primary btn-sm mt-1 btn-opciones" style="margin-right: 10px;">Editar</a>
                                    <a href="<?php echo base_url('borrar/' . $prod['producto_id']); ?>" class="btn btn-warning btn-sm mt-1 btn-opciones" onclick="return confirm('¿Estás seguro de que deseas borrar este producto?')">Borrar</a>
                                </td>

                            </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
