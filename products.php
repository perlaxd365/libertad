<?php

require_once "ems/administrador/clases/clsCarta.php";

require_once "funciones/session.php";

require_once 'side/header.php';

require_once "funciones/conexion.php";

require_once "ems/logistica/clases/clsProducto.php";



if (!isset($_SESSION["cCarta"])) {

    $_SESSION["cCarta"] = new clsCarta;

}



$objProducto = new clsProducto();





?>

<?php

switch($_GET["page"])

{

    

    case "add_home":

        	

        $rs = $objProducto->Listar(1,$_GET["pathId"],0,0);

        $fila = $rs->fetch_assoc();

        

        $sCant = ( $_POST["cmbCantidad"] < 1 ) ? 1 : $_POST["cmbCantidad"];

        

        $item["nombre"]         =   $fila["prod_descripcion"];

        $item["cant"]           =   $sCant;

        $item["precio"]         =   FormatNumber($fila["pvpd_importe"],2);

        $_POST["txtIdProducto"] =   $_GET["pathId"];



        $_SESSION["cCarta"]->Add_Item($_POST["txtIdProducto"],$item);

        echo "<script>location='order.php?page=viewcesta'</script>";

        

        break;

    

    case "verdetalle": #Detalle de producto

        $rs  = $objProducto->Listar(1,$_GET["pathId"],0,0); 

    break;

}

?>

<main id="main" data-aos="fade-up">

<?php

switch($_GET["page"])

{

    case "verdetalle": #Detalle de producto      

        $row = $rs->fetch_assoc();

?>

    <section class="breadcrumbs">

      <div class="container">



        <div class="d-flex justify-content-between align-items-center">

            <?php

            if(!isset($_SESSION['sUser'])){

            ?>

            <h2>Detalle de producto</h2>

            <?php

            }else{

            ?>

            <h2>¡Hola <?=$_SESSION["sUser"]["usrNombre"]?>!</h2>

            <?php

            }

            ?>

          <ol>

            <li><a href="index.php">Inicio</a></li>

            <li>Detalle de producto</li>

          </ol>

        </div>



      </div>

    </section>

    <form name="frm" action="products.php?page=add_home&pathId=<?=$row["prod_codigo"]?>" method="post" onsubmit="frm.cmdAgregar.disabled=true">

    <section id="portfolio-details" class="portfolio-details">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <div class="portfolio-details-slider swiper-container">

                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">

                                <img src="resources/images/general/<?=VerImage($row["produc_imagen"])?>" alt="">

                            </div>

                        </div>

                        <div class="swiper-pagination"></div>                        

                    </div>

                </div>

                

                <div class="col-lg-4">

                    <div class="portfolio-info">

                        <h3 class="text-center"><?=$row["prod_descripcion"]?></h3>

                        <input type="hidden" name="txtNombre" id="txtNombre" value="<?=$row["prod_descripcion"]?>">

                        <p>

                            <strong> <h2 class="text-primary text-center">S/. <?=FormatNumber($row["pvpd_importe"],2)?></h2></strong>

                            <input type="hidden" name="txtPrecio" id="txtPrecio" value="<?=FormatNumber($row["pvpd_importe"],2)?>">

                        </p>

                        <p>

                        <div class="form-floating"> 

                            <select class="form-select" name="cmbCantidad" id="cmbCantidad">

                                <option value="1">1</option>

                                <option value="2">2</option>

                                <option value="3">3</option>

                                <option value="4">4</option>

                                <option value="5">5</option>

                            </select>

                            <label for="fCant">Cantidad</label>

                        </div>

                    </p>

                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="cmdAgregar" id="cmdAgregar">Añadir al carrito</button>



                    </div>

                    <div class="portfolio-description">

                        <p class="text-justify">

                        <?=$row["prod_denominacion"]?>

                        </p>

                    </div>

                </div>

                

            </div>

        </div>

    </section>

    </form>

<?php

    break;

}

?>

</main>

<?php

require_once 'side/footer.html';

?>