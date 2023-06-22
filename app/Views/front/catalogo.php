<?php 
        $session = session();
        $nombre = $session->get('nombre');
        $perfil = $session->get('perfil_id');
    ?>


<div class="container">
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
                                    <p class="card-text product-price">Precio: $<?php echo $producto['precio']; ?></p>
                                    <p class="card-text product-stock">Stock: <?php echo $producto['stock']; ?></p>
                                    <div class="text-center">
                                        
                                    
                                    <!-- Vista para usuario registrado -->
                                        <?php if ($perfil == 2) : 
                                            echo form_open('agregar_carrito');
                                            echo form_hidden('agregar_carrito');
                                                echo form_hidden('producto_id', $producto['producto_id']);
                                                echo form_hidden('precio', $producto['precio']);
                                                echo form_hidden('nombre', $producto['nombre_prod']);
                                                echo form_submit('Comprar', 'Agregar al Carrito', 'class="btn btn-success btn-sm btn-add-to-cart"');
                                            echo form_close();
                                            ?> 
                                        <!-- Vista para usuario no registrado -->
                                        <?php else : ?> 
                                            <a href="<?php echo base_url() ?>/login" class="btn btn-primary btn-sm btn-buy">Comprar</a>
                                            <a href="<?php echo base_url() ?>/login" class="btn btn-success btn-sm btn-add-to-cart">Añadir al Carro</a>
                                        
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

