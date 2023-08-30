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
    <!-- Agrega el campo de búsqueda -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar producto..." id="search-input">
            </div>
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
                        <tr class="table-row product-row">
                            <td><?php echo $prod['producto_id']; ?></td>
                            <td><?php echo $prod['nombre_prod']; ?></td>
                            <td>
                                <!-- Muestro categoria con un foreach -->
                                <?php foreach ($categorias as $categoria): ?>
                                    <?php if ($prod['categoria_id'] == $categoria['categoria_id']): ?>
                                        <?php echo $categoria['categoria_desc']; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                

                            </td>
                            
                            <!-- <td>
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
                            </td> -->
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
                                <!-- Boton para cambiar disponibilidad -->
                                <?php if ($prod['estado'] == 0): ?>
                                    <a href="<?php echo base_url('disponible/' . $prod['producto_id']); ?>" class="btn btn-success btn-sm mt-1 btn-opciones">Disponible</a>
                                <?php else: ?>
                                    <a href="<?php echo base_url('no_disponible/' . $prod['producto_id']); ?>" class="btn btn-danger btn-sm mt-1 btn-opciones">No Disponible</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Agrega el script JavaScript para el buscador en tiempo real y ordenación -->
<script>
    $(document).ready(function () {
        $("#search-input").on("input", function () {
            var searchText = $(this).val().toLowerCase();

            // Mostrar todas las filas
            $(".product-row").show();

            // Ocultar las filas que no coinciden con el texto de búsqueda
            $(".product-row").filter(function () {
                return $(this).text().toLowerCase().indexOf(searchText) === -1;
            }).hide();

            // Reordenar las filas para mostrar primero los productos disponibles
            $(".table tbody").each(function () {
                var $tbody = $(this);
                var $rows = $tbody.children(".product-row");
                $rows.sort(function (a, b) {
                    var stateA = $(a).find("td:eq(6)").text();
                    var stateB = $(b).find("td:eq(6)").text();
                    return stateA.localeCompare(stateB);
                });
                $rows.detach().appendTo($tbody);
            });
        });
    });

    $(document).ready(function () {
    var $table = $(".table");
    var $tbody = $table.find("tbody");
    var $rows = $tbody.children(".product-row");

    $rows.sort(function (a, b) {
        var stateA = $(a).find("td:eq(6)").text().toLowerCase();
        var stateB = $(b).find("td:eq(6)").text().toLowerCase();
        
        // Comparar estados y ordenar en función de "disponible" y "no disponible"
        if (stateA < stateB) return -1;
        if (stateA > stateB) return 1;
        return 0;
    });

    $tbody.html($rows);
});
</script>
