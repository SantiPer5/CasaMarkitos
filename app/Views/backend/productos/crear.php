
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h1>Agregar Producto</h1>
            <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success mt-4">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('/guardar') ?>" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="categoria_id">Seleccione una Categoria</label>
                    <select name="categoria_id" id="categoria_id" class="select-styling">
                        <option value="1">Articulos de Kiosco</option>
                        <option value="2">Bazar</option>
                        <option value="3">Electrodomesticos</option>
                        <option value="4">Libreria</option>
                        <option value="5">Varios</option>
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="nombre">Nombre del producto</label>
                    <input id="nombre" class="form-control" type="text" name="nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input id="precio" class="form-control" type="text" name="precio" required>
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input id="descripcion" class="form-control" type="text" name="descripcion">
                </div>
                
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input id="stock" class="form-control" type="text" name="stock" required>
                </div>
                
                <div class="form-group">
                    <label for="estado">Selecciones un Estado</label>
                    <select name="estado" id="estado">
                        <option value="1">Disponible</option>
                        <option value="0">No disponible</option>
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


