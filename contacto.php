<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "conexion/phpmailer/PHPMailer.php";
require_once "conexion/phpmailer/Exception.php";
require_once "conexion/phpmailer/SMTP.php";


require_once "ems/administrador/clases/clsCarta.php";

require_once "funciones/session.php";

require_once 'side/header.php';


if (isset($_POST["nombre"]) && $_POST["nombre"] != '' && 
          $_POST["correo"] != '' && $_POST["correo"] != '' && 
          $_POST["asunto"] != '' && $_POST["asunto"] != '' && 
          $_POST["mensaje"] != '' && $_POST["mensaje"] != ''  ) {



    try {
      $phpMailer = new PHPMailer();
      $phpMailer->setFrom($_POST["correo"]); # Correo y nombre del remitente
  
      $phpMailer->Subject =$_POST["asunto"]; # Asunto
      $phpMailer->Body =$_POST["mensaje"];  # Cuerpo en texto plano
  
      // Aquí la magia:
  
  
      $phpMailer->addAddress("perlaxd365@gmail.com");
      

      if (!$phpMailer->send()) {
        echo "Error enviando correo: " . $phpMailer->ErrorInfo;
      }else{
        echo '<script>swal({
          title: "Mensaje Enviado",
          text: "Gracias por contactarnos, te daremos una respuesta. Gracias",
          icon: "success",
          button: "Aceptar"
        });
        </script>';
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

<section id="contact" class="contact">

    <div class="container" data-aos="fade-up">

        <div class="section-title">

          <h3><span>Contáctenos</span></h3>

          <p>Aquí te dejamos algunos medios para que te pongas en contácto con nosotros</p>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6">

            <div class="info-box mb-4">

              <i class="bx bx-map"></i>

              <h3>Dirección</h3>

              <div style="margin-top: 12px; margin-left: 40px;">
              <p>Av. 28 de Julio 600, Huacho, Lima</p>
            </div>
            </div>

        </div>

        <div class="col-lg-6 col-md-6">

            <div class="info-box  mb-4">

              <i class="bx bx-envelope"></i>

              <h3>Correo</h3>

              <div style="margin-top: 12px; margin-left: 40px;">
              <p>contacto@midominio.com</p>
              </div>
            </div>

        </div>

        <div class="col-lg-6 col-md-6">

            <div class="info-box  mb-4">

              <i class="bx bx-phone-call"></i>

              <h3>Delivery</h3>

              <div style="margin-top: 12px; margin-left: 40px;">
              <p>+51 963 533 194</p>
              </div>
            </div>

        </div> 

            

        <div class="row" data-aos="fade-up" data-aos-delay="100">



          <div class="col-lg-6 ">

            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d22147.23368289127!2d-77.56941094578292!3d-11.104822646613679!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9106df752db5763b%3A0xab7afd1a1fa06d11!2sAvenida%2028%20de%20Julio%20600%2C%20Huacho%2015136!5e0!3m2!1ses-419!2spe!4v1619198009792!5m2!1ses-419!2spe" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>

          </div>



          <div class="col-lg-6">

            <form action="" method="post" role="form" class="php-email-form">

              <div class="row">

                <div class="col form-group">

                  <input type="text" name="nombre" class="form-control" id="name" placeholder="Nombres" required>

                </div>

                <div class="col form-group">

                  <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" required>

                </div>

              </div>

              <div class="form-group">

                <input type="text" class="form-control" name="asunto" id="subject" placeholder="Asunto" required>

              </div>

              <div class="form-group">

                <textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>

              </div>


              <div class="text-center"><button type="submit">Enviar</button></div>

            </form>

          </div>



        </div>    

            

            

    </div>

</section>
