    <?php
    include_once "backend/params.php";
    include_once "backend/consultas.php";
    include_once "includes/header.php";

    $db = new Consultas();

    $destacados = $db->getProductosDestacados();

    ?>

    <div class="row">
     <div class="jumbotron">

      <h1>Articulos Promocionales</h1>
      <p>Encuentre todos los art&iacuteculos que necesita.</p>
      <a href="#">Ver m&aacutes</a>

    </div> 
  </div>
  <div class="row">
    <div class="neighborhood-guides">

      <div class="row">
        <div class="col-md-12">

          <div class="row">

            <div class="col-sm-8">
              <div class="texto-margen"><h2>Productos Destacados</h2>
                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
              </div>
              <?php
              foreach ($destacados as $d) {
                ?>
                <div class="col-sm-4">
                  <div class="thumbnail">
                    <a href="<?=ROOT_PATH?>catalogo/<?=$d['categoria_id']?>/<?=$d['categoria']?>/detalle/<?=$d['id']?>/<?=$d['nombre']?>"><img class="img_peq" src="<?=IMAGE_BASE.'200/'.$d['imagen']?>" ></a>
                  </div>
                </div>
                <?php
              }
              ?>
              
            </div>
            <div class="col-md-4">
             <div class="thumbnail">
              <img class="img_magic" src="img/magic.png" >
              <div class="caption">
                
               
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php
  include_once "includes/footer.php";
  ?>
