<?php
    #ob_start();
    $sep="../../";
    require_once $sep."/funciones/session.php";
    if(!isset($_SESSION["sUser"])){ 
        exit();
    }
    require_once $sep."funciones/conexion.php";
    require_once "clases/clsPedido.php";
    require_once "clases/clsPedido_c.php";

    $objPedido = new clsPedido();
    $objPedido_c = new clsPedido_c();
    
    $modulo = "commerce";
    $url    = "pedido";
    require_once $sep."funciones/parametro.php";
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-auto">
            <div class="col-sm-6"><h1>Pedido</h1></div>          
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
                                <select id="TipoBus" name="TipoBus" class="form-control select2">
                                    <option value="0" <?php if ( $TipoBus=="0" ) echo "selected";?>>Seleccione...</option>
                                    <option value="4" <?php if ( $TipoBus=="4" ) echo "selected";?>>Fecha</option>
                                    <option value="5" <?php if ( $TipoBus=="5" ) echo "selected";?>>N&deg; Identidad</option>
                                    <option value="3" <?php if ( $TipoBus=="3" ) echo "selected";?>>Apellidos y Nombres/Raz&oacute;n social</option>
                                </select>                                
                            </td>
                            <td> <input id="TxtCampoBus" name="TxtCampoBus" type="text" class="form-control" value="<?=$TxtCampoBus?>" ></td>
                            <td>
                                <a href="#" onclick="Buscar(13,'<?=$modulo?>/<?=$url?>.php','busq');">
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
                            $btn = 0;
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