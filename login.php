<?php
require_once "ems/administrador/clases/clsCarta.php";
require_once "funciones/session.php";
require_once 'side/header.php';
require_once "funciones/conexion.php";
require_once "ems/commerce/clases/clsCliente.php";
require_once "ems/logistica/clases/clsProducto.php";

if (!isset($_SESSION["cCarta"])) {
    $_SESSION["cCarta"] = new clsCarta;
}

$error  = isset($_GET['error'])  ? $_GET['error']  : null;
 
$objCliente  = new clsCliente();
$objProducto = new clsProducto();

?>

<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
        <h2>Login</h2>
        <ol>
        <li><a href="index.php">Inicio</a></li>
        <li>Login</li>
        </ol>
        </div>
    </div>
</section>
<?php
switch($_GET["page"])
{
    case "logout":
        session_unset();
        session_destroy();
        echo"<script> location='index.php';</script>";
        exit();
        break;
    
    case "authorized":
        
        $rs = $objCliente->Login(0,$_POST["txtLogin"],$_POST["txtClave"]);        
        $ln_arr = explode("...",$rs);
        
        if( $ln_arr[3] > 0 ){	
            $_SESSION["sUser"]["usrId"]       = $ln_arr[0];
            $_SESSION["sUser"]["usrNombre"]   = $ln_arr[1];
            $_SESSION["sUser"]["usrCorreo"]   = $ln_arr[2];
            echo "<script>location='order.php?page=viewcesta'</script>";							
        }else{
            echo "<script>location='login.php?error=0'</script>";
            exit();
        }
        
        break;
        
    case "recoveryaccount":
?>        
<section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h3>Revisa tu correo</h3>
            <p>
                Hemos enviado información al correo electrónico asociada con tu cuenta.                
            </p>
        </div>
    </div>
</section>
<?php
        break;
    
    case "recovery":
        
        $rs = $objCliente->Login(1,$_POST['txtEmailSend'],null);
        $ln_arr = explode("...",$rs);
        
        if( $ln_arr[3] > 0 ){						  
            echo "<script>location='login.php?page=recoveryaccount'</script>";
            exit();
        }else{
            echo "<script>location='login.php?page=forgot-password&error=0'</script>";
        }
        
        break;
    
    case "forgot-password":
?>
            <center>
            <section class="form-signin">
                <div class="login-box">
                    <div class="login-logo">
                        <b>Restaurar contraseña</b>
                    </div>

                    <div class="card">
                        <div class="card-body login-card-body">
                            
                            <?php
                                if($_GET["error"]==="0"){
                            ?>
                            <p>
                                <div class="alert alert-danger"><?php echo "No encontramos tu cuenta con esa informaci&oacute;n, porfavor intente de nuevo"; ?></div>
                            </p>
                            <?php
                                }else{
                            ?>
                            <p class="login-box-msg">Ingresa tu correo electrónico para restaurar tu contraseña.</p>
                            <?php
                                }
                            ?>
                            
                            

                            <form action="login.php?page=recovery" method="post" name="frmforgetpassword">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Correo" name="txtEmailSend" id="txtEmailSend" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block" id="btnEmailSend" name="btnEmailSend">Restablecer contraseña</button>
                                    </div>
                                </div>
                            </form>
                            <p class="mt-3 mb-1 text-justify"><a href="login.php">Login</a></p>
                            <p class="mb-0 text-justify"><a href="profile.php?page=new" class="text-center">Crear cuenta</a></p>
                        </div>
                    </div>
                </div>
            </section>
            </center>
<?php
        break;
    default:
?>
<center>
<section class="form-signin">

    <div class="login-box">
        <div class="login-logo">
            <b>Iniciar Sesión</b>
        </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      
        
        <?php
            if($_GET["error"]==="0"){
        ?>
        <p>
            <div class="alert alert-danger">
                <strong>Error!</strong> <?=utf8_encode("Correo y/o clave incorrecto")?>
            </div>
        </p>
        <?php
            }else{
        ?>
        <p class="login-box-msg">Ingresar para iniciar sesión</p>
        <?php
            }
        ?>
        
      <form name="frmLogin" id="frmLogin" action="login.php?page=authorized" method="post">
        <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Correo" name="txtLogin" id="txtLogin" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Clave" name="txtClave" id="txtClave" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <p class="mb-1 text-justify">
        <a href="login.php?page=forgot-password">Olvidé mi contraseña</a>
      </p>
      <p class="mb-0 text-justify">
        <a href="profile.php?page=new" class="text-center">Crear cuenta</a>
      </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    <!-- /.login-card-body -->
  </div>
</div>

</section>
</center>
<?php
}
require_once 'side/footer.html';
?>