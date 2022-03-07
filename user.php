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
<?php
require_once 'side/footer.html';
?>