<?php
$action = isset($_GET['action']) 	? $_GET['action'] 		: null;	
$page   = isset($_GET['page']) 		? $_GET['page'] 		: null;	

switch($action){
	
    case "search":

         $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
         $rs=$objComprobante->Listar(1,$_SESSION["sUser"]["Ruc"],$_SESSION["sUser"]["Clie"],null,null,'0000-00-00','0',
                                     FormatoFecha($_GET["TxtDesde"]),FormatoFecha($_GET["TxtHasta"]));		
         break;
    case "dwl":
        
        $f = "resources/documento/".$_GET["path"];
       /* header("Content-type: application/octet-stream"); 
        header("Content-Disposition: attachment; filename=\"$f\"\n"); */        
        /*$fp=fopen("$f", "r"); 
        fpassthru($fp); */
        $fileName = ($_GET['path']);
        $filePath = '../../resources/documento/'.$fileName;

        /*header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");*/
        
        // Read the file
       // readfile($filePath);
        //exit;
                header("Content-type: text/xml");
	        header("Content-length: ".filesize($fileName));
	        header("Content-Disposition: attachment; filename=$fileName");
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");
	        fread($fichero_texto, filesize($filePath));
                exit;
        

	
}

switch($page)
{		
    default:

        if($action!="search"){
           $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
           $rs=$objComprobante->Listar(1,$_SESSION["sUser"]["Ruc"],$_SESSION["sUser"]["Clie"],null,null,'0000-00-00','0',$_SESSION["sUser"]["Fecha"],date("Y-12-31"));	
        }

        $Num_Rows = $rs->num_rows;	 	
        $Pos=($pagina-1)*$ItemsPag;		
        $NroPaginas=ceil($Num_Rows/$ItemsPag);
?>

<div class="card-body table-responsive p-0" style="height: 580px">
    <table class="table table-hover table-head-fixed text-nowrap" style="height:auto;">
        <thead>
            <tr>
                <th style="width: 120px">RUC Emisor</th>
                <th>Fecha</th>
                <th>Documento</th>
                <th>Número</th>
                <th>Sub Total</th>
                <th>Igv</th>
                <th>Total</th>
                <th>Descargar</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i=$j=$k=0;
            if($Num_Rows!=0)  $rs->data_seek($Pos);
            while($i++<$ItemsPag)
            {
                if($row = $rs->fetch_assoc())
                {
        ?>
            <tr>
                <td>&nbsp;<?=$row["cpe_rucemisor"]?></td>
                <td>&nbsp;<?=FechaFormato($row["fechaemsion"])?></td>
                <td>&nbsp;<?=$row["tipodoc"]?></td>
                <td>&nbsp;<?=$row["cpe_serie"]?>-<?=$row["cpe_numero"]?></td>
                <td>&nbsp;<?=$row["subotal"]?></td>
                <td>&nbsp;<?=$row["igv"]?></td>
                <td>&nbsp;<?=$row["total"]?></td>
                <td>
                    <a href="../resources/documento/<?=$row["rutapdf"]?>" target="_blank">
                    <img src="../resources/images/general/pdf.gif" alt="PDF" width="16" height="16" border="0" />
                    </a>
                    |
                    <a href="../resources/documento/<?=$row["rutaxml"]?>" target="_blank">
                    <img src="../resources/images/general/xml.jpg" alt="XML" width="16" height="16" border="0" />
                    </a>
                    |
                    <a href="../resources/documento/<?=$row["rutacdr"]?>" target="_blank">
                    <img src="../resources/images/general/cdr.jpg" alt="CDR" width="16" height="16" border="0" />
                    </a>
                    |
                    <a href="../resources/documento/<?=$row["rutazip"]?>" target="_blank">
                    <img src="../resources/images/general/zip.png" alt="ZIP" width="16" height="16" border="0" />
                    </a>
                </td>
                <td>&nbsp;</td>
            </tr>
        <?php
                    $j++; 
                    $k++;
                }
            }
        ?>    
        </tbody>
    </table>
</div>
<?php
}
?>