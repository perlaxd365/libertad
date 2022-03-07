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
    require_once "../clases/clsCliente.php";
    
    $objCliente   = new clsCliente();
    $objRegion    = new clsRegion();
    $objProvincia = new clsProvincia();
    $objDistrito  = new clsDistrito();
    
    $accion   = isset($_GET['accion'])   ? $_GET['accion']   : null;
    
    $cObligatorio = ["txtAccion","txtId","cmbTipo","txtRazonSocial","txtNroDoc","txtDireccion","cmbDepartamento","cmbProvincia","cmbDistrito","txtTelefono"];
    $nArr=count($cObligatorio);
    
    switch($accion)
    {
        case "crud":            
             
            $ln_retorno = $objCliente->_procMant($_POST["txtAccion"],$_POST["txtId"],$_POST["cmbTipo"],$_POST["txtRazonSocial"],$_POST["txtNroDoc"],$_POST["txtDireccion"],$_POST["cmbDistrito"],$_POST["txtTelefono"],null,null);

            $ln_arr = explode("...",$ln_retorno);
            
            $vRetorno = $ln_arr[0];
            $vMsgs    = $ln_arr[1];
            
            $vMsg = ($vRetorno > 0) ? 'success='.$vMsgs :  'warning='.$vMsgs;
            header("Location: ../cliente.php?rand=".GeraHash(13)."&pagina=1&$vMsg"); 
            exit;
        break;
            
    }
    
    switch($_GET["page"])
    {
        case "new";case "edit":

            if($_GET["page"]=="new"){  		
                $titulo     = "Nuevo";
                $txtAccion  = 1;
                $txtId      = 0;

            }else{
                $titulo    = "Modificar";
                $rs        = $objCliente->Listar(1,$_GET["id"]);
                $fila      = $rs->fetch_assoc();
                $txtAccion = 3;
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
                $txtClave        = $fila["clave"];
            }
    
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-auto">
            <div class="col-sm-6"><h1>Cliente</h1></div>          
        </div>
    </div>
</section>
<section class="content">       
    <div class="container-fluid">          
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header"><h3 class="card-title"> > <?=$titulo?></h3></div>
                </div>
                <form id="frmCliente" name="frmCliente" method="post" onsubmit="return false;" action="commerce/forms/frm_cliente.php?accion=crud">
                <div class="card card-primary card-outline card-outline-tabs">    
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">General</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card-body">
                                    <div class="row">                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lblTipo">Tipo:</label>
                                                <select tabindex="1" class="form-control select2" style="width: 100%;" name="cmbTipo" id="cmbTipo" title="Tipo" onchange="cmbTipoPersona();"
                                                    <?php if ( $_GET["page"] == "edit" ) echo "disabled ";?>>
                                                    <option value="--Seleccione--">Seleccione...</option>
                                                    <option value="N" <?php if ( $cmbTipo=="N" ) echo "selected";?>>NATURAL</option>
                                                    <option value="J" <?php if ( $cmbTipo=="J" ) echo "selected";?>>JURIDICA</option>
                                                </select>
                                                <input type="hidden" value="<?=$txtId?>" name="txtId" id="txtId" />
                                                <input type="hidden" value="<?=$txtAccion?>" name="txtAccion" id="txtAccion" />
                                            </div>
                                            <div class="form-group">
                                                <label for="lblNroDoc">N° Documento:</label>
                                                <input tabindex="3" type="text" class="form-control" id="txtNroDoc" name="txtNroDoc" maxlength="12" <?php if ( $_GET["page"] == "edit" ) echo "disabled ";?> 
                                                       placeholder="N° Documento" value="<?=($_GET["page"]=='new') ? '' : $txtNroDoc;?>" title="N° Documento">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lblPaterno">Apellidos y Nombres / Razón Social:</label>                                            
                                                <input tabindex="2" type="text" class="form-control" id="txtRazonSocial" name="txtRazonSocial" <?php if ( $_GET["page"] == "edit" ) echo "disabled ";?>
                                                        placeholder="Apellidos y Nombres / Razón Social" value="<?=($_GET["page"]=='new') ? '' : $txtRazonSocial;?>" title="Apellidos y Nombres / Razón Social">                                      
                                            </div>
                                            <div class="form-group">
                                                <label for="lblPaterno">Direcci&oacute;n:</label>                                            
                                                <input tabindex="4" type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección" 
                                                       value="<?=($_GET["page"]=='new') ? '' : $txtDireccion;?>" title="Dirección">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departamento</label>
                                                <?php
                                                $rs_rgo = $objRegion ->Listar(0, null);                                        
                                                ?>
                                                <select name="cmbDepartamento" id="cmbDepartamento" class="form-control select2" onChange="myajax.Select('../ubigeo.php?opt=0&cmbDepartamento='+this.value, 'cmbProvincia');">                                            
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
                                            <div class="form-group">
                                                <label>Distrito</label>
                                                <?php
                                                    $rs_dst = $objDistrito ->Listar(2, $cmbProvincia);                                        
                                                ?>
                                                <select class="form-control select2" name="cmbDistrito" id="cmbDistrito">
                                                    <option>Seleccione...</option>
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
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Provincia</label>
                                                <?php
                                                    $rs_prv = $objProvincia ->Listar(2, $cmbDepartamento);                                        
                                                ?>
                                                <select name="cmbProvincia" id="cmbProvincia"  class="form-control select2" onChange="myajax.Select('../ubigeo.php?opt=1&cmbProvincia='+this.value, 'cmbDistrito');">
                                                    <option>Seleccione...</option>
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
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="txtTelefono" id="txtTelefono" autocomplete="off" value="<?=($_GET["page"]=='new') ? '' : $txtTelefono;?>">
                                            </div>                                           
                                        </div>
                                        
                                        <div class="col-md-6">                                            
                                            <div class="form-group">
                                                <label>Correo</label>
                                                <input type="email" class="form-control" name="txtCorreo" id="txtCorreo" autocomplete="off" required value="<?=($_GET["page"]=='new') ? '' : $txtCorreo;?>" <?php if ( $_GET["page"] == "edit" ) echo "disabled ";?>>
                                            </div>
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">                                           
                                            <div class="form-group">
                                                <label>Clave</label>
                                                <input type="password" class="form-control" name="txtClave" id="txtClave" autocomplete="off" required value="<?=($_GET["page"]=='new') ? '' : $txtClave;?>" <?php if ( $_GET["page"] == "edit" ) echo "disabled ";?>>
                                            </div>
                                            <div class="form-group">                                                
                                            </div>    
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>                
                    <div class="card-footer">                        
                        <button type="button" onclick="doPost('frmCliente', '<?php for ($i=0; $i<$nArr; $i++){ echo $cObligatorio[$i]."-"; } ?>');" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" onclick="myajax.Link('commerce/cliente.php?rand=<?=GeraHash(13)?>&pagina=<?=$_GET["pagina"];?>', 'Contenido');" class="btn btn-primary btn-sm">Regresar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
    }
?>