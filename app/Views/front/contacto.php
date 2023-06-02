<!-- Contacto -->
<section class="contact">

<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos-->
  <?php if (session()->getFlashdata('success')) {
    echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
  </div>";
  } ?>
</div>
<!-- php $validación = \Config\Services::validación(); Esto carga automáticamente el archivo Config\Validation que contiene configuraciones para incluir múltiples conjuntos de reglas -->
<?php $validation = \Config\Services::validation(); ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="address">
          <h2>¡Ven a visitarnos!</h2>
          <p>Av. 25 de Mayo y Sarmiento</p>
          <p>El Colorado, Formosa, Argentina</p>
        </div>
        <div class="form">
          <h2>Contáctanos</h2>  <!-- Formulario de contacto -->
          <?php if(isset($validation)): ?>
            <div class="alert-danger">
              <?php echo $validation->listErrors(); ?>
            </div>
          <?php endif; ?>

          
          <?php echo form_open(base_url('/consulta')); ?> <!-- Se envía a la función enviarMensaje del controlador ContactoController -->

          <div class="form-group">
              <?php echo form_input('nombre', '', 'placeholder="Nombre" required'); ?> <!-- Se crea un input de tipo texto con el nombre "nombre" -->
            </div>
            <div class="form-group">
              <?php echo form_input('correo', '', 'type="email" placeholder="Correo electrónico" required'); ?>
            </div>
            
            <div class="form-group">
              <?php echo form_input('asunto', '', 'placeholder="Asunto" required'); ?>
            </div>
            <div class="form-group">
              <?php echo form_textarea('mensaje', '', 'placeholder="Mensaje" required'); ?>
            </div>
            <div class="form-group">
              <?php echo form_submit('enviar', 'Enviar'); ?>
            </div>

            <?php echo form_close(); ?>
        
          </div>
      </div>
      <div class="col-lg-6 map-zone">
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3007.4469602889303!2d-59.37151849691583!3d-26.31103909349009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x944396a9180f3003%3A0x2d13c1d4e027a824!2sEl%20Colorado%2C%20Formosa!5e0!3m2!1ses!2sar!4v1682348507334!5m2!1ses!2sar" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
