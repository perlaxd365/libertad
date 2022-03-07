<?php
    $sep="../";
    require_once $sep."funciones/session.php";
    require_once $sep."funciones/conexion.php";
    require_once "administrador/clases/clsUsuario.php";
    
    $page   = isset($_GET['page'])   ? $_GET['page']   : null;
    $error  = isset($_GET['error'])  ? $_GET['error']  : null;
    
    $objUsuario = new clsUsuario();
    
    switch($page){
        /***********************************************************/		   
        case "login":
            
            $rs = $objUsuario->Login(0,$_POST["txtLogin"],$_POST["txtClave"]); 
            
            $ln_arr = explode("...",$rs);
            $msg = $ln_arr[2];
            if( $ln_arr[1] > 0 ){						  
                $_SESSION["sUser"]["usr_login"] = $ln_arr[0];
                echo "<script>location='home.php'</script>";							
            }else{
                echo "<script>location='index.php?error=0'</script>";
                exit();
            }    
            break;
        case "logout":
            echo"<script> location='index.php';</script>";
            exit();
            break;
        default:
?>
<!doctype html>
<html lang="spa">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesión · Pollería</title>
    <link href="../resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size           : 1.125rem;
        text-anchor         : middle;
        -webkit-user-select : none;
        -moz-user-select    : none;
        user-select         : none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size         : 3.5rem;
        }
      }
      
      html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

      
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <main class="form-signin" id="frmLogin" name="frmLogin" action="index.php?page=login" method="post">
            <form id="frmLogin" name="frmLogin" action="index.php?page=login" method="post">
                <img class="mb-4" src="../resources/images/general/gallo.png" alt="" w>
                <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
                <p>
                <?php
                    if($_GET["error"]==="0"){
                ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?=utf8_encode("Usuario o clave es incorrecto")?>
                    </div>
                <?php
                    }
                ?>
                </p>
                <div class="form-floating">
                    <input type="text" class="form-control" id="txtLogin" name="txtLogin" placeholder="Usuario" required="required">
                    <label for="floatingInput">Usuario</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Password" required="required">
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
                <p class="mt-5 mb-3 text-muted"><?=date("Y")?>&copy; Pollos y Parrilladas Libertad</p>
            </form>
        </main>  
    </body>
</html>
<?php
    }
?>