<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

  $emailEncontrado = $objSuscripcion->buscarSuscripcion($_POST["email"]);
  $contador = 0;
  while ($rows2 = $emailEncontrado->fetch_assoc()) {
    $contador++;
  }



  if ($contador >= 1) {
    echo '<script>swal({
      title: "Error",
      text: "El email ya se encuentra registrado, intenta con otro email. Gracias !",
      icon: "error",
      button: "Aceptar"
    });
    </script>';
  } else {

    $objSuscripcion->addSuscripcion($_POST["email"]);
    echo '<script>swal({
      title: "Te has suscrito",
      text: "Gracias por unirte al boletin, revisa tu bandeja de entrada.",
      icon: "success",
      button: "Aceptar"
    });
    </script>';
  }
  try {
    $phpMailer = new PHPMailer();
    $phpMailer->setFrom("cesar.baca@corschsystems.com", "CORSCH SYSTEMS"); # Correo y nombre del remitente

    $phpMailer->Subject = "Gracias por suscribirte a Pollos y Parrillas Libertad "; # Asunto
    $phpMailer->isHTML(true);
    $phpMailer->Body = '<!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no">
    <title></title>
    
    
    <!--##custom-font-resource##-->
    <!--[if gte mso 16]>
    <xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <style>
    html,body,table,tbody,tr,td,div,p,ul,ol,li,h1,h2,h3,h4,h5,h6 {
    margin: 0;
    padding: 0;
    }
    
    body {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
    }
    
    table {
    border-spacing: 0;
    mso-table-lspace: 0pt;
    mso-table-rspace: 0pt;
    }
    
    table td {
    border-collapse: collapse;
    }
    
    h1,h2,h3,h4,h5,h6 {
    font-family: Arial;
    }
    
    .ExternalClass {
    width: 100%;
    }
    
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
    line-height: 100%;
    }
    
    /* Outermost container in Outlook.com */
    .ReadMsgBody {
    width: 100%;
    }
    
    img {
    -ms-interpolation-mode: bicubic;
    }
    
    </style>
    
    <style>
    a[x-apple-data-detectors=true]{
    color: inherit !important;
    text-decoration: inherit !important;
    }
    
    u + #body a {
    color: inherit;
    text-decoration: inherit !important;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
    }
    
    a, a:link, .no-detect-local a, .appleLinks a {
    color: inherit !important;
    text-decoration: inherit;
    }
    
    </style>
    
    <style>
    
    .width600 {
    width: 600px;
    max-width: 100%;
    }
    
    @media all and (max-width: 599px) {
    .width600 {
    width: 100% !important;
    }
    }
    
    @media screen and (min-width: 600px) {
    .hide-on-desktop {
    display: none !important;
    }
    }
    
    @media all and (max-width: 599px),
    only screen and (max-device-width: 599px) {
    .main-container {
    width: 100% !important;
    }
    
    .col {
    width: 100%;
    }
    
    .fluid-on-mobile {
    width: 100% !important;
    height: auto !important;
    text-align:center;
    }
    
    .fluid-on-mobile img {
    width: 100% !important;
    }
    
    .hide-on-mobile {
    display:none !important;
    width:0px !important;
    height:0px !important;
    overflow:hidden;
    }
    }
    
    </style>
    
    
    <!--[if gte mso 9]>
    <style>
    
    .col {
    width: 100%;
    }
    
    .width600 {
    width: 600px;
    }
    
    .width130 {
    width: 130px;
    height: auto;
    }
    .width70 {
    width: 70px;
    height: auto;
    }
    
    .hide-on-desktop {
    display: none;
    }
    
    .hide-on-desktop table {
    mso-hide: all;
    }
    
    .hide-on-desktop div {
    mso-hide: all;
    }
    
    .nounderline {text-decoration: none; }
    
    .mso-font-fix-arial { font-family: Arial, sans-serif; }
    .mso-font-fix-comic_sans_ms { font-family: "Comic Sans MS", sans-serif; }
    .mso-font-fix-courier { font-family: Courier, monospace; }
    .mso-font-fix-georgia { font-family: Georgia, serif; }
    .mso-font-fix-segoe_ui { font-family: "Segoe UI", sans-serif; }
    .mso-font-fix-tahoma { font-family: Tahoma, sans-serif; }
    .mso-font-fix-times_new_roman { font-family: "Times New Roman", serif; }
    .mso-font-fix-trebuchet_ms { font-family: "Trebuchet MS", sans-serif; }
    .mso-font-fix-verdana { font-family: Verdana, sans-serif; }
    
    </style>
    <![endif]-->
    
    </head>
    <body id="body" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="font-family:Arial, sans-serif; font-size:0px;margin:0;padding:0;background-color:#ffffff;">
    <style>
    @media screen and (min-width: 600px) {
    .hide-on-desktop {
    display: none;
    }
    }
    @media all and (max-width: 599px) {
    .hide-on-mobile {
    display:none !important;
    width:0px !important;
    height:0px !important;
    overflow:hidden;
    }
    .main-container {
    width: 100% !important;
    }
    .col {
    width: 100%;
    }
    .fluid-on-mobile {
    width: 100% !important;
    height: auto !important;
    text-align:center;
    }
    .fluid-on-mobile img {
    width: 100% !important;
    }
    }
    </style>
    <div style="background-color:#ffffff;">
    <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
    <td valign="top" align="left">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td width="100%">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td align="center" width="100%">
    <!--[if gte mso 9]><table width="600" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
    <table class="width600 main-container" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:600px;">
    <tr>
    <td width="100%">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td valign="top">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td valign="top">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td valign="top" align="center"><!--[if gte mso 9]><table width="130" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
    <table cellpadding="0" cellspacing="0" border="0" style="max-width:100%;" class="img-wrap">
    <tr>
    <td valign="top" align="center"><img src="https://i.postimg.cc/brBpHgnh/gallo.png" width="130" height="130" alt="" border="0" style="display:block;font-size:14px;max-width:100%;height:auto;" class="width130" />
    </td>
    </tr>
    </table>
    <!--[if gte mso 9]></td></tr></table><![endif]-->
    </td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td style="padding:10px;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-top:2px solid #a9a9a9;">
    <tr>
    <td style="font-size:0px;line-height:0;mso-line-height-rule:exactly;">&nbsp;
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td valign="top" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;"><div style="font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:18px;color:#131313;line-height:25px;text-align:left;"><p style="padding: 0; margin: 0;"><span class="mso-font-fix-arial">Bienvenido a Libertad</span></p>
    <p style="padding: 0; margin: 0;">&nbsp;</p>
    <p style="padding: 0; margin: 0;"><span class="mso-font-fix-arial"><span style="font-size:16px;">Buenas Tardes</span></span></p>
    <p style="padding: 0; margin: 0;"><span class="mso-font-fix-arial"><span style="font-size:16px;">Tu suscripción se ha realizado con exito, ya eres parte de </span></span></p>
    <p style="padding: 0; margin: 0;"><span class="mso-font-fix-arial"><span style="font-size:16px;">gran familia Libertad, por este medio recibirás novedades,  </span></span></p>
    <p style="padding: 0; margin: 0;"><span class="mso-font-fix-arial"><span style="font-size:16px;">descuentos y promociones, permanece atento, que tengas buen día.</span></span></p>
    <p style="padding: 0; margin: 0;">&nbsp;</p>
    </div>
    </td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td valign="top" align="center" style="padding:20px;">
    <!--[if !mso]><!-- -->
    <a href="" target="_blank" style="display:inline-block; text-decoration:none;" class="fluid-on-mobile">
    <span>
    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#0094c5" style="border-radius:5px;border-collapse:separate !important;background-color:#0094c5;" class="fluid-on-mobile">
    <tr>
    <td align="center" style="padding:15px;">
    <span style="color:#ffffff !important;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:10px;mso-line-height:exactly;line-height:10px;letter-spacing: normal;">
    <font style="color:#ffffff;" class="button">
    <a class="mso-font-fix-arial" href="https://www.corschsystems.com/libertad">Ir a la tienda</a>
    </font>
    </span>
    </td>
    </tr>
    </table>
    </span>
    </a>
    <!--<![endif]-->
    <div style="display:none; mso-hide: none;">
    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#0094c5" style="border-radius:5px;border-collapse:separate !important;background-color:#0094c5;" class="fluid-on-mobile">
    <tr>
    <td align="center" style="padding:15px;">
    <a href="" target="_blank" style="color:#ffffff !important;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:10px;mso-line-height:exactly;line-height:10px;letter-spacing: normal;text-decoration:none;text-align:center;">
    <span style="color:#ffffff !important;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:10px;mso-line-height:exactly;line-height:10px;letter-spacing: normal;">
    <font style="color:#ffffff;" class="button">
    <a class="mso-font-fix-arial" href="https://www.corschsystems.com/libertad">Ir a la tienda</a>
    </font>
    </span>
    </a>
    </td>
    </tr>
    </table>
    </div>
    </td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td style="padding:10px;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-top:2px solid #a9a9a9;">
    <tr>
    <td style="font-size:0px;line-height:0;mso-line-height-rule:exactly;">&nbsp;
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td valign="top" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;"><div style="font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:18px;color:#131313;line-height:25px;text-align:left;"><p style="padding: 0; margin: 0;text-align: center;"><span class="mso-font-fix-arial"><span style="font-size:11px;">Atentamente Pollos y Parrillas Libertad</span></span></p>
    </div>
    </td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td valign="top" align="center"><!--[if gte mso 9]><table width="70" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
    <table cellpadding="0" cellspacing="0" border="0" style="max-width:100%;" class="img-wrap">
    <tr>
    <td valign="top" align="center"><img src="https://i.postimg.cc/brBpHgnh/gallo.png" width="70" height="70" alt="" border="0" style="display:block;font-size:14px;max-width:100%;height:auto;" class="width70" />
    </td>
    </tr>
    </table>
    <!--[if gte mso 9]></td></tr></table><![endif]-->
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    <!--[if gte mso 9]></td></tr></table><![endif]-->
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    </div>
    </body>
    </html>';  # Cuerpo en texto plano

    // Aquí la magia:


    $phpMailer->addAddress($_POST["email"]);

    if (!$phpMailer->send()) {
      echo "Error enviando correo: " . $phpMailer->ErrorInfo;
    }
    # Opcionalmente podrías eliminar el archivo después de enviarlo, si quieres
    // if (file_exists($nombreDelDocumento)) {
    // unlink($nombreDelDocumento);
    // }
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