



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Factura</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
</head>

<body>
    <style>

        .container-table-productos-factura {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            color: #000;
        }

        .container-table-productos-factura h2 {
            color: #c62828;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .container-table-productos-factura .card {
            border: none;
            box-shadow: none;
        }

        .container-table-productos-factura .card-title {
            color: #c62828;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .container-table-productos-factura .card-text {
            margin-bottom: 0;
        }

        .container-table-productos-factura table {
            margin-bottom: 20px;
            min-width: 100%;
        }

        .container-table-productos-factura table th,
        .container-table-productos-factura table td {
            padding: 10px;
        }

        .container-table-productos-factura table th {
            background-color: #c62828;
            color: #fff;
            font-weight: bold;
        }

        .container-table-productos-factura table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .container-table-productos-factura .card-title,
        .container-table-productos-factura .card-text {
            color: #000;
        }

        .container-table-productos-factura .card-text strong {
            font-weight: bold;
        }

        .container-table-productos-factura .row.justify-content-end {
            margin-top: 30px;
        }

        .container-table-productos-factura .card.mb-4 {
            border: none;
            box-shadow: none;
        }

        .container-table-productos-factura .card-body {
            padding: 20px;
            background-color: #f5f5f5;
            text-align: right;
        }

        .container-table-productos-factura .card-body h5.card-title {
            margin-bottom: 10px;
        }

        .container-table-productos-factura .card-body h4.card-text {
            color: #c62828;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .container-table-productos-factura .img-fluid {
            width: 10rem;
            height: auto;
            object-fit: cover;
        }
    </style>
    <section class="container container-table-productos-factura mt-3 mb-3">
    <?php $session = session();
        $nombre = $session->get('nombre');
        $perfil = $session->get('perfil_id');
    ?>
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center mb-5"><?php echo ($perfil == 1) ? 'Pedido de Venta' : 'Pedido de Compra'; ?></h2>
                <!-- logo de casa markitos -->
                <!-- <img class="img-fluid" src="http://localhost/CasaMarkitos/assets/img/f9a6a9437f850c9aace8c28fc0df31a1.png" alt="logo"> -->
                <h3 class="text-center mb-5">CasaMarkitos</h3>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos del Comprador</h5>
                        <p class="card-text">
                            <strong>Nombre:</strong> <?php echo isset($ventaDetalle[0]['nombre']) ? $ventaDetalle[0]['nombre'] : ''; ?>
                            <?php echo isset($ventaDetalle[0]['apellido']) ? $ventaDetalle[0]['apellido'] : ''; ?><br>
                            <!-- Agrega aquí los demás datos del comprador que deseas mostrar -->
                            <!-- <strong>Razón Social:</strong> <?php echo isset($ventaDetalle[0]['rsocial']) ? $ventaDetalle[0]['rsocial'] : ''; ?><br> -->
                            <strong>Provincia:</strong> <?php echo isset($ventaDetalle[0]['provincia']) ? $ventaDetalle[0]['provincia'] : ''; ?><br>
                            <strong>Domicilio:</strong> <?php echo isset($ventaDetalle[0]['domicilio']) ? $ventaDetalle[0]['domicilio'] : ''; ?><br>
                            <!-- <strong>CUIT/CUIL:</strong> <?php echo isset($ventaDetalle[0]['cuit']) ? $ventaDetalle[0]['cuit'] : ''; ?><br> -->
                            <strong>Fecha:</strong> <?php echo isset($ventaDetalle[0]['fecha_venta']) ? $ventaDetalle[0]['fecha_venta'] : ''; ?><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-5">
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

        <div class="row justify-content-end mt-3">
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
</body>

</html>

