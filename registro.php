<?php

require_once "ems/administrador/clases/clsCarta.php";

require_once "funciones/session.php";

require_once 'side/header.php';

require_once "funciones/conexion.php";

require_once "ems/logistica/clases/clsProducto.php";

require_once "ems/administrador/clases/clsFormaPago.php";

require_once "ems/administrador/clases/clsTipoEnvio.php";

require_once "ems/commerce/clases/clsPedido.php";

require_once "ems/commerce/clases/clsPedido_c.php";



if (!isset($_SESSION["sUser"])) {

    echo"<script> location='index.php';</script>";

}



if (!isset($_SESSION["cCarta"])) {

    $_SESSION["cCarta"] = new clsCarta;

}



$objFormaPago = new clsFormaPago();

$objTipoEnvio = new clsTipoEnvio();

$objPedido    = new clsPedido();

$objPedido_c  = new clsPedido_c();

?>

<section class="breadcrumbs">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center">



            <h2>¡Hola <?=$_SESSION["sUser"]["usrNombre"]?>!</h2>

            <ol>

                

                <li><a href="order.php?page=viewcesta">Cesta</a></li>

                <li>Compra</li>

            </ol>

        </div>

    </div>

</section>  

<?php

switch($_GET["page"])

{

    case "order":

        

        if($_SESSION['cCarta']->num_items<>0) {

            $Items=$_SESSION['cCarta']->Get_Items();

?>          

    <div class="section-title">

        <h3><span>Confirmación de Datos</span></h3>         

    </div>

        <form name="frmPurchase" method="post" action="registro.php?page=purchase">

            <section id="portfolio-details" class="portfolio-details">

                <div class="container">

                    <div class="row gy-4">

                        <div class="col-lg-8">

                            <table class="table table-sm">

                                <thead>

                                    <tr>

                                      <th scope="col"></th>

                                      <th scope="col">Descripción</th>

                                      <th scope="col">Cantidad</th>

                                      <th scope="col">Precio</th>

                                      <th scope="col">Importe</th>

                                    </tr>

                                </thead>

                                <tbody>

                                <?php

                                $subtotal=0;

                                foreach($Items as $k => $valor){

                                ?>

                                    <tr>

                                        <td></td>

                                        <td>&nbsp;<?=$valor["nombre"]?></td>

                                        <td><?=$valor["cant"]?></td>

                                        <td>S/. <?=$valor["precio"]?></td>					

                                        <td>S/. <?=sprintf("%.2f",$valor["cant"]*$valor["precio"])?></td>				

                                    </tr>

                                <?php

                                    $subtotal+=$valor["cant"]*$valor["precio"];

                                }

                                $subtotal=sprintf("%.2f",$subtotal); 

                                ?>

                                </tbody>

                            </table>    

                            

                            <table class="table table-sm">

                                <tr>

                                    <td style="width: 180px">

                                            <b>&nbsp;»&nbsp;Dirección de Entrega</b>

                                    </td>

                                    <td>

                                        <input class="form-control" type='text' name="txtDireccionEnvio" value='' required>

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <b>&nbsp;»&nbsp;Forma de Pago</b>

                                    </td>

                                    <td>

                                        <?php

                                        $rs = $objFormaPago ->Listar(0, null);                                        

                                        ?>

                                        <select name="cmbFormaPago" class="form-control select2" required>                                            

                                            <?php

                                            while($row = $rs->fetch_assoc()){

                                            ?>

                                            <option value="<?=$row["cod_forma_pago"]?>"><?=$row["nomb_forma_pago"]?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <b>&nbsp;»&nbsp;Tipo de Envío</b>

                                    </td>

                                    <td>

                                        <?php

                                        $rs = $objTipoEnvio ->Listar(0, null);                                        

                                        ?>

                                        <select name="cmbTipoEnvio" class="form-control select2" required>                                            

                                            <?php

                                            while($row = $rs->fetch_assoc()){

                                            ?>

                                            <option value="<?=$row["cod_tipo_envio"]?>"><?=$row["nomb_tipo_envio"]?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                    </td>

                                </tr>

                            </table>

                            

                        </div>

                        <div class="col-lg-4">

                            <div class="portfolio-info">

                                <h3 class="text-center">Resumen de pedido</h3>

                                <ul>

                                    <li><strong>Subtotal</strong> : S/. <?=$subtotal?></li>

                                    <li><strong>Envío</strong> : Gratis</li>

                                    <li><strong>Total</strong> : S/. <?=$subtotal?><input type="hidden" name="txtSubTotal" value="<?=$subtotal?>"></li>

                                </ul> 

                                <button class="w-100 btn-sm btn-primary" type="submit" name="cmdProcesar" id="cmdProcesar">Procesar Pedido</button>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </form>

 <?php                                      

            //$_SESSION['cCarta']->Put_strCesta($strCesta);

        }

        

        break;

    case "purchase":

        

        $ln_retorno = $objPedido->_procMant(1,0,$_SESSION["sUser"]["usrId"],$_POST["cmbTipoEnvio"],$_POST["cmbFormaPago"],date("Y-m-d"),$_POST["txtSubTotal"],$_POST["txtDireccionEnvio"]);

        

        $ln_arr = explode("...",$ln_retorno);

        

        if($_SESSION['cCarta']->num_items<>0) {

            $Items=$_SESSION['cCarta']->Get_Items();

            foreach($Items as $k => $valor)

            {

                $objPedido_c->_procMant(1,$ln_arr[0],$k,$valor["precio"],$valor["cant"]);



            }

        }

?>



    <div class="section-title">

      <h3><span>Gracias por su Compra...! </span></h3>

    </div>

		<table cellspacing=0 cellspadding=0 border=0 width='550' style='border:solid 1px $color' align="center">

		<tr>

	  		<td class='texto'>

	 		 <br><b><center>INSTRUCCIONES DE PAGO</center></b><br><br> 

             Casi todas las empresas de transferencia de dinero tiene dos formas de realizar el pago:<br><br>

			 <b>1.&nbsp;Pago por Internet</b><br> 

                <ul>

				<li>Seleccione la opción Transferencia de dinero y siga las instrucciones que se le ofrecen en pantalla.</li> 

                <li>Usted puede pagar la transferencia de dinero con Tarjeta de crédito .</li>

                <li>Le cobrará un monto por sus servicios .</li>

                <li>Introduzca el monto total a transferir en dólares americanos.</li>

				</ul><br>

			<b>2.&nbsp;Visite la agencia de la empresa de envió de dinero más cercana a su domicilio</b><br>

                 <ul>

				     <li>Rellene el formulario Enviar Dinero. Pregunte al funcionario ante cualquier duda que tenga.</li> 

                     <li>Debe mostrar una identificación válida y vigente.</li>

                     <li>Puede realizar el pago al contado (cash) o con tarjeta de crédito (disponible sólo en algunas agencias).</li>

                     <li>Le cobrará un monto por sus servicios.</li>

                     <li>Escriba el monto total a transferir en dólares americanos.</li>

				 </ul><br>

			<b>Usando este método, debe incluir la siguiente información del destinatario de su transferencia:</b> 

			<ul>

			   <li>Enviar un mail a <a class=link href=mailto:ventas@mmidominio.com>ventas@mmidominio.com</a> para recibir informacion con datos de la transferencia.</li>

               <li>Lima - Perú</li>               

			</ul><br>

			<b>Una vez concluida la transferencia, por favor enviar un e-mail a: <a class='link' href=mailto:ventas@mmidominio.com> ventas@mmidominio.com</a> indicando su nombre completo, número de pedido, empresa de transferencia y número de transferencia.</b><br><br>

</td>

					</tr>

				</table>

<?php

        

        $_SESSION['cCarta']->Remove_Cart();

        break;

    

    

}





require_once 'side/footer.php';