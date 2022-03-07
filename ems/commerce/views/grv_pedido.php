<?php
    $action = isset($_GET['action']) 	? $_GET['action'] 		: null;	
    $page   = isset($_GET['page']) 	? $_GET['page'] 		: null;	

    switch($action){
	
    case "search":

         $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;			
         $TxtBus = ($_GET["TipoBus"]==4) ? FormatoFecha($TxtCampoBus) : $TxtCampoBus;
        
         $rs=$objPedido->Listar($TipoBus,$TxtBus); 		
         break;	
     
    case "val":

         $ln_retorno = $objPedido -> _procMant($_GET["kval"],$_GET['id'],0,0,0,date("Y-m-d"),0,null);
         $ln_arr = explode("...",$ln_retorno);

         $vMsg = ($ln_arr[0] > 0) ? 'success='.$ln_arr[1] :  'warning='.$ln_arr[1];
         header("Location: $url.php?rand=".GeraHash(13)."&pagina=1&".$vMsg.""); 
    break;
}
    
    switch($page)
    {		
        default:

            if($action!="search"){
               $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
               $rs=$objPedido->Listar(0,null);	
            }

            $Num_Rows = $rs->num_rows;	 	
            $Pos=($pagina-1)*$ItemsPag;		
            $NroPaginas=ceil($Num_Rows/$ItemsPag);
?>

<div class="card-body table-responsive p-0" style="height: 560px;">
    <table class="table table-hover table-head-fixed text-nowrap" style="height:auto;">
        <thead>
            <tr>                
                <th width="15"></th>
                <th width="70">Fecha</th>
                <th width="90">N&deg; Identidad</th>
                <th width="470">Apellidos y Nombres / Raz&oacute;n Social</th>
                <th width="170">Forma de Pago</th>
                <th width="100">Total</th>
                <th width="15">&nbsp;</th>
                <th width="50">&nbsp;</th>
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
                    $vDanger = ($row["estado_pedido"]==2) ? "class='text-danger'" : '';
        ?>
            <tr <?=$vDanger?>>   
                <td>                    
                    <a href="javascript:void(0);" onclick="Eliminar('<?=$modulo?>/<?=$url?>.php?','action=val&kval=2&pagina=<?=$pagina?>&id=<?=$row["cod_pedido"];?>&rand=<?=GeraHash(13);?>')">
                       <img src="../resources/images/general/i_deletecell.png" alt="Anular" width="16" height="16" border="0" />       
                    </a>
                </td>
                <td>&nbsp;<?=FechaFormato($row["fecha_pedido"])?></td>
                <td>&nbsp;<?=$row["dniruc"]?></td>
                <td>&nbsp;<?=$row["razonsocial"]?></td>
                <td>&nbsp;<?=$row["nomb_forma_pago"]?></td>
                <td>&nbsp;S/.&nbsp;<?=  FormatNumber($row["total_pedido"],2)?></td>
                <td>                    
                    <img src="../resources/images/general/<?=$row["estado_pedido"]?>.png" alt="" width="16" height="16" border="0" />                       
                </td>
                <td> 
                    <a href="javascript:void(0);" onclick="Estado('<?=$modulo?>/forms/frm_<?=$url?>.php?','page=purchase&pagina=<?=$pagina?>&Id=<?=$row["cod_pedido"];?>&rand=<?=GeraHash(13);?>');">
                        <img src="../resources/images/general/printer.png" alt="Editar Registro" width="16" height="16" border="0" />                       
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