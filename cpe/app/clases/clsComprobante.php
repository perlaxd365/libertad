<?php
    class clsComprobante {
        
        #Constructor.
        /*-----------------------------------------------------*/
        function __construct() {
            
            $this->cCnn=new  clsCnnmysqli();
            
        }
        
        #Devuelve resultados segun opción.
        /*-----------------------------------------------------*/
        function Listar($opcion,$emisor,$tipo,$serie,$numero,$fecha,$total,$desde,$hasta) {

            $sql = "CALL SP_CPE_LST_COMPROBANTE(".$opcion.", '".$emisor."', '".$tipo."', '".$serie."', '".$numero."','".$fecha."', '".$total."', '".$desde."', '".$hasta."')";
            
            $rs=$this->cCnn->Sql($sql);
            return $rs;					

        }
        
    }
?>
