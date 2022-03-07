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
    $url    = "documento";    
    require_once $sep."funciones/parametro.php";
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-auto">
            <div class="col-sm-6"><h1>Consulta General</h1></div>          
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
                <div class="card-body p-0">
                    <table>
                        <tr>
                            <td>                               
                                <input id="TxtDesde" name="TxtDesde" type="text" class="form-control" value="<?=$TxtDesde?>" placeholder="Desde...">                                 
                            </td>
                            <td>
                                <a href="#" onclick="displayCalendar(document.forms[0].TxtDesde,'dd/mm/yyyy',this)">
                                        <img src="../resources/images/general/calendar.png"  border="0" align="absmiddle" /></a>
                            </td>
                            <td>-</td>   
                            <td>                               
                                <input id="TxtHasta" name="TxtHasta" type="text" class="form-control" value="<?=$TxtHasta?>" placeholder="Hasta..." >                                 
                            </td>
                            <td>
                                <a href="#" onclick="displayCalendar(document.forms[0].TxtHasta,'dd/mm/yyyy',this)">
                                        <img src="../resources/images/general/calendar.png"  border="0" align="absmiddle" /></a>
                            </td>
                            <td>
                           
                                <a href="#" onclick="Buscar(13,'<?=$modulo?>/<?=$url?>.php','fch');">
                                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-bars"></i> Buscar</button>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>                 
              </div>
            </div>
          </div>
        </div>
        <div>
        <?php		
            require_once $sep."funciones/mensaje.php";
        ?>
        </div>
        <div class="row">
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
<script>
$("#TxtDesde").on('click',function (e) {
    console.log('xx');
    
});    
</script>
    