<?php
    $ItemsPag    = 25;
    $btn         = "";
    $action 	 = isset($_GET['action']) 		? $_GET['action'] 		: null;		
    $TxtCampoBus = isset($_GET['TxtCampoBus'])          ? $_GET['TxtCampoBus']          : null;
    $TipoBus 	 = isset($_GET['TipoBus']) 		? $_GET['TipoBus'] 		: null;
    $pagina 	 = isset($_GET['pagina']) 		? $_GET['pagina'] 		: 1;
    $success     = isset($_GET['success'])    		? $_GET['success'] 		: null;
    $warning 	 = isset($_GET['warning']) 		? $_GET['warning'] 		: null;
?>