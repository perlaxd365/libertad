<?php
    header("access-control-allow-origin: *");
    $ruta=dirname(dirname(__FILE__));                   
    require_once($ruta."/funciones/conexion.php");	
    require_once($ruta."/global/clsSuggest.php");
    require_once($ruta."/global/clsBuscador.php");
    require_once($ruta."/funciones/session.php");

    $objSuggest  = new clsSuggest(); 
    $objBuscador = new clsBuscador();

    $input	=	strtolower($_GET["content"]);
    $limite	=	$_GET["limite"];
    $nombre	=	$_GET["nombre"];
    $campo2	=	$_GET["campo2"];
    $ident	=	$_GET["ident"];
    $id         =	$_GET["opcion"];
    
    $vId	=	isset($_GET['vId'])	? $_GET['vId']        : null;	
    $comp  	=       isset($_GET['comp'])    ? $_GET['accion']     : null;

    if(strlen($input)){
    switch($id){
        case 1:	$sql = $objSuggest->SqlMedico($input,$limite);                   break;
        case 2:	$sql = $objSuggest->SqlMedicoPaciente($input,$limite,$vId);      break;
    }


    $objBuscador->PanelBuscador($sql,$input,$id,$nombre,$ident,$campo2,$comp);
    }else{
    echo "<script language=\"javascript\">boxpanel('0');</script>";
    }
?>