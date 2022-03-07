<?php
require_once "ems/administrador/clases/clsCarta.php";
require_once "funciones/session.php";
require_once 'side/header.php';
require_once "funciones/conexion.php";
require_once "ems/commerce/clases/clsCliente.php";
require_once "ems/administrador/clases/clsRegion.php";
require_once "ems/administrador/clases/clsProvincia.php";
require_once "ems/administrador/clases/clsDistrito.php";
require_once "ems/commerce/clases/clsPedido.php";
require_once "ems/commerce/clases/clsPedido_c.php";

if ( $_GET["page"]=="edit" || $_GET["page"]=="pedido"){    
    if (!isset($_SESSION["sUser"])) {
        echo"<script> location='index.php';</script>";
    }    
}

$objCliente   = new clsCliente();
$objRegion    = new clsRegion();
$objProvincia = new clsProvincia();
$objDistrito  = new clsDistrito();
$objPedido    = new clsPedido();
$objPedido_c  = new clsPedido_c();
?>
<section class="breadcrumbs">
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2>¡Hola <?=$_SESSION["sUser"]["usrNombre"]?>!</h2>
        <ol>

            <li><a href="order.php?page=viewcesta">Cesta</a></li>
            <li>Mi perfil</li>
        </ol>
    </div>
</div>
</section>
<?php
switch ($_GET["page"]){
    case "crud":
      
        $ln_retorno = $objCliente->_procMant($_POST["txtAccion"],$_POST["txtId"],$_POST["cmbTipo"],$_POST["txtRazonSocial"],$_POST["txtNroDoc"],$_POST["txtDireccion"],$_POST["cmbDistrito"],$_POST["txtTelefono"],$_POST["txtCorreo"],$_POST["txtClave"]);
        $ln_arr = explode("...",$ln_retorno);
        
        $vRetorno = $ln_arr[0];
        $vMsgs    = $ln_arr[1];
        
        echo"<div class='section-title'><h3><span>".$vMsgs."</span></h3></div>";
        break;
}
?>
<?php
switch($_GET["page"])
{
    case "new";case "edit":
        if($_GET["page"]=="new"){  		
            
            $txtAccion  = 1;
            $txtId      = 0;
        }else{
            $txtAccion  = 2;
            $rs         = $objCliente->Listar(1,$_SESSION["sUser"]["usrId"]);
            $fila       = $rs->fetch_assoc();      
            $txtId           = $fila["codigo"];
            $cmbTipo         = $fila["tipo"];            
            $txtRazonSocial  = $fila["razonsocial"];
            $txtNroDoc       = $fila["dniruc"];
            $txtDireccion    = $fila["direccion"];
            $cmbDepartamento = $fila["idregion"];
            $cmbProvincia    = $fila["idprovincia"];
            $cmbDistrito     = $fila["iddistrito"];
            $txtTelefono     = $fila["telefono"];
            $txtCorreo       = $fila["email"];
        }
?>
<section class="inner-page">
    <div class="container-fluid">
        <div class="section-title">
          <h3><span>Mis Datos Personales</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form name="frmProfile" id="frmProfile" action="profile.php?page=crud" method="post">
                <div class="card card-primary">                    
                    <div class="card-body">                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tipo </label>
                                        <select class="form-control select2" name="cmbTipo" id="cmbTipo">
                                        <option>Seleccione...</option>
                                        <option value="N" <?php if ( $cmbTipo=="N" ) echo "selected";?>>Natural</option>
                                        <option value="J" <?php if ( $cmbTipo=="J" ) echo "selected";?>>Judírica</option>
                                        </select>
                                        <input type="hidden" name="txtAccion" id="txtAccion" value="<?=$txtAccion?>">
                                        <input type="hidden" name="txtId" id="txtId" value="<?=$txtId?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Apellidos y Nombres / Razón Social</label>
                                        <input type="text" class="form-control" name="txtRazonSocial" id="txtRazonSocial" autocomplete="off" value="<?=($_GET["page"]=='new') ? '' : $txtRazonSocial;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>N&deg; Identidad </label>
                                        <input type="text" class="form-control" name="txtNroDoc" id="txtNroDoc" autocomplete="off" value="<?=($_GET["page"]=='new') ? '' : $txtNroDoc;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" name="txtDireccion" id="txtDireccion" autocomplete="off" value="<?=($_GET["page"]=='new') ? '' : $txtDireccion;?>">
                                    </div>
                                </div>
                            </div>                  

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <?php
                                        $rs_rgo = $objRegion ->Listar(0, null);                                        
                                        ?>
                                        <select name="cmbDepartamento" id="cmbDepartamento" class="form-control select2" onChange="myajax.Select('ubigeo.php?opt=0&cmbDepartamento='+this.value, 'cmbProvincia');">                                            
                                            <option>Seleccione...</option>
                                            <?php
                                            while($row_rgo = $rs_rgo->fetch_assoc()){
                                                if ($row_rgo["idregion"] == $cmbDepartamento) {
                                                    $selected = "selected";
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option value="<?=$row_rgo["idregion"]?>" <?=$selected?>><?=$row_rgo["nombre"]?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Provincia</label>
                                    <?php
                                        $rs_prv = $objProvincia ->Listar(2, $cmbDepartamento);                                        
                                    ?>
                                    <select name="cmbProvincia" id="cmbProvincia"  class="form-control select2" onChange="myajax.Select('ubigeo.php?opt=1&cmbProvincia='+this.value, 'cmbDistrito');">
                                            <?php
                                            while($row_prv = $rs_prv->fetch_assoc()){
                                                if ($row_prv["idprovincia"] == $cmbProvincia) {
                                                    $selected = "selected";
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option value="<?=$row_prv["idprovincia"]?>" <?=$selected?>><?=$row_prv["nombre"]?></option>
                                            <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>                      

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Distrito</label>
                                        <?php
                                            $rs_dst = $objDistrito ->Listar(2, $cmbProvincia);                                        
                                        ?>
                                        <select class="form-control select2" name="cmbDistrito" id="cmbDistrito">
                                            <?php
                                            while($row_dst = $rs_dst->fetch_assoc()){
                                                if ($row_dst["iddistrito"] == $cmbDistrito) {
                                                    $selected = "selected";
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option value="<?=$row_dst["iddistrito"]?>" <?=$selected?>><?=$row_dst["nombre"]?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control" name="txtTelefono" id="txtTelefono" autocomplete="off" value="<?=($_GET["page"]=='new') ? '' : $txtTelefono;?>">
                                    </div>
                                </div>  
                            </div>
                                
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" name="txtCorreo" id="txtCorreo" autocomplete="off" required value="<?=($_GET["page"]=='new') ? '' : $txtCorreo;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Clave</label>
                                        <input type="password" class="form-control" name="txtClave" id="txtClave" autocomplete="off" required>
                                    </div>
                                </div>  
                            </div>                        
                    </div>                    
                </div>
                <div class="card-footer">
                    <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
                </div>
                </form>
            </div>
        </div>              
    </div>
</section>
<?php
    break;
    case "ver":
        $rs = $objPedido->Listar(1, $_GET["Id"]) ;
        $fila = $rs->fetch_assoc();
?>
<section class="inner-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="invoice p-3 mb-3">
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
                        <img src="resources/images/general/visa.png" alt="Visa">
                        <img src="resources/images/general/mastercard.png" alt="Mastercard">
                        <img src="resources/images/general/american-express.png" alt="American Express">
                        <img src="resources/images/general/paypal2.png" alt="Paypal">                    
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
                    <div class="row no-print">
                      <div class="col-12">
                        <button type="button" class="btn btn-success float-right"><i class="bi bi-credit-card-2-back"></i>Realizar Pago</button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="location.href='profile.php?page=pedido'"><i class="bi bi-arrow-left-short"></i>Regresar</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        break;
    case "pedido":
?>
<section class="inner-page">
    <div class="container-fluid">
        <div class="section-title">
          <h3><span>Mis Pedidos</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                          <th scope="col"></th>
                          <th scope="col">Comprado el</th>
                          <th scope="col">Forma de Pago</th>
                          <th scope="col">Tipo de Envío</th>
                          <th scope="col">Total</th>
                          <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rs = $objPedido->Listar(2, $_SESSION["sUser"]["usrId"]) ;
                    while($fila=$rs->fetch_assoc()){
                    ?>
                        <tr>
                            <td></td>
                            <td>&nbsp;<?=FechaFormato($fila["fecha_pedido"])?></td>
                            <td>&nbsp;<?=$fila["nomb_forma_pago"]?></td>
                            <td>&nbsp;<?=$fila["nomb_tipo_envio"]?></td>
                            <td>&nbsp;<?=  FormatNumber($fila["total_pedido"],2)?></td>
                            <td align="center">
                                <button type="button" class="btn-sm btn-default" onclick="location.href='profile.php?page=ver&Id=<?=$fila["cod_pedido"]?>'">Ver Pedido</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php
    break;    
}
?>
<?php
require_once 'side/footer.html';
?>