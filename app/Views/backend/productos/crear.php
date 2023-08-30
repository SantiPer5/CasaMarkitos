
<div class="container">
    	<!-- Mostrar mensajes de exito -->
  <?php if (session()->getFlashdata('success')) {
        	echo " <div class='h4 text-center alert alert-info alert-dismissible' style='border-radius: 40px;'>
        	    <button type='button' class='btn-close' data-bs-dismiss='alert' style='font-size:1.2rem; color: red;'></button>" . session()->getFlashdata('success') . "
            	</div>";
    	}
		?>

    <div class="card mt-4">
        <div class="card-header">
            <h1>Agregar Producto</h1>
            <?php if (isset($validation) && $validation->getErrors()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($validation->getErrors() as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success mt-4">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?> <?php if (session()->getFlashdata('err')): ?>
        <div class="alert alert-danger mt-4">
            <?= session()->getFlashdata('err') ?>
        </div>
    <?php endif; ?>
        </div>
        <div class="card-body">
        <form method="post" action="<?php echo base_url('/guardar') ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="categoria_id">Seleccione una Categoria</label>
                <!-- Muestro categoria con un foreach -->
                <select name="categoria_id" id="categoria_id" class="form-control">
                    <?php foreach ($categorias as $categoria): ?> <!-- Usamos un foreach para recorrer e ir mostrando las categorias -->
                        <option value="<?php echo $categoria['categoria_id']; ?>">
                        <?php echo $categoria['categoria_desc']; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <!-- <select name="categoria_id" id="categoria_id" class="form-control">
                    <option value="0">OFERTA</option>
                    <option value="1" <?= set_select('categoria_id', '1') ?>>Articulos de Kiosco</option>
                    <option value="2" <?= set_select('categoria_id', '2') ?>>Bazar</option>
                    <option value="3" <?= set_select('categoria_id', '3') ?>>Electrodomesticos</option>
                    <option value="4" <?= set_select('categoria_id', '4') ?>>Libreria</option>
                    <option value="5" <?= set_select('categoria_id', '5') ?>>Varios</option>
                </select> -->
            </div>

            <div class="form-group">
                <label for="nombre">Nombre del producto</label>
                <input id="nombre_prod" class="form-control" type="text" name="nombre_prod" required value="<?= set_value('nombre_prod') ?>">
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input id="precio" class="form-control" type="text" name="precio" required value="<?= set_value('precio') ?>">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input id="descripcion" class="form-control" type="text" name="descripcion" value="<?= set_value('descripcion') ?>">
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input id="stock" class="form-control" type="text" name="stock" required value="<?= set_value('stock') ?>">
            </div>

            <div class="form-group">
                <label for="estado">Selecciones un Estado</label>
                <select name="estado" id="estado">
                    <option value="1" <?= set_select('estado', '1') ?>>Disponible</option>
                    <option value="0" <?= set_select('estado', '0') ?>>No disponible</option>
                </select>
            </div>
            <br/>
            <div class="form-group">
                <label for="imagen">Adjunte una Imagen Para el producto</label>
                <input id="imagen" class="form-control-file" type="file" name="imagen">
            </div>
            <br/>
            <div class="crear_container__buttons">
                <button type="submit" value="guardar" class="btn btn-primary">Guardar</button>
                <a href="<?php echo base_url('/crud_productos'); ?>" class="btn btn-danger">Volver</a>
            </div>
        </form>

        </div>
    </div>
</div>


