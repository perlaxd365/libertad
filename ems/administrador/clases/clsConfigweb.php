<?php

/**

 *

 * @author Franz's

 */

class clsConfigweb {

    

    #Constructor.

    /*-----------------------------------------------------*/

    function __construct()

    {

        $this->cCnn=new  clsCnnmysqli();

    }

    

    #Devuelve resultados segun opción.

    /*-----------------------------------------------------*/

    function ListarConfigWeb() {



        $sql = "CALL SP_DATA_ETIQUETAS()";

        $rs=$this->cCnn->Sql($sql);

        return $rs;					



    }



    

}