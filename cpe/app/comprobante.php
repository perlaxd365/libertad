<?php
    #ob_start();
    $sep="../../";
    require_once $sep."funciones/session.php";
    if(!isset($_SESSION["sUser"])){ 
        exit();
    }
    require_once $sep."funciones/conexion.php";
    require_once "clases/clsComprobante.php";

    $objComprobante = new clsComprobante();
    
    $modulo = "app";
    $url    = "comprobante";    
    require_once $sep."funciones/parametro.php";
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-auto">
            <div class="col-sm-6"><h1>Consulta Específica</h1></div>          
        </div>
    </div>
</section>
<form name="<?=$url?>" style="margin:0; padding:0" onsubmit="return false">
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">          
        <div class="row">
            <div class="col-md-12">
            <div class="card card-primary card-outline"> 
                <div class="card-header">
                    
                </div>
            </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?php 
                            $btn    = "0";
                            require_once  $sep."funciones/botones.php"; 
                        ?>    
                    </div>

                    <div id="contenido_grid">
                        <?php 
                            require_once  "views/grv_".$url.".php"; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
 <?php
    require_once  $sep."funciones/nav.php";
?>
</form>
<?php
    ob_end_flush();
?>