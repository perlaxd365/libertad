<?php
    $sep="../";
    require_once $sep."funciones/session.php";
    if(!isset($_SESSION["sUser"])){ 
       echo "<script>location='index.php?page=logout'</script>";
    }
    require_once $sep."funciones/conexion.php";
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.5)" />
<title>Pollos y Parrillas Libertad < Home</title>
<link rel="stylesheet" type="text/css" href="<?=$sep?>resources/js/jscal/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css"></link>
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
<script src="<?=$sep?>resources/js/jscal/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script>
<script src="<?=$sep?>resources/js/isiAJAX/isiAJAX.js" type="text/javascript"></script> 
<script src="<?=$sep?>resources/js/isiAJAX/isiXML.js" type="text/javascript"></script> 
<script src="<?=$sep?>resources/js/adminlte.min.js" type="text/javascript"></script>

<script type="text/javascript">
    function cargar_form() {
            myRand = <?=date("dmYHms")?>;
            myajax.Link('app/comprobante.php?rand=' + myRand, 'Contenido');
    }
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed" onload="myajax = new isiAJAX('Contenido', 'cargador'); cargar_form();">    
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">        
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li> 
            <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"><?=$_SESSION["sUser"]["Id"]?> : <?=$_SESSION["sUser"]["Razon"]?></a>
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
        <img src="../resources/images/general/sign.jpg" alt="Diromed Diagnostic" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Pollería Libertad</span>
        </a>
        
        <!-- Usuario -->
        <div class="sidebar">      
            <!--Menu -->
            <nav class="mt-2">        
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Consulta<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" onClick="myajax.Link('app/comprobante.php?rand=<?=GeraHash(13);?>', 'Contenido'); " class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Específica</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" onClick="myajax.Link('app/documento.php?rand=<?=GeraHash(13);?>', 'Contenido'); " class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General</p>
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
        <?=date("Y")?> &copy; Pollos y Parrillas Libertad.<div class="float-right d-none d-sm-inline-block"><b>Versión </b>1.0</div>
    </footer>
</div>     
</body>
</html>