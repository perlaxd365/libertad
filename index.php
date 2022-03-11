<?php
require_once "ems/administrador/clases/clsCarta.php";
require_once "funciones/session.php";
require_once 'side/header.php';
require_once "funciones/conexion.php";
require_once "ems/logistica/clases/clsProducto.php";
require_once 'ems/administrador/clases/clsBiblioteca.php';

$ItemsPag        = 9;
$action      = isset($_GET['action'])   ? $_GET['action']     : null;
$pagina      = isset($_GET['pagina'])   ? $_GET['pagina']     : 1;

if (!isset($_SESSION["cCarta"])) {
    $_SESSION["cCarta"] = new clsCarta;
}

$objProducto   = new clsProducto();
$objBiblioteca = new clsBiblioteca();

$rsBib = $objBiblioteca->Listar(4, 1, 2);
$Num_RowsBib = $rsBib->num_rows;
?>
<meta charset="utf-8">
<section id="banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            for ($i = 0; $i < $Num_RowsBib; $i++) {
                $vFlag =  ($i === 0) ? 'active' : '';
            ?>
                <li data-bs-target="#carouselExampleControls" data-bs-slide-to="<?= $i ?>" <?= $vFlag; ?>></li>
            <?php
            }
            ?>
        </ol>

        <div class="carousel-inner">
            <?php
            $i = 0;
            while ($row_ = $rsBib->fetch_assoc()) {
                $vFlag =  ($i === 0) ? 'active' : '';
            ?>
                <div class="carousel-item <?= $vFlag; ?>">
                    <img src="resources/images/slider/<?= $row_["BIB_PATH"] ?>" alt="">
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1><?= utf8_decode($row_["BIB_TITULO"])  ?></h1>
                            <p><?= utf8_encode($row_["BIB_DESCRIPCION"])  ?></p>
                            <?php
                            if ($row_["BIB_BOTON"] !== "-" and $row_["BIB_BOTON"] !== "") {
                            ?>
                                <p><a class="btn btn-outline-secondary" target="_blank" href="<?= $row_["BIB_LINK"] ?>" role="button"><?= $row_["BIB_BOTON"] ?></a></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>

    </div>
</section>
<div class="album py-5 bg-light">
    <div class="container">

        <div class="section-title">
            <h3><span>Nuestra Carta</span></h3>
            <p>
                <?php
                if (isset($_SESSION['sUser'])) {
                ?>
                    ¡Hola <?= $_SESSION["sUser"]["usrNombre"] ?>!; bienvenido a un lugar diferente, complaciente y divertido, con buena Comida Criolla y ​​​​​​​el mejor Pollo a la Brasa
                <?php
                } else {
                ?>
                    Bienvenido a un lugar diferente, complaciente y divertido, con buena Comida Criolla y ​​​​​​​el mejor Pollo a la Brasa
                <?php
                }
                ?>
            </p>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            $Ini = ($pagina - 1) * $ItemsPag;
            $rs_ = $objProducto->Listar(0, null, $Ini, $ItemsPag);

            while ($row = $rs_->fetch_assoc()) {
            ?>
                <div class="col">
                    <div class="card shadow-sm"  style="border-radius: 20px;">
                        <style>

                            img.relacionaspecto {
                                height: 100%;
                                width: 100%;
                                top: 0;
                                left: 0;
                            }

                            img.relacionaspecto {
                                aspect-ratio: 4/3;
                                width: 100%;
                                object-fit: cover;
                            }
                        </style>
                        <a style="border-radius: 15px;" href="products.php?page=verdetalle&pathId=<?= $row["prod_codigo"] ?>" role="button">
                            <img class="relacionaspecto" src="resources/images/general/<?= VerImage($row["produc_imagen"]) ?>" role="img">
                        </a>
                        <div class="card-body">
                            <p class="Titulo"><?= $row["prod_descripcion"] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="products.php?page=verdetalle&pathId=<?= $row["prod_codigo"] ?>" class="btn btn-sm btn-outline-primary" role="button">Mostrar</a>
                                    <a href="products.php?page=add_home&pathId=<?= $row["prod_codigo"] ?>" class="btn btn-sm btn-outline-primary" role="button">Agregar</a>
                                </div>
                                <small class="Precio">S/. <?= FormatNumber($row["pvpd_importe"], 2) ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        $rs = $objProducto->Listar(2, null, 0, 0);

        $Num_Rows   = $rs->num_rows;
        $NroPaginas = ceil($Num_Rows / $ItemsPag);
        $iniLoop    = $pagina;
        $Pos        = $NroPaginas - $pagina;

        if ($Pos <= 5) {
            $iniLoop = $NroPaginas - 5;
        }

        $finLoop = $iniLoop + 4;
        ?>
        <section id="paginar">
            <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    <?php
                    $Prev   = ($pagina > 1)            ? $pagina - 1 : 1;

                    ?>
                    <li class="page-item"><a class="page-link" href="index.php?pagina=1">Primera</a></li>
                    <li class="page-item"><a class="page-link" href="index.php?pagina=<?= $Prev ?>">&laquo;</a></li>
                    <?php

                    for ($i = $iniLoop; $i <= $finLoop; $i++) {
                        $Active = ($_GET["pagina"] == $i) ? 'active'    : '';
                    ?>
                        <li class="page-item <?= $Active ?>"><a class="page-link" href="index.php?pagina=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    }
                    ?>
                    <?php
                    $Next = ($pagina <= $finLoop) ? $pagina + 1 : $pagina;
                    ?>
                    <li class="page-item"><a class="page-link" href="index.php?pagina=<?= $Next ?>">&raquo;</a></li>
                    <li class="page-item"><a class="page-link" href="index.php?pagina=<?= $NroPaginas ?>">Última</a></li>
                </ul>
            </nav>
        </section>
        <?php
        require_once 'side/footer.php';

        ?>