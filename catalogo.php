
  <?php
  include_once "backend/params.php";
  include_once "backend/consultas.php";
  include_once "includes/header.php";

  $db = new Consultas();

  $categorias = $db->getCategorias();

  $from = 0;

  $totalItems = 0;

  if (isset($_GET['from']) && is_numeric($_GET['from'])) {
    $from = $_GET['from'];
  }

  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productos = $db->getProductosbyCategoria($_GET['id'], $from, PAGE_SIZE);
    $total = $db->getProductosbyCategoriaCount($_GET['id']);
    $categoriaSeleccionada = $db->getCategoriaById($_GET['id']);
  }
  else {
    $productos = $db->getProductos($from, PAGE_SIZE);
    $total = $db->getProductosCount();
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
          <?php
          if (isset($categoriaSeleccionada)) {
          ?>
          <li class="active"><?=$categoriaSeleccionada['descripcion']?></li>
          <?php
          }
          ?>
        </ol>
        <p>
        <?php
        if ($from + PAGE_SIZE > $total) {
        ?>
        <small>Mostrando <strong><?=$from + 1?> - <?= $total ?></strong> de <strong><?=$total?></strong></small>
        <?php
        }
        else {
        ?>
          <small>Mostrando <strong><?=$from + 1?> - <?=$from + PAGE_SIZE ?></strong> de <strong><?=$total?></strong></small>
        <?php
        }
        ?>
        </p>
        <div class="row listado">


          <?php
          foreach ($productos as $prod) {

            $descripcion = $prod['descripcion'];
            if (sizeof($descripcion) > 100) {
              $descripcion = substr($descripcion, 0, 97).'...';
            }
          ?>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="<?=IMAGE_BASE.'200/'.$prod['imagen']?>" alt="<?=$prod['nombre']?>">
                <div class="caption">
                  <h3><?=$prod['nombre']?></h3>
                  <p class="descripcion"><?=$prod['descripcion']?></p>
                  <p><a href="<?=ROOT_PATH?>catalogo/<?=$prod['categoria_id']?>/<?=$prod['categoria']?>/detalle/<?=$prod['id']?>/<?=$prod['nombre']?>" class="btn btn-primary" role="button">Ver m&aacute;s</a> </p>
                </div>
              </div>
            </div>
          <?php
          }
          ?>

        </div>
        <?php
          $pagesNumber = ceil($total / PAGE_SIZE);

          if ($pagesNumber > 1) {
        ?>
          <nav>
            <ul class="pagination">
              <?php
              $i = 0;
              //$current = @@
              while ($i < $pagesNumber) {
                if (isset($_GET['id'])) {
                  $url = 'catalogo/'.$_GET['id'].'/categoria/'.($i * PAGE_SIZE);
                }
                else {
                 $url = 'catalogo/from/'.($i * PAGE_SIZE); 
                }
              ?>
                <li><a href="<?=ROOT_PATH.$url?>"><?=$i+1?></a></li>
              <?php
              $i++;
              }
              ?>              
            </ul>
          </nav>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <?php
  include_once "includes/footer.php";
  ?>
