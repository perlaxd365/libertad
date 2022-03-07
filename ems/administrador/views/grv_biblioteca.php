<?php
    $action = isset($_GET['action']) 	? $_GET['action'] 		: null;	
    $page   = isset($_GET['page']) 	? $_GET['page'] 		: null;	

    
    switch($page)
    {		
        default:

            if($action!="search"){
               $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
               $rs=$objBiblioteca->Listar(0,null,2);	
            }

            $Num_Rows = $rs->num_rows;	 	
            $Pos=($pagina-1)*$ItemsPag;		
            $NroPaginas=ceil($Num_Rows/$ItemsPag);
?>

<div class="card-body table-responsive p-0" style="height: 560px;">
    <table class="table table-hover table-head-fixed text-nowrap" style="height:auto;">
        <thead>
            <tr>
                <th width="50">&nbsp;</th>
                <th width="70">Fecha</th>
                <th width="450">Título</th>
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
                    $vDanger = ($row["BIB_ESTADO"]==2) ? "class='text-danger'" : '';
        ?>
            <tr <?=$vDanger?>>
                <td>
                    <a href="javascript:void(0);" onclick="Estado('<?=$modulo?>/forms/frm_<?=$url?>.php?','page=edit&pagina=<?=$pagina?>&id=<?=$row["BIB_ID"];?>&rand=<?=GeraHash(13);?>');">
                    <img src="../resources/images/general/i_edit.png" alt="Editar Registro" width="16" height="16" border="0" /></a>
                        |
                    <a href="javascript:void(0);" onclick="Eliminar('<?=$modulo?>/<?=$url?>.php?','action=val&kval=3&pagina=<?=$pagina?>&id=<?=$row["BIB_ID"];?>&rand=<?=GeraHash(13);?>')">
                        <img src="../resources/images/general/i_deletecell.png" alt="Editar Registro" width="16" height="16" border="0" />
                    </a>
                </td>
                <td>&nbsp;<?=FechaFormato($row["BIB_FECHA"])?></td>
                <td>
                    &nbsp;
                    <?php
                    if($row["BIB_TITULO"]!==''){
                        echo $row["BIB_TITULO"];
                    }else{
                        echo "-";
                    }
                    ?>
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