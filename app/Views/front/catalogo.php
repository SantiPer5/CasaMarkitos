
<section class="section-catalogo">
<?php 
        $session = session();
        $nombre = $session->get('nombre');
        $perfil = $session->get('perfil_id');
    ?>


    <div class="catalogo">
        <h2 class="catalog-title">Catálogo de Productos</h2>
            
        <!-- Boton de wsp flotante-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <a href="https://wa.link/scmdh4" class="float" target="_blank">
                    <i class="fa fa-whatsapp my-float"></i>
            </a>

            <!-- Mostrar mensajes de exito -->
            <?php if (session()->getFlashdata('success')) {
                echo " <div class='h4 text-center alert alert-info alert-dismissible' style='border-radius: 40px;'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' style='font-size:1.2rem; color: red;'></button>" . session()->getFlashdata('success') . "
                    </div>";
            }
            ?>
        <!-- Buscador de productos js -->
        <div class="search-section">
            <input type="text" id="search-input" class="form-control" placeholder="Buscar productos..." onkeyup="search()">
        </div>

        <div class="filter-section">
            <label for="categoria-filter">Filtrar por Categoría:</label>
            <select id="categoria-filter" class="form-control">
                <option value="all">Todas las Categorías</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['categoria_id']; ?>"><?php echo $categoria['categoria_desc']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php foreach ($categorias as $categoria): ?>
            <div class="category-section" data-categoria="<?php echo $categoria['categoria_id']; ?>">
                <h3 class="category-title"><?php echo $categoria['categoria_desc']; ?></h3>
                <div class="row product-row">
                    <?php foreach ($productos as $producto): ?>
                        <?php if ($producto['categoria_id'] == $categoria['categoria_id']): ?> <!-- Muestra solo los productos de la categoria actual -->
                            <?php if ($producto['estado'] == 0 || $producto['stock'] == 0) continue; ?> <!-- Omite los productos con estado 0(No disponibles) y los con stock 0 -->
                            <div class="col-md-4">
                                <div class="card product-card">
                                    <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $producto['imagen']; ?>" class="card-img-top product-image" alt="Imagen del producto">
                                    <div class="card-body">
                                        <h5 class="card-title product-name"><?php echo $producto['nombre_prod']; ?></h5>
                                        <p class="card-text product-description"><?php echo $producto['descripcion']; ?></p>
                                        <p class="card-text product-price">$<?php echo $producto['precio']; ?></p>
                                        <!-- <p class="card-text product-stock">Stock: <?php echo $producto['stock']; ?></p> -->
                                        <div class="text-center">
                                            
                                        
                                        <!-- Vista para usuario registrado -->
                                            <?php if ($perfil == 2) : 
                                                /* echo form_open('agregar_carrito');
                                                echo form_hidden('agregar_carrito');
                                                    echo form_hidden('producto_id', $producto['producto_id']);
                                                    echo form_hidden('precio', $producto['precio']);
                                                    echo form_hidden('nombre', $producto['nombre_prod']);
                                                    echo form_submit('Comprar', 'Agregar al Carrito', 'class="btn btn-success btn-sm btn-add-to-cart"');
                                                echo form_close(); */
                                                ?> 
                                                <button class="btn btn-success btn-sm btn-add-to-cart"
                                                        data-producto-id="<?php echo $producto['producto_id']; ?>"
                                                        data-precio="<?php echo $producto['precio']; ?>"
                                                        data-nombre="<?php echo $producto['nombre_prod']; ?>">
                                                    Agregar al Carrito
                                                </button>
                                            <!-- Vista para usuario no registrado -->
                                            <?php else : ?> 
                                                
                                                <a href="<?php echo base_url() ?>/loginCatalogo" class="btn btn-primary btn-sm btn-buy">Comprar</a>
                                                
                                            
                                                
                                            <?php endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>
<!-- Script para mostrar productos por categoria -->
<script>
    document.getElementById('categoria-filter').addEventListener('change', function() {
        var selectedCategoria = this.value;
        var categorySections = document.getElementsByClassName('category-section');

        for (var i = 0; i < categorySections.length; i++) {
            var categoria = categorySections[i].getAttribute('data-categoria');

            if (selectedCategoria === 'all' || selectedCategoria === categoria) {
                categorySections[i].style.display = 'block';
            } else {
                categorySections[i].style.display = 'none';
            }
        }
    });
</script>

<!-- Script para buscar productos -->
<script>
    function search() {
        var input = document.getElementById('search-input').value;
        input = input.toLowerCase();
        var x = document.getElementsByClassName('product-card');

        for (var i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = 'none';
            } else {
                x[i].style.display = 'block';
            }
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('.btn-add-to-cart').click(function() {
            var producto_id = $(this).data('producto-id');
            var precio = $(this).data('precio');
            var nombre = $(this).data('nombre');
            
            $.ajax({
                type: 'POST',
                url: 'agregar_carrito', // Reemplaza esto con la URL correcta para agregar al carrito
                data: {
                    producto_id: producto_id,
                    precio: precio,
                    nombre: nombre
                },
                success: function(response) {
                    // Actualiza la información del carrito o muestra un mensaje de éxito
                    // Puedes hacerlo como lo necesites en tu aplicación
                    /* alert('Producto agregado al carrito con éxito'); */
                    Swal.fire({
                        icon: 'success', // Puedes usar 'success', 'error', 'warning', 'info', etc.
                        title: 'Producto agregado al carrito con éxito',
                        showConfirmButton: false, // Oculta el botón de confirmación
                        timer: 800 // Duración en milisegundos antes de que la notificación se cierre automáticamente
                    });
                }
            });
        });
    });
</script>
