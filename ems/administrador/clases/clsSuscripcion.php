<?php

/**

 *

 * @author Franz's

 */

class clsSuscripcion {

    

    #Constructor.

    /*-----------------------------------------------------*/

    function __construct()

    {

        $this->cCnn=new  clsCnnmysqli();

    }

    

    #Devuelve resultados segun opción.

    /*-----------------------------------------------------*/

    function addSuscripcion($email) {



        $sql = "CALL SP_ADD_SUSCRIPCION('".$email."')";

        $rs=$this->cCnn->Sql($sql);

        return $rs;					



    }



    

}