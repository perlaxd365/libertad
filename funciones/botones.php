<table>
    <tr>
        <?php
            if($btn == 0 ){
        ?>
        <td>
            <a href="#" onclick="myajax.Link('<?=$modulo?>/<?=$url?>.php?rand=<?=GeraHash(13)?>&pagina=<?=$pagina;?>', 'Contenido');">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-bell"></i> Recuperar</button>
            </a>
        </td>
        <?php
            }else{
        ?>
        <td>
            <a href="#" onclick="myajax.Link('<?=$modulo?>/forms/frm_<?=$url?>.php?rand=<?=GeraHash(13)?>&page=new&pagina=<?=$pagina;?>', 'Contenido');">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-book"></i> Nuevo</button>
            </a>
        </td>
        <td>
            <a href="#" onclick="myajax.Link('<?=$modulo?>/<?=$url?>.php?rand=<?=GeraHash(13)?>&pagina=<?=$pagina;?>', 'Contenido');">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-bell"></i> Recuperar</button>
            </a>
        </td>
        <?php
            }
        ?>
        <td>&nbsp;</td>        
    </tr>
</table>