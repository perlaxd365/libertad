<section>

&nbsp&nbsp;&nbsp;

<?php

if($pagina>1){

?>

<a href="javascript:void(0);" onclick="myajax.Link('<?=$modulo?>/<?=$url?>.php?action=<?=$action?>&pagina=1&TipoBus='+<?=$url?>.TipoBus.value+'&TxtCampoBus='+<?=$url?>.TxtCampoBus.value+'', 'Contenido');"><img src="../resources/images/general/b_inicio_on.gif" border="0" align="texttop" /></a>



<a href="javascript:void(0);" onclick="myajax.Link('<?=$modulo?>/<?=$url?>.php?action=<?=$action?>&pagina=<?=($pagina-1)?>&TipoBus='+<?=$url?>.TipoBus.value+'&TxtCampoBus='+<?=$url?>.TxtCampoBus.value+'', 'Contenido');"><img src="../resources/images/general/b_izq_on.gif" border="0" align="texttop" /></a>

<?php

}else{

?>

<img src="../resources/images/general/b_inicio_off.gif" border="0" align="texttop" />

&nbsp;

<img src="../resources/images/general/b_izq_off.gif" border="0" align="texttop" />

<?php

}

?>

|&nbsp;&nbsp;Total: <?=$Num_Rows?> Items encontrados - <?=$pagina?> de <?=$NroPaginas?> P&aacute;ginas&nbsp;&nbsp;|

<?php

if($pagina<$NroPaginas){

?>

&nbsp;&nbsp;

<a href="javascript:void(0);" onclick="myajax.Link('<?=$modulo?>/<?=$url?>.php?action=<?=$action?>&pagina=<?=($pagina+1)?>&TipoBus='+<?=$url?>.TipoBus.value+'&TxtCampoBus='+<?=$url?>.TxtCampoBus.value+'', 'Contenido');">

<img src="../resources/images/general/b_der_on.gif" align="absmiddle" border="0"></a>&nbsp;

<a href="javascript:void(0);" onclick="myajax.Link('<?=$modulo?>/<?=$url?>.php?action=<?=$action?>&TipoBus='+<?=$url?>.TipoBus.value+'&TxtCampoBus='+<?=$url?>.TxtCampoBus.value+'&pagina=<?=$NroPaginas?>', 'Contenido');">

<img src="../resources/images/general/b_final_on.gif" align="absmiddle" border="0"></a>

&nbsp;&nbsp;

<?php

}else{

?>

&nbsp;&nbsp;							

<img src="../resources/images/general/b_der_off.gif" align="absmiddle" border="0">&nbsp;

<img src="../resources/images/general/b_final_off.gif" align="absmiddle" border="0">

&nbsp;&nbsp;

<?php

}

?>   

</section>