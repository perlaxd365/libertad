<?php
$sep="../";
require_once $sep."funciones/session.php";
require_once $sep."funciones/conexion.php";
if(!isset($_SESSION["sUser"])){ 
   echo"<script> location='index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.5)" />
<title>Pollos y Parrilladas Libertad < Home</title>
<link rel="icon" href="<?=$sep?>resources/images/general/libertad.ico" sizes="16x16" type="image/png">
<link rel="stylesheet" type="text/css" href="<?=$sep?>resources/css/estilo.css">    
<link rel="stylesheet" type="text/css" href="<?=$sep?>resources/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" type="text/css" href="<?=$sep?>resources/plugins/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?=$sep?>resources/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?=$sep?>resources/plugins/toastr/toastr.min.css">
<link rel="stylesheet" type="text/css" href="<?=$sep?>resources/css/adminlte.css">

<script src="<?=$sep?>resources/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?=$sep?>resources/plugins/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?=$sep?>resources/plugins/select2/js/select2.full.min.js"></script>
<script src="<?=$sep?>resources/js/zxml.js" type="text/javascript"></script>
<script src="<?=$sep?>resources/js/ajax.js" type="text/javascript"></script>
<script src="<?=$sep?>resources/js/javascript.js" type="text/javascript"></script>
<script src="<?=$sep?>resources/js/suggest.js" type="text/javascript"></script>
<script src="<?=$sep?>resources/js/isiAJAX/isiAJAX.js" type="text/javascript"></script> 
<script src="<?=$sep?>resources/js/isiAJAX/isiXML.js" type="text/javascript"></script> 
<script src="<?=$sep?>resources/js/adminlte.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function cargar_form() {
            myRand = <?=date("dmYHms")?>;
            myajax.Link('commerce/pedido.php?rand=' + myRand, 'Contenido');
    }
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed" onload="myajax = new isiAJAX('Contenido', 'cargador');cargar_form();">    
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">        
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="home.php" class="nav-link">Inicio</a>
            </li>  
            <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contacto</a>
           </li>
        </ul>  
        <div id="cargador" class="spinner-border spinner-border-sm"></div>
        <ul class="navbar-nav ml-auto">   
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=logout">
                  <i class="fas fa-book"></i>&nbsp;Cerrar conexión
              </a>
            </li>
        </ul>
       
    </nav>
    
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        
        <!--Logo -->
        <a href="#" class="brand-link">
        <img src="../resources/images/general/sign.png" alt="Pollos y Parrilladas Libertad" class="brand-image img-circle elevation-3" > 
        <span class="brand-text font-weight-light">Pollos Libertad</span>
        </a>
        
        <!-- Usuario -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="../resources/images/general/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?=$_SESSION["sUser"]["usr_login"]?></a>
            </div>
          </div>        
            <!--Menu -->
            <nav class="mt-2">        
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Web<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" onClick="myajax.Link('administrador/biblioteca.php?rand=<?=GeraHash(13);?>', 'Contenido'); " class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Banner</p>
                                </a>
                            </li>
                        </ul>
                        
                    </li>
                    <li class="nav-item">    
                         <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Ecommerce<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" onClick="myajax.Link('commerce/cliente.php?rand=<?=GeraHash(13);?>', 'Contenido'); " class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Cliente</p>
                                </a>
                               
                                <a href="#" onClick="myajax.Link('commerce/pedido.php?rand=<?=GeraHash(13);?>', 'Contenido'); " class="nav-link">
                                    <i class="nav-icon fas fa-columns"></i>
                                    <p>Pedido</p>
                                </a>
                            </li>
                        </ul>
                    </li>    
                </ul>
            </nav>
          
        </div>
        
    </aside>  
    
    <!--/.Contenido -->
    <div class="content-wrapper">
        
        <div id="Contenido">

        </div>    
      
    </div>
    <!--/.Contenido -->
    
    
    <!-- /.Pie de página -->
    <footer class="main-footer">
        <?=date("Y")?>&copy; Pollos y Parrilladas Libertad<div class="float-right d-none d-sm-inline-block"><b>Versión </b>1.0</div>
    </footer>
</div>     
</body>
</html>