<?php

    function GeraHash($qtd){
        return date("dmYHms");
    }
    
    #dd/mm/YYYY
    function FechaFormato($fecha){
        $fech = $fecha;

        if ((substr($fecha,4,1)=='-') || (substr($fecha,7,1)=="-"))
        { 
            $anio = substr($fecha,0,4);
            $mes = substr($fecha,5,2);
            $dia = substr($fecha,8,2);
            $fech= $dia."/".$mes."/".$anio;
        }
        return $fech;
    }

    function FormatoFecha($fecha){
        $fech = $fecha;

        if ((substr($fecha,2,1)=='/') || (substr($fecha,5,1)=="/"))
        { 
            $dia = substr($fecha,0,2);
            $mes = substr($fecha,3,2);
            $anio = substr($fecha,6,4);
            $fech= $anio."-".$mes."-".$dia;
        }
        return $fech;
    }
    
    function FormatNumber($Valor,$Redondeo)
    {
       if ($Valor>=0){
               return number_format($Valor,$Redondeo,".",","); 
       }else{
               return "(".number_format(abs($Valor),$Redondeo,".",",").")"; 
       }
    }
    
    function VerImage($image)
    {
        if($image==""){
                return "noimagen.png";
        }else{
                return $image;
        }
    }
    
    function validaNull($Valor, $defecto = '', $type = 'string') {
        if (is_null($Valor)) {
            return (($defecto == '') && ($type == 'string')) ? $Valor : $defecto;
        } else {
            switch ($type) {
                case 'string':
                    return ( is_string($Valor) ? $Valor : $defecto );
                case 'int':
                    return ( is_numeric($Valor) && !is_nan($Valor) ) ? $Valor : $defecto;
                case 'float':
                    return ( is_float($Valor) && !is_nan($Valor) ) ? $Valor : $defecto;
                case 'date':
                    $bTipo1 = preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $Valor);
                    $bTipo2 = preg_match("/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/", $Valor);
                    $bTipo3 = preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/", $Valor);
                    return ( $bTipo1 || $bTipo2 || $bTipo3 ) ? $Valor : $defecto;
                case 'time':
                    $bTipo1 = preg_match("/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/", $Valor);
                    return ( $bTipo1 ) ? $Valor : $defecto;
                case 'timestamp':
                    $bTipo1 = preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $Valor);
                    $bTipo2 = preg_match("/^[0-9]{2}.[0-9]{2}.[0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $Valor);
                    $bTipo3 = preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $Valor);
                    return ( $bTipo1 || $bTipo2 || $bTipo3 ) ? $Valor : $defecto;
                default :
                    return $Valor;
            }
        }
    }

?>