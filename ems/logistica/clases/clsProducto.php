<?php
    class clsProducto {
        
        #Constructor.
        /*-----------------------------------------------------*/
        function __construct() {
            
            $this->cCnn=new  clsCnnmysqli();
            
        }
        
        #Devuelve resultados segun opción.
        /*-----------------------------------------------------*/
        function Listar($opcion,$valor,$ini,$limit) {

            $sql = "CALL SP_LGK_LST_PRODUCTO(".$opcion.", '".$valor."',$ini,$limit)"; 
            $rs=$this->cCnn->Sql($sql);
            return $rs;					

        }
        
    }
?>
