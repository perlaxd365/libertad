<?php
class clsPedido {
    
    #Constructor.
    /*-----------------------------------------------------*/
    function __construct()
    {
        $this->cCnn=new  clsCnnmysqli();
    }

    #Devuelve resultados segun opción.
    /*-----------------------------------------------------*/
    function Listar($opcion,$valor) {

        $sql = "CALL SP_ECM_LST_PEDIDO(".$opcion.", '".$valor."')";
        $rs=$this->cCnn->Sql($sql);
        return $rs;					

    }
    
    function _procMant($accion,$codigo,$cliente,$envio,$forma,$fecha,$subtotal,$direccion) {		 	     
            
        $sql = "CALL SP_ECM_PROC_PEDIDO(".$accion.",'".$codigo."',".$cliente.",".$envio.",".$forma.",'".$fecha."',".$subtotal.",'".$direccion."',@LN_RETORNO,@LS_MENSAJE);";			
        $sql = $sql."SELECT @LN_RETORNO,@LS_MENSAJE";

        $rs = $this->cCnn->Sql($sql);
        return $rs;

    }
    
}
