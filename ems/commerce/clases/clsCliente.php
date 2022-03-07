<?php
class clsCliente {
    
    #Constructor.
    /*-----------------------------------------------------*/
    function __construct()
    {
        $this->cCnn=new  clsCnnmysqli();
    }

    #Devuelve resultados segun opción.
    /*-----------------------------------------------------*/
    function Listar($opcion,$valor) {

        $sql = "CALL SP_ECM_LST_CLIENTE(".$opcion.", '".$valor."')";
        $rs=$this->cCnn->Sql($sql);
        return $rs;					

    }
    
    function _procMant($accion,$codigo,$tipo,$razonsocial,$dniruc,$direccion,$ubigeo,$telefono,$correo,$clave) {		 	     
            
        $sql = "CALL SP_ECM_PROC_CLIENTE(".$accion.",".validaNull($codigo,0,'int').",'".$tipo."','".$razonsocial."','".$dniruc."','".$direccion."',".$ubigeo.","
                . "'".$telefono."','".$correo."','".$clave."',@LN_RETORNO,@LS_MENSAJE);";			
        $sql = $sql."SELECT @LN_RETORNO,@LS_MENSAJE";

        $rs = $this->cCnn->Sql($sql);
        return $rs;
    }

    #Devuelve resultados segun opción.
    /*-----------------------------------------------------*/
    function Login($opcion,$correo,$clave) {

        $sql = "CALL SP_ECM_LST_LOGIN(".$opcion.",'".$correo."', '".$clave."',@LN_CODIGO,@LS_RAZONSOCIAL,@LS_CORREO,@LN_RETORNO,@LS_MENSAJE);";
        $sql = $sql."SELECT @LN_CODIGO,@LS_RAZONSOCIAL,@LS_CORREO,@LN_RETORNO,@LS_MENSAJE";
        
        $rs=$this->cCnn->Sql($sql);
        return $rs;					

    }
    
}
