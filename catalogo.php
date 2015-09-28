
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
       
        <ul class="list-group">
          <li class="list-group-item active"><a href="<?=ROOT_PATH?>catalogo">Todas las categor&iacute;as</a></li>
          <?php
          foreach($categorias as $cat) {
          ?>
            <li class="list-group-item"><a href="<?=ROOT_PATH?>catalogo/<?=$cat['id']?>/<?=$cat['descripcion']?>"><?=$cat['descripcion']?></a></li>
          <?php
          }
          ?>
        </ul>
      </div>
      <div class="col-md-8">
        <ol class="breadcrumb">
          <li><a href="catalogo.php">Todas las categor&iacute;as</a></li>
          <li><a href="#">Categor&iacute;a seleccionada</a></li>
          <li class="active">Item seleccionado</li>
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
                <img src="<?=$prod['imagen']?>" alt="<?=$prod['nombre']?>">
                <div class="caption">
                  <h3><?=$prod['nombre']?></h3>
                  <p class="descripcion"><?=$prod['descripcion']?></p>
                  <p><a href="detalle.php" class="btn btn-primary" role="button">Ver m&aacute;s</a> </p>
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
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php
              $i = 0;
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
              <li>
                <a href="<?=$next?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
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
