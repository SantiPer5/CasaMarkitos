

<?php ob_start(); ?>

<section class="container container-table-productos-factura mt-3 mb-3">
    <!-- <?php $session = session();
        $nombre = $session->get('nombre');
        $perfil = $session->get('perfil_id');
    ?> -->


    <div class="row">
        <div class="col-md-6">
            <h2 class="text-center mb-5"><?php echo ($perfil == 1) ? 'Factura de Venta' : 'Factura de Compra'; ?></h2>
            <!-- logo de casa markitos -->
            <img class="img-fluid" src="<?php echo base_url('assets/img/f9a6a9437f850c9aace8c28fc0df31a1.png'); ?>" alt="logo">
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Datos del Comprador</h5>
                    <p class="card-text">
                        <strong>Nombre:</strong> <?php echo isset($ventaDetalle[0]['nombre']) ? $ventaDetalle[0]['nombre'] : ''; ?>
                        <?php echo isset($ventaDetalle[0]['apellido']) ? $ventaDetalle[0]['apellido'] : ''; ?><br>
                        <!-- Agrega aquí los demás datos del comprador que deseas mostrar -->
                        <strong>Razón Social:</strong> <?php echo isset($ventaDetalle[0]['rsocial']) ? $ventaDetalle[0]['rsocial'] : ''; ?><br>
                        <strong>Provincia:</strong> <?php echo isset($ventaDetalle[0]['provincia']) ? $ventaDetalle[0]['provincia'] : ''; ?><br>
                        <strong>Domicilio:</strong> <?php echo isset($ventaDetalle[0]['domicilio']) ? $ventaDetalle[0]['domicilio'] : ''; ?><br>
                        <strong>CUIT/CUIL:</strong> <?php echo isset($ventaDetalle[0]['cuit']) ? $ventaDetalle[0]['cuit'] : ''; ?><br>
                        <strong>Fecha:</strong> <?php echo isset($ventaDetalle[0]['fecha_venta']) ? $ventaDetalle[0]['fecha_venta'] : ''; ?><br>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_venta = 0; ?>
                <?php foreach ($ventaDetalle as $detalle): ?>
                <tr>
                    <td><?= $detalle['nombre_prod']; ?></td>
                    <td><?= $detalle['cantidad']; ?></td>
                    <td>$<?= $detalle['precio']; ?></td>
                    <td>$<?= $detalle['cantidad'] * $detalle['precio']; ?></td>
                </tr>
                <?php $total_venta += $detalle['cantidad'] * $detalle['precio']; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row justify-content-end">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total de la Venta</h5>
                    <h4 class="card-text">$<?= $total_venta; ?></h4>
                </div>
            </div>
        </div>
    </div>
</section>


<?php 
require_once './vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();


$dompdf -> load_html(ob_get_clean());
$dompdf -> render();
$pdf = $dompdf->output();
$filename = "facturaventa.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename)
?>

