<?php
class clsPedido_c {
    
    #Constructor.
    /*-----------------------------------------------------*/
    function __construct()
    {
        $this->cCnn=new  clsCnnmysqli();
    }

    #Devuelve resultados segun opción.
    /*-----------------------------------------------------*/
    function Listar($opcion,$valor) {

        $sql = "CALL SP_ECM_LST_DETPEDIDO(".$opcion.", '".$valor."')";
        $rs=$this->cCnn->Sql($sql);
        return $rs;					

    }
    
    function _procMant($accion,$codigo,$producto,$precio,$cant) {		 	     
            
        $sql = "CALL SP_ECM_PROC_DETPEDIDO(".$accion.",".$codigo.",'".$producto."',".$precio.",".$cant.",@LN_RETORNO,@LS_MENSAJE);";			
        $sql = $sql."SELECT @LN_RETORNO,@LS_MENSAJE";

        $rs = $this->cCnn->Sql($sql);
        return $rs;

    }
    
}
