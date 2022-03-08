<?php

require_once "funciones/conexion.php";
require_once './ems/administrador/clases/clsConfigweb.php';
require_once './ems/administrador/clases/clsSuscripcion.php';

use PHPMailer\PHPMailer\PHPMailer;

require_once "conexion/phpmailer/PHPMailer.php";
require_once "conexion/phpmailer/Exception.php";
require_once "conexion/phpmailer/SMTP.php";

$objConfig   = new clsConfigweb();
$objSuscripcion   = new clsSuscripcion();
$configData = $objConfig->ListarConfigWeb();

while ($rows = $configData->fetch_assoc()) {
  $correo = $rows["correo_eti"];
  $telefono = $rows["telefono_eti"];
  $facebook = $rows["url_fb_eti"];
  $copy = $rows["copy_eti"];
}

if (isset($_POST["email"]) && $_POST["email"] != '') {
  $objSuscripcion->addSuscripcion($_POST["email"]);
  try {
    $phpMailer = new PHPMailer();
    $phpMailer->setFrom("cesar.baca@corschsystems.com", "CORSCH SYSTEMS"); # Correo y nombre del remitente

    $phpMailer->Subject = "Gracias por suscribirte a Libertad"; # Asunto
    $phpMailer->Body = "Por este medio recibirás novedades y promociones"; # Cuerpo en texto plano
    // Aquí la magia:


    $phpMailer->addAddress($_POST["email"]);

    if (!$phpMailer->send()) {
      echo "Error enviando correo: " . $phpMailer->ErrorInfo;
    }
    # Opcionalmente podrías eliminar el archivo después de enviarlo, si quieres
    // if (file_exists($nombreDelDocumento)) {
    // unlink($nombreDelDocumento);
    // }
    echo "Enviado correctamente";
  } catch (Exception $e) {
    echo "Excepción: " . $e->getMessage();
  }
}
?>


<footer id="footer">

  <div class="footer-newsletter">

    <div class="container">

      <div class="row justify-content-center">

        <div class="col-lg-6">

          <h4>Suscríbase a nuestro boletín</h4>

          <p>Si estás interesado en recibir por correo electrónico novedades, suscríbete de forma gratuita</p>

          <form action="" method="post">

            <input type="email" name="email">
            <input type="submit" value="Suscríbete">

          </form>

        </div>

      </div>

    </div>

  </div>



  <div class="footer-top">

    <div class="container">

      <div class="row">



        <div class="col-lg-3 col-md-6 footer-contact">

          <h3>Pollería Libertad.</h3>

          <p>

            Av. 28 de Julio 600 <br>

            Lima, Huacho<br>

            Perú <br><br>

            <strong>Delivery</strong> <?= $telefono ?><br>

            <strong>Email:</strong> <?= $correo ?><br>

          </p>

        </div>



        <div class="col-lg-3 col-md-6 footer-links">

          <h4>Enlaces</h4>

          <ul>

            <li><i class="bx bx-chevron-right"></i> <a href="index.php">Inicio</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="nosotros.php">Nosotros</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="contacto.php">Contáctenos</a></li>

          </ul>

        </div>



        <div class="col-lg-3 col-md-6 footer-links">

          <h4>Carta</h4>

          <ul>

            <li><i class="bx bx-chevron-right"></i> <a href="#">Pollos a la Brasa</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="#">Entradas y Piqueos</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="#">Guarniciones</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="#">Sánguches Polleros</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="#">Pollos a la Parrilla</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="#">Ensaladas</a></li>

            <li><i class="bx bx-chevron-right"></i> <a href="#">Postres</a></li>

          </ul>

        </div>



        <div class="col-lg-3 col-md-6 footer-links">

          <h4>Nuestras redes sociales</h4>

          <p>Conoce más siguiéndonos en nuestras redes sociales</p>

          <div class="social-links mt-3">

            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>

            <a href="<?= $facebook ?>" class="facebook"><i class="bx bxl-facebook"></i></a>

            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>


            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>

          </div>

        </div>



      </div>

    </div>

  </div>



  <div class="container py-4">

    <div class="copyright">

      2022 &copy; <strong><span><?= $copy ?></span></strong>.

    </div>

  </div>



</footer>



</body>

</html>