<section class="container container-table-productos mt-3 mb-3">
    <h2>Consultas</h2>
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url('consulta_contactos') ?>" class="btn btn-success btn-sm m-2 btn-opciones">No leídos</a>
        <a href="<?php echo base_url('consulta_no_leidos') ?>" class="btn btn-dark btn-sm m-2 btn-opciones">Leídos</a>
    </div>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="mt-3 alert alert-info"><?php echo $_SESSION['msg']; ?></div>
    <?php endif; ?>

    <div class="mt-3 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($consulta): ?>
                    <?php foreach ($consulta as $cons): ?>
                        <?php $leido = $cons['leido']; ?> 
                        <?php if ($leido == 'SI'): ?> 
                            <tr class="table-row">
                                <td><?php echo $cons['id_consulta']; ?></td>
                                <td><?php echo $cons['nombre']; ?></td>
                                <td><?php echo $cons['correo']; ?></td>
                                <td><?php echo $cons['mensaje']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('borrarconsulta/' .$cons['id_consulta']); ?>" class="btn btn-danger btn-sm mt-1 btn-opciones">Borrar</a>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</section>
