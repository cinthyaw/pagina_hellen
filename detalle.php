<?php
  include_once "backend/params.php";
  include_once "backend/consultas.php";
  include_once "includes/header.php";

   $db = new Consultas();

  $categorias = $db->getCategorias();

  if (isset($_GET['prod']) && is_numeric($_GET['prod'])) {
    $producto = $db->getProductoById($_GET['prod']);
    $detalles = $db->getDetallesProducto($_GET['prod']);
  }

?>
<div class="main-content">

  <h3 class="principal">Cat&aacute;logo de productos</h3>
  <div class="row">
     <div class="col-md-4">
       <?php
       if (!isset($_GET['id'])) {
        $selected = 0;
       }
       else {
        $selected = is_numeric($_GET['id']) ? $_GET['id'] : 0;
       }
       ?>
        <ul class="list-group">
          <a class="list-group-item <?=$selected == 0 ? 'active' : '' ?>" href="<?=ROOT_PATH?>catalogo">Todas las categor&iacute;as</a>
          <?php
          foreach($categorias as $cat) {
          ?>
            <a class="list-group-item <?=$selected == $cat['id'] ? 'active' : '' ?>" href="<?=ROOT_PATH?>catalogo/<?=$cat['id']?>/<?=$cat['descripcion']?>"><?=$cat['descripcion']?></a>
          <?php
          }
          ?>
        </ul>
      </div>
    <div class="col-md-8">
      <ol class="breadcrumb">
        <li><a href="<?=ROOT_PATH?>catalogo">Todas las categor&iacute;as</a></li>
        <li><a href="<?=ROOT_PATH?>catalogo/<?=$producto['categoria_id']?>/<?=$producto['categoria']?>"><?=$producto['categoria']?></a></li>
        <li class="active"><?=$producto['nombre']?></li>
      </ol>
      <div class="row">
        <div class="col-sm-5">
          <img src="<?=IMAGE_BASE.'300/'.$producto['imagen']?>" class="img-responsive main-image" alt="Responsive image" data-zoom-image="<?=IMAGE_BASE.'600/'.$producto['imagen']?>" />
          <small>*Coloque el cursor sobre la imagen para agrandarla</small>
        </div>
        <div class="col-sm-7 detalles">
          <h2><?=$producto['nombre']?></h2>
          <p><?=$producto['descripcion']?></p>
          <ul class="list-group">
            <?php
            foreach ($detalles as $det) {
              ?>
              <li class="list-group-item"><strong><?=$det['nombre']?></strong><br/> <?=$det['descripcion']?></li>
              <?php
            }
            ?>
            

          </ul>
          <form action="<?=ROOT_PATH?>contacto" method="post">
            <input type="hidden" name="producto" value="<?=$producto['nombre']?>" >
            <input type="hidden" name="url" value="<?=ROOT_PATH?>catalogo/<?=$producto['categoria_id']?>/<?=$producto['categoria']?>/detalle/<?=$producto['id']?>/<?=$producto['nombre']?>">
          <input type="submit" class="btn btn-primary cotizar-btn" value="Cotizar">
        </form>
        </div>
        
        

      </div>

    </div>
  </div>
</div>
<script>
$(".main-image").elevateZoom();
</script>
<?php
include_once "includes/footer.php";
?>
