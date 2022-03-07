<?php
    $sep="../";
    require_once $sep."funciones/session.php";
    require_once $sep."funciones/conexion.php";
    require_once "app/clases/clsComprobante.php";  
    
    $objComprobante = new clsComprobante();
    
    $page   = isset($_GET['page'])   ? $_GET['page']   : null;

    switch($page){
        /***********************************************************/		   
        case "login":
            
            $rs = $objComprobante->Listar(0,$_POST["txtRuc"],$_POST["cmbTipo"],$_POST["txtSerie"],$_POST["txtNumero"],FormatoFecha($_POST["txtFecha"]),$_POST["txtImporte"],'0000-00-000','0000-00-000'); 

            if( $rs->num_rows > 0 ){
                while($fila = $rs->fetch_assoc()){			 				   
                      $_SESSION["sUser"]["Ruc"]     = $fila["cpe_rucemisor"];
                      $_SESSION["sUser"]["Id"]      = $fila["ruccliente"];
                      $_SESSION["sUser"]["Razon"]   = $fila["razoncliente"];
                      $_SESSION["sUser"]["Tipo"]    = $fila["cpe_tipodocumento"];
                      $_SESSION["sUser"]["Serie"]   = $fila["cpe_serie"];
                      $_SESSION["sUser"]["Num"]     = $fila["cpe_numero"];
                      $_SESSION["sUser"]["Clie"]    = $fila["ruccliente"];
                      $_SESSION["sUser"]["Fecha"]   = $fila["fechaemsion"];						  
                      $_SESSION["sUser"]["Importe"] = $fila["total"];

                      echo "<script>location='home.php'</script>";
                }							
            }else{
                echo "<script>location='index.php?estado=error'</script>";
                exit();
            }
            
            break;
        default:
?>

<!doctype html>
<html lang="spa">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta de comprobante electrónico</title>
    <link rel="icon" href="<?=$sep?>resources/images/general/libertad.ico" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="../resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,body {
          height: 100%;
        }

        body {
          display       : flex;
          padding-top   : 2px;
          //padding-bottom: 2px;
        }

        .form-signin {
          width     : 100%;
          max-width : 750px;
          padding   : 15px;
          margin    : auto;
        }
    </style>
    <script src="../resources/js/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $(document).ready(function(){
            $("#reloadCaptcha").click(function(){
		var captchaImage = $('#captcha').attr('src');	
		captchaImage = captchaImage.substring(0,captchaImage.lastIndexOf("?"));
		captchaImage = captchaImage+"?rand="+Math.random()*1000;
		$('#captcha').attr('src', captchaImage);
            });
    
        $( "#txtFecha" ).datepicker({
            dateFormat: 'dd/mm/yy'
        });
 
            
        });
        
    </script>
    </head>
    <body > 
        <main class="form-signin">
            <form action="index.php?page=login" method="post">
                <center><img class="mb-4" src="../resources/images/general/gallo.png" width="120" alt="" w></center>
                <h1 class="h3 mb-3 font-weight-normal text-center">Consulta de documento electrónico</h1>
                <p class="text-center">Estimado cliente; a través de esta consulta, Usted podrá verificar su Boleta o Factura Electrónica registradas y/o informadas a la SUNAT.</p>
            <div class="card-body">        
                <div class="form-group">
                    <label for="lblNumero" class="col-sm-6 form-label">RUC</label>
                    <input type="text" class="form-control" id="txtRuc" name="txtRuc" placeholder="RUC del emisor" required="required">                  
                </div>
                <div class="form-group">
                    <label for="lblTipo" class="col-sm-6 form-label">Tipo de comprobante</label>
                    <select class="form-select" id="cmbTipo" name="cmbTipo" required="required">
                        <option value="">Seleccione...</option>
                        <option value="01">Factura Electrónica</option>
                        <option value="02">Boleta de Venta Electrónica</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lblNumero" class="col-sm-6 form-label">Serie</label>
                    <input type="text" class="form-control" id="txtSerie" name="txtSerie" placeholder="Serie de documento" required="required">                  
                </div>
                <div class="form-group">
                    <label for="lblNumero" class="col-sm-6 form-label">Número</label>
                    <input type="text" class="form-control" id="txtNumero" name="txtNumero" placeholder="Número de documento" required="required">                  
                </div>
                <div class="form-group">
                
                  <label>Fecha:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control" id="txtFecha" name="txtFecha" placeholder="Fecha de emisión"/>
                    </div>
            
                </div>               
                <div class="form-group">
                    <label for="lblImporte" class="col-sm-6 form-label">Importe</label>
                    <input type="text" class="form-control" id="txtImporte" name="txtImporte" placeholder="Importe Total" required="required">                  
                </div>
                <div class="form-group">
                    <label class="col-sm-6 form-label"> 
                        <img style="border: 1px solid #D3D0D0" src="../funciones/captcha.php?rand=<?php echo rand(); ?>" id='captcha'>       
                        <a href="javascript:void(0)" id="reloadCaptcha"><span class="bi bi-arrow-counterclockwise" aria-hidden="true"></span></a>Recargar
                    </label> 
                    <input type="text" name="securityCode" id="securityCode" class="form-control" placeholder="Código de seguridad">
                </div>
                
            </div>
            <div class="form-group">
                &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit">Buscar</button>
                <button class="btn btn-primary" type="reset">Cancelar</button>
            </div>
            </form>
        </main>  
    </body>
</html>
<?php
    }
?>