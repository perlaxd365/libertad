<?php
/**
 *
 * @author Franz's
 */
class clsBiblioteca {
    
    #Constructor.
    /*-----------------------------------------------------*/
    function __construct()
    {
        $this->cCnn=new  clsCnnmysqli();
    }
    
    #Devuelve resultados segun opción.
    /*-----------------------------------------------------*/
    function Listar($opcion,$valor,$tipo) {

        $sql = "CALL SP_WEB_LST_BIBLIOTECA(".$opcion.", '".$valor."',".$tipo.")";
        $rs=$this->cCnn->Sql($sql);
        return $rs;					

    }

    #CRUD.
    /*-----------------------------------------------------*/
    function _procMant($accion,$bibId,$bibFecha,$bibTitulo,$bibDescripcion,$bibPath,$bibBoton,$bibLink,$bibInicio,$bibPosicion,$bibTipo) {		 	     

        $sql = "CALL SP_WEB_PROC_BIBLIOTECA(".$accion.",".$bibId.",'".FormatoFecha($bibFecha)."','".$bibTitulo."','".$bibDescripcion."',"
                . "'".$bibPath."','".$bibBoton."','".$bibLink."',".$bibInicio.",".$bibPosicion.",".$bibTipo.",0,@LN_RETORNO,@LS_MENSAJE,@LN_BIB_ID);";			
        $sql = $sql."SELECT @LN_RETORNO AS LN_RETORNO,@LS_MENSAJE AS LS_MENSAJE,@LN_BIB_ID AS LN_BIB_ID";

        $rs = $this->cCnn->Sql($sql);
        return $rs;

    }
    
}