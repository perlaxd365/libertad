<?php

require_once 'side/header.html';

require_once "funciones/conexion.php";

require_once "ems/logistica/clases/clsProducto.php";



$objProducto = new clsProducto();



$rs  = $objProducto->Listar(1,$_GET["pathId"],0,0);

$row = $rs->fetch_assoc();

?>

<main id="main" data-aos="fade-up">

    <section class="breadcrumbs">

      <div class="container">



        <div class="d-flex justify-content-between align-items-center">

          <h2>Detalle de producto</h2>

          <ol>

            <li><a href="index.php">Inicio</a></li>

            <li>Detalle de producto</li>

          </ol>

        </div>



      </div>

    </section>

    

    <section id="portfolio-details" class="portfolio-details">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <div class="portfolio-details-slider swiper-container">

                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">

                                <img src="resources/images/general/01.jpg" alt="">

                            </div>

                        </div>

                        <div class="swiper-pagination"></div>                        

                    </div>

                </div>

                

                <div class="col-lg-4">

                    <div class="portfolio-info">

                        <h3 class="text-center"><?=$row["prod_descripcion"]?></h3>

                        <p>

                            <strong> <h2 class="text-primary text-center">S/. <?=FormatNumber($row["pvpd_importe"],2)?></h2></strong>

                        </p>

                        <p>

                        <div class="form-floating"> 

                            <select class="form-select">

                                <option value="1">1</option>

                                <option value="2">2</option>

                                <option value="3">3</option>

                                <option value="4">4</option>

                                <option value="5">5</option>

                            </select>

                            <label for="fCant">Cantidad</label>

                        </div>

                    </p>

                        <button class="w-100 btn btn-lg btn-primary" type="button">Añadir al carrito</button>



                    </div>

                    <div class="portfolio-description">

                        <p class="text-justify">

                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.

                        </p>

                    </div>

                </div>

                

            </div>

        </div>

    </section>

    

</main>

<?php

require_once 'side/footer.php';



?>