<?php
/**
 *
 * @author Franz's
 */
class clsUsuario {
    
    #Constructor.
    /*-----------------------------------------------------*/
    function __construct()
    {
        $this->cCnn=new  clsCnnmysqli();
    }

    function Login($opcion,$login,$clave) {

        $sql = "CALL SP_GLB_LST_LOGIN(".$opcion.",'".$login."', '".$clave."',@LS_LOGIN,@LN_RETORNO,@LS_MENSAJE);";
        $sql = $sql."SELECT @LS_LOGIN,@LN_RETORNO,@LS_MENSAJE";
       
        $rs=$this->cCnn->Sql($sql);
        return $rs;					

    }
    
}
