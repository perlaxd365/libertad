<?php
    ob_start();
    $sep="../../../";
    require_once $sep."funciones/session.php";    
    if(!isset($_SESSION["sUser"])){ 
       exit();
    }
    require_once $sep."funciones/conexion.php";
    require_once "../../administrador/clases/clsRegion.php";
    require_once "../../administrador/clases/clsProvincia.php";
    require_once "../../administrador/clases/clsDistrito.php";
    require_once "../clases/clsPedido.php";
    require_once "../clases/clsPedido_c.php";    
    
    $objPedido   = new clsPedido();
    $objPedido_c  = new clsPedido_c();
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-auto">
            <div class="col-sm-6"><h1>Pedido</h1></div>          
        </div>
    </div>
</section>
<?php
switch($_GET["page"])
{
    case "purchase":
        $rs = $objPedido->Listar(1, $_GET["Id"]) ;
        $fila = $rs->fetch_assoc();
?>
<section class="content">       
    <div class="container-fluid">   
        <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title"> > Proceso de pago</h3></div>
                <div class="col-sm-6">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4>Pollos y Parrilladas,Libertad.</h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                              De:
                              <address>
                                <strong>Pollos y Parrilladas,Libertad.</strong><br>
                                Av. 28 de Julio 600<br>
                                Huacho, Lima<br>
                                Tel.: +1 232-3234<br>
                                Email: info@midominio.com
                              </address>
                            </div>                        
                            <div class="col-sm-4 invoice-col">
                              Para:
                              <address>
                                <strong><?=$fila["razonsocial"]?></strong><br>
                                <?=$fila["direntrega_pedido"]?><br>
                                Tel.: <?=$fila["telefono"]?><br>
                                Email: <?=$fila["email"]?>
                              </address>
                            </div>                        
                            <div class="col-sm-4 invoice-col">                                                 
                              <br><b>N° Identidad:</b> <?=$fila["dniruc"]?><br>
                              <b>Fecha:</b> <?=FechaFormato($fila["fecha_pedido"]);?><br>
                              <b>Pedido #<?=$fila["cod_pedido"]?></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                              <table class="table table-striped">
                                <thead>
                                <tr>
                                  <th>Item</th>
                                  <th>Cantidad</th>
                                  <th>Descripción</th>
                                  <th>Precio</th>
                                  <th>Importe</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                $rs = $objPedido_c->Listar(2, $fila["cod_pedido"]) ;
                                while($row = $rs->fetch_assoc()){
                                ?>
                                <tr>
                                  <td><?=$i?></td>
                                  <td><?=$row["cant_detalle_pedido"]?></td>
                                  <td><?=$row["prod_descripcion"]?></td>
                                  <td><?=FormatNumber($row["precio_detalle_pedido"],2)?></td>
                                  <td><?=FormatNumber($row["cant_detalle_pedido"]*$row["precio_detalle_pedido"],2)?></td>
                                </tr>
                                <?php
                                $i++;
                                }
                                ?>
                                </tbody>
                              </table>
                            </div>               
                        </div>             
                        <div class="row">                
                          <div class="col-6">
                            <p class="lead">Metodos de Pago:</p>
                            <img src="../resources/images/general/visa.png" alt="Visa">
                            <img src="../resources/images/general/mastercard.png" alt="Mastercard">
                            <img src="../resources/images/general/american-express.png" alt="American Express">
                            <img src="../resources/images/general/paypal2.png" alt="Paypal">                    
                          </div>

                          <div class="col-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tr>
                                  <th style="width:50%; text-align: right">Subtotal:</th>
                                  <td align="right"><?=FormatNumber($fila["subtotal_pedido"],2)?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%; text-align: right">Impuesto (18%):</th>
                                  <td align="right"><?=FormatNumber($fila["igv_pedido"],2)?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%; text-align: right">Total:</th>
                                  <td align="right">S/.<?=FormatNumber($fila["total_pedido"],2)?></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success float-right"><i class="bi bi-credit-card-2-back"></i>Realizar Pago</button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="myajax.Link('commerce/pedido.php?rand=<?=GeraHash(13)?>&pagina=<?=$_GET["pagina"];?>', 'Contenido');"><i class="bi bi-arrow-left-short"></i>Regresar</button>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</section>
<?php
    break;
}
?>