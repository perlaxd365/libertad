<?php
$action = isset($_GET['action']) 	? $_GET['action'] 		: null;	
$page   = isset($_GET['page']) 		? $_GET['page'] 		: null;	

switch($action){
	
    case "search":

         $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;				
         $rs=$objCliente->Listar($TipoBus,$TxtCampoBus); 		
         break;

    case "val":

         $ln_retorno = $objCliente -> _procMant($_GET["kval"],$_GET['id'],null,null,null,null,0,null,null,null);
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
           $rs=$objCliente->Listar(0,null);	
        }

        $Num_Rows = $rs->num_rows;	 	
        $Pos=($pagina-1)*$ItemsPag;		
        $NroPaginas=ceil($Num_Rows/$ItemsPag);
?>

<div class="card-body table-responsive p-0" style="height: 575px;">
    <table class="table table-hover table-head-fixed text-nowrap" style="height:auto;">
        <thead>
            <tr>
                <th width="50px">&nbsp;</th>
                <th width="80px">N°Documento</th>
                <th width="380px">Apellidos y Nombres/Razón Social</th>
                <th width="150px">Teléfono</th>
                <th width="190px">Correo</th>
                <th width="15">&nbsp;</th>
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
                     $vDanger = ($row["estado"]==2) ? "class='text-danger'" : '';
        ?>
            <tr <?=$vDanger?>>
                <td>
                    <a href="javascript:void(0);" onclick="Estado('<?=$modulo?>/forms/frm_<?=$url?>.php?','page=edit&pagina=<?=$pagina?>&id=<?=$row["codigo"];?>&rand=<?=GeraHash(13);?>');">
                    <img src="../resources/images/general/i_edit.png" alt="Editar Registro" width="16" height="16" border="0" /></a>
                        |
                    <a href="javascript:void(0);" onclick="Eliminar('<?=$modulo?>/<?=$url?>.php?','action=val&kval=4&pagina=<?=$pagina?>&id=<?=$row["codigo"];?>&rand=<?=GeraHash(13);?>')">
                        <img src="../resources/images/general/i_deletecell.png" alt="Editar Registro" width="16" height="16" border="0" />
                    </a>
                </td>
                <td>&nbsp;<?=$row["dniruc"]?></td>
                <td>&nbsp;<?=$row["razonsocial"]?></td>
                <td>&nbsp;<?=$row["telefono"]?></td>
                <td>&nbsp;<?=$row["email"]?></td>                
                <td>                    
                    <img src="../resources/images/general/<?=$row["estado"]?>.png" alt="" width="16" height="16" border="0" />                       
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