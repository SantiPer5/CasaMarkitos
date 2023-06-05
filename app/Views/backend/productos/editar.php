
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h1>Editar Producto</h1>
            <?php if (session()->getFlashdata('msg')): ?>
                <div class="alert alert-success mt-4">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('/actualizar') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select name="categoria_id" id="categoria_id" class="select-styling">
                        <option value="1">Articulos de Kiosco</option>
                        <option value="2">Bazar</option>
                        <option value="3">Electrodomesticos</option>
                        <option value="4">Libreria</option>
                        <option value="5">Varios</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $producto['nombre'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input id="precio" class="form-control" type="text" name="precio" value="<?php echo $producto['precio'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input id="descripcion" class="form-control" type="text" name="descripcion" value="<?php echo $producto['descripcion'] ?>">
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input id="stock" class="form-control" type="text" name="stock" value="<?php echo $producto['stock'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado">
                        <option value="1" <?php if ($producto['estado'] == 1) echo 'selected' ?>>Disponible</option>
                        <option value="0" <?php if ($producto['estado'] == 0) echo 'selected' ?>>No disponible</option>
                    </select>
                </div>

                <div class="form-group">
                <?php $imagen = $producto['imagen']; ?>
                    <label for="imagen">Imagen</label>
                    <img class="img-thumbnail" height="70px" width="85px" src="<?= base_url() ?>/assets/uploads/<?= $imagen ?>" alt="imagen-producto">
                    <input id="imagen" class="form-control-file" type="file" name="imagen">
                </div>

                <div class="editar_container__buttons">
                    <input type="hidden" name="producto_id" value="<?php echo $producto['producto_id'] ?>">
                    <button type="submit" value="actualizar" class="btn btn-primary">Actualizar</button>
                    <a href="<?php echo base_url('/crud_productos'); ?>" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>