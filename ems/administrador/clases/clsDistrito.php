<?php
/**
 *
 * @author Franz's
 */
class clsDistrito {
    
    #Constructor.
    /*-----------------------------------------------------*/
    function __construct()
    {
        $this->cCnn=new  clsCnnmysqli();
    }

    #Devuelve resultados segun opción.
    /*-----------------------------------------------------*/
    function Listar($opcion,$valor) {

        $sql = "CALL SP_GLB_LST_DISTRITO(".$opcion.", '".$valor."')";
        $rs=$this->cCnn->Sql($sql);
        return $rs;					

    }
    
}