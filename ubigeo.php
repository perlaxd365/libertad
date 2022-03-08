<?php

    header('Content-Type: text/xml');

    echo '<?xml version="1.0" encoding="iso-8859-1"?>';

    require_once "funciones/conexion.php";

    require_once "ems/administrador/clases/clsProvincia.php";

    require_once "ems/administrador/clases/clsDistrito.php";



    $objProvincia = new clsProvincia();

    $objDistrito  = new clsDistrito();



    switch($_GET["opt"])

    {

        case 0:	 

            $rs_prv = $objProvincia->Listar('2',$_GET['cmbDepartamento']); 

?>

            <select>

                <option value="">Seleccione...</option>

                <?php

                    while ( $row_prv = $rs_prv -> fetch_assoc()){

                ?>                        

                <option value="<?=$row_prv["idprovincia"]?>"><?=$row_prv["nombre"]?></option>

                <?php

                    }

                ?>

            </select>

<?php

        break;

        case 1:

            $rs_dst = $objDistrito->Listar('2',$_GET['cmbProvincia']);

?>

            <select>

                <option value="">Seleccione...</option>

                <?php

                    while ( $row_dst = $rs_dst -> fetch_assoc()){

                ?>                        

                <option value="<?=$row_dst["iddistrito"]?>"><?=$row_dst["nombre"]?></option>

                <?php

                    }

                ?>

            </select>

<?php

        break;

?>

<?php

    }

?>

        