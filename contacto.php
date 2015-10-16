
<?php
include_once "includes/header.php";
?>
<div class="main-content">

  <h3 class="principal">Contacto</h3>
  <div class="row">

   <div class="col-md-8">
    <p>Por favor complete los datos del siguiente formulario y en la mayor brevedad nos estaremos comunicando con usted.</p>
    <form>
     <div class="form-group">
      <label for="nombre">Nombre *</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
    </div>
    <div class="form-group">
      <label for="apellidos">Apellidos *</label>
      <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
    </div>
    <div class="form-group">
      <label for="empresa">Empresa</label>
      <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Empresa">
    </div>
    <div class="form-group">
      <label for="email">Email *</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="telefono">Tel&eacute;fono</label>
      <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono">
    </div>
    <div class="form-group">
      <label for="producto">Producto de inter&eacute;s</label>
     <input type="text" class="form-control" id="producto" name="producto" placeholder="Producto" value="<?=isset($_POST['producto']) ? addslashes($_POST['producto']) : ''?>">
    </div>
    <div class="form-group">
      <label for="mensaje">Mensaje</label>
      <textarea id="mensaje" name="mensaje" placeholder="Mensaje" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-10 col-sm-2">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
  </div>
  <input type="hidden" name="url" value="<?=$_POST['url']?>">
  </form>



</div>
<div class="col-md-4">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.148546669414!2d-84.03529!3d9.92158400000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwNTUnMTcuNyJOIDg0wrAwMicwNy4wIlc!5e0!3m2!1ses-419!2scr!4v1443158890413" width="100%" height="100%" frameborder="0" style="border:0;min-height:300px;" allowfullscreen></iframe>
   </div>
</div>
</div>
<?php
include_once "includes/footer.php";
?>
