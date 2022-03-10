<?php

require_once "ems/administrador/clases/clsCarta.php";

require_once "funciones/session.php";

require_once 'side/header.php';

require_once "funciones/conexion.php";

require_once "ems/logistica/clases/clsProducto.php";



if (!isset($_SESSION["cCarta"])) {

    $_SESSION["cCarta"] = new clsCarta;

}



$objProducto = new clsProducto();

?>

    <section class="breadcrumbs">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center">

            <?php

            if(!isset($_SESSION['sUser'])){

            ?>

            <h2>Cesta</h2>

            <?php

            }else{

            ?>

            <h2>¡Hola <?=$_SESSION["sUser"]["usrNombre"]?>!</h2>

            <?php

            }

            ?>

            <ol>

                

                <li><a href="index.php">Inicio</a></li>

                <li>Cesta</li>

            </ol>

        </div>

    </div>

    </section>

<?php

switch ($_GET["page"]){

    

    case "updatecesta":

        if($_SESSION['cCarta']->num_items<>0){

            $Items=&$_SESSION['cCarta']->Get_Items();

            $Items_tmp=$Items;

            $i=0;

            foreach($Items_tmp as $k => $v){

                $txtCant=$_POST["txtCant$i"];				

                if ($txtCant < 1) {

                    $_SESSION['cCarta']->Remove_Item($k);

                } else {

                    $Items[$k]["cant"] = $txtCant;

                }

                $i++;

            }

        }

        $_GET['page']='viewcesta';

        break;

    

    case "removecesta":

        $_SESSION['cCarta']->Remove_Cart(); 

        echo "<script>parent.location='index.php';</script>";		

        break;

    

    case "removeitem":

        $_SESSION['cCarta']->Remove_Item($_GET['PathId']);

        $_GET["page"]='viewcesta';

        break;

}

?>

<?php

switch($_GET["page"])

{

    

    case "viewcesta":

?>

    <form name="frmCesta" action="<?=$_SERVER[PHP_SELF]?>?page=updatecesta" method="post">

    <section id="portfolio-details" class="portfolio-details">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <table class="table table-sm table-hover">

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

                        $i=0; $subtotal=0;

                        if($_SESSION["cCarta"]->num_items>0){

                            $Items=$_SESSION["cCarta"]->Get_Items();

                            if(!empty($Items)){

                                foreach($Items as $k => $valor){

                        ?>					

                            <tr>

                                <td>

                                    <a href="<?=$_SERVER[PHP_SELF]?>?page=removeitem&PathId=<?=$k?>"><img src="resources/images/general/i_deletecell.png" border="0"></a>

                                </td>

                                <td>&nbsp;<?=$valor["nombre"]?></td>

                                <td><input style="text-align:center; width: 120px" type="text" name="txtCant<?=$i++?>" value="<?=$valor["cant"]?>" class="form-control"></td>

                                <td>S/. <?=$valor["precio"]?></td>					

                                <td>S/. <?=sprintf("%.2f",$valor["cant"]*$valor["precio"])?></td>				

                            </tr>

                        <?php

                                $subtotal+=$valor["cant"]*$valor["precio"];

                                }

                            }

                        }

                        $subtotal=sprintf("%.2f",$subtotal); 

                        ?>

                        </tbody>

                    </table>

                    <?php

                    if($_SESSION['cCarta']->num_items<>0){

                    ?>

                    <table class="table">

                        <tr>

                            <td></td>

                            <td>

                                <button class="w-100 btn-sm btn-lg btn-primary" type="button" name="cmdRemoveCesta" id="cmdRemoveCesta" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?page=removecesta'">Vaciar Cesta</button>

                            </td>

                            <td>

                                <button class="w-100 btn-sm btn-lg btn-primary" type="button" name="cmdUpdateCesta" id="cmdUpdateCesta" href='#' onclick='frmCesta.submit()'>Actualizar Cesta</button>

                            </td>				

                            <td>                        

                                <button class="w-100 btn-sm btn-lg btn-primary" type="button" name="cmdSeguirCompra" id="cmdSeguirCompra" onclick="location.href='index.php'">Seguir comprando</button>

                            </td> 

                        </tr>

                    </table>

                    <?php		

                    }	

                    ?>

                </div>

                <div class="col-lg-4">

                    <div class="portfolio-info"  style="border-radius: 20px;">

                        <h3 class="text-center">Resumen de pedido</h3>

                        <ul>

                            <li><strong>Subtotal</strong> : S/. <?=$subtotal?></li>

                            <li><strong>Envío</strong> : Gratis</li>

                            <li><strong>Total</strong> : S/. <?=$subtotal?></li>

                        </ul>

                        <button class="w-100 btn-sm btn-primary" type="button" name="cmdProcesar" id="cmdProcesar" <?php if(!isset($_SESSION['sUser'])){ ?> onclick="location.href='login.php'" <?php }else{ ?> onclick="location.href='registro.php?page=order'" <?php } ?>>Procesar Pedido</button>

                    </div>

                </div>

            </div>

        </div>

    </section> 

    </form>

<?php

}



?>

<?php

require_once 'side/footer.php';

?>