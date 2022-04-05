<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php

require_once "funciones/conexion.php";
require_once './ems/administrador/clases/clsConfigweb.php';

$objConfig   = new clsConfigweb();

$configData =$objConfig->ListarConfigWeb();

while($rows = $configData->fetch_assoc()){
    $correo=$rows["correo_eti"];
    $telefono=$rows["telefono_eti"];
}
?>

<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Page-Enter" content="blendTrans(Duration=0.5)" />

    <meta name="description" content="Pollos y Parrilladas Libertad">

    <meta name="author" content="Pollos y Parrilladas Libertad">

    <title>Pollos y Parrilladas Libertad</title>

    <link rel="icon" href="resources/images/general/libertad.ico" sizes="16x16" type="image/png">

    <link href="resources/css/web.css" rel="stylesheet" type="text/css" />

    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="resources/bootstrap/css/bootstrap-icons.css" rel="stylesheet">

    <!--<link href="resources/css/font-awesome.css" rel="stylesheet" type="text/css"/>-->

    <link href="resources/css/boxicons.min.css" rel="stylesheet" type="text/css" />



    <link href="resources/css/owl.carousel.css" rel="stylesheet" type="text/css" />

    <link href="resources/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <link href="resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet" type="text/css" />



    <link href="resources/css/adminlte.css" rel="stylesheet" type="text/css" />



    <style>
        .bd-placeholder-img {

            font-size: 1.125rem;

            text-anchor: middle;

            -webkit-user-select: none;

            -moz-user-select: none;

            user-select: none;

        }



        @media (min-width: 768px) {

            .bd-placeholder-img-lg {

                font-size: 3.5rem;

            }

        }





        .carousel-caption {

            bottom: 10rem;

            z-index: 10;

        }



        .carousel-item {

            height: 32rem;

        }



        .carousel-item>img {

            /*top           : 0;

                left          : 0;

                width         : 100%;

                height        : 60vh;

                opacity       : 1;

                object-fit    : cover;*/

            object-fit: cover;

            top: 0;

            left: 0;

            min-width: 100%;

            height: 32rem;

        }
    </style>

    <script src="resources/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <script src="resources/js/jquery.min.js" type="text/javascript"></script>

    <script src="resources/js/isiAJAX/isiAJAX.js" type="text/javascript"></script>

    <script src="resources/js/isiAJAX/isiXML.js" type="text/javascript"></script>

    <script src="resources/js/adminlte.min.js" type="text/javascript"></script>



</head>

<body onload="myajax = new isiAJAX();">

    <section id="topbar" class="d-flex align-items-center ">

        <div class="container d-flex justify-content-center justify-content-md-between ">

            <div class="contact-info d-flex align-items-center">

                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:<?=$correo?>"><?=$correo?></a></i>

                <i class="bi bi-phone d-flex align-items-center ms-4"><span><?=$telefono?></span></i>

            </div>

            <div class="social-links d-none d-md-flex align-items-center">

                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>

                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>

                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>

                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>

            </div>

        </div>

    </section>



    <header id="header" class="d-flex align-items-center ">

        <div class="container d-flex align-items-center justify-content-between">

            <img src="resources/images/general/logo.png" class="brand-image" style="opacity: .8" height="72">

            <!-- <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                    <li class="nav-item"><a class="-link scrollto" href="index.php">Inicio</a></li>

                    <li class="nav-item"><a class="nav-link scrollto" href="nosotros.php">Nosotros</a></li>

                    <li class="dropdown"><a href="#"><span>Carta</span> <i class="bi bi-chevron-down"></i></a>

                            <ul>

                                <li><a href="#">Pollos a la Brasa</a></li>

                                <li><a href="#">Entradas y Piqueos</a></li>

                                <li><a href="#">Guarniciones</a></li>

                                <li><a href="#">Sánguches Polleros</a></li>

                                <li><a href="#">Pollos a la Parrila</a></li>

                                <li><a href="#">Ensaladas</a></li>

                                <li><a href="#">Postres</a></li>

                            </ul>

                        </li>


                    <li class="nav-item"><a class="nav-link scrollto" href="contacto.php">Contáctenos</a></li>

                    <?php

                    if (!isset($_SESSION['sUser'])) {

                    ?>

                        <li class="nav-item"><a class="nav-link scrollto" href="login.php">Login</a></li>

                    <?php

                    } else {

                    ?>

                        <li class="dropdown nav-item"><a href="#"><span>Mi cuenta</span> <i class="bi bi-chevron-down"></i></a>

                            <ul>

                                <li><a href="profile.php?page=edit">Mi perfil</a></li>

                                <li><a href="profile.php?page=pedido">Mis pedidos</a></li>

                                <li><a href="login.php?page=logout">Cerrar sesión</a></li>

                            </ul>

                        </li>

                    <?php

                    }

                    ?>

                    <li class="nav-item"><a class="nav-link scrollto" href="http://www.corschsystems.com/LibertadAdmin/">Administración</a></li>
                    <li><a href="#" onclick="javascript:document.getElementById(`asunto`).submit();
                            return true;">Consultar CP</a></li>
                    <li class="nav-item">
                        <form method="post" action="https://www.corschsystems.com/LibertadAdmin/" id="asunto">
                            <input type="hidden" name="consultarCPE" value="consultarCPE">
                        </form>


                    </li>
                    <li class="nav-item">
                    <li class="bi bi-cart2 nav-item"></li><a href="order.php?page=viewcesta"><?= $_SESSION['cCarta']->num_items ?></a></li>

                </ul>

                <i class="bi bi-list mobile-nav-toggle nav-item"></i>

            </nav>  -->










            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">

                        <li class="nav-item">
                        <li class="nav-item"><a class="-link scrollto" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="nosotros.php">Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="contacto.php">Contáctenos</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" target="_blank" href="https://www.corschsystems.com/LibertadAdmin/">Administración</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" target="_blank" href="https://www.corschsystems.com/LibertadAdmin?consultarCPE=1">Consultar CP</a></li>
                        
                        <?php

                        if (!isset($_SESSION['sUser'])) {

                        ?>

                            <li class="nav-item"><a class="nav-link scrollto" href="login.php">Login</a></li>

                        <?php

                        } else {

                        ?>

                            <li class="dropdown nav-item"><a href="#"><span>Mi cuenta</span> <i class="bi bi-chevron-down"></i></a>

                                <ul>

                                    <li><a href="profile.php?page=edit">Mi perfil</a></li>

                                    <li><a href="profile.php?page=pedido">Mis pedidos</a></li>

                                    <li><a href="login.php?page=logout">Cerrar sesión</a></li>

                                </ul>

                            </li>

                        <?php

                        }

                        ?>
                        <li class="nav-item">
                        <li class="bi bi-cart2 nav-item"></li><a href="order.php?page=viewcesta"><?= $_SESSION['cCarta']->num_items ?></a></li>

                        <i class="bi bi-list mobile-nav-toggle nav-item"></i>
                    </div>
                </div>
            </nav>
        </div>

    </header>