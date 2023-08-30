
<div class="container editar-categoria">
<!-- View de CRUD de categorias -->

<h2 class="editar-categoria-titulo">Editar categorias</h2>

<!-- Crear nueva categoria escribiendo el nombre de la misma-->

<?php echo form_open('guardar_categoria'); ?>
    <div class="form-group">
        <label for="categoria_desc">Nueva Categoria</label>
        <input id="categoria_desc" class="form-control" type="text" name="categoria_desc" placeholder="Ingrese una nueva categoria" required>
    </div>
    <div class="editar_container__buttons">
        <button type="submit" value="guardar" class="btn btn-primary">Guardar</button>
    </div>

<!-- mostramos las categorias disponibles -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?php echo $categoria['categoria_id']; ?></td>
                <td><?php echo $categoria['categoria_desc']; ?></td>
                <td>
                    <a href="<?php echo base_url('/editar_categoria/' . $categoria['categoria_id']); ?>" class="btn btn-warning">Editar</a>
                    <!-- Borrar categoria -->
                    <a href="<?php echo base_url('/borrar_categoria/' . $categoria['categoria_id']); ?>" class="btn btn-danger">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


</div>