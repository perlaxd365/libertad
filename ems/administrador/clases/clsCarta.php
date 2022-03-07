<?php
    class clsCarta
    {
        var $items;     // Items en Carta
        var $num_items;
        var $cadcesta;
        function __construct()
        {
           $this->num_items=0;
        }
        // Agrega el articulo $art con indice $idart a la carta
       /****************************************/
        function Add_Item($idart,$art)
        {	
           $encontrado=0;
           if($this->num_items!=0)
           {
                   foreach($this->items as $k => $valor)
                   {			
                           if($k==$idart)
                           {			
                                   $encontrado=1;
                                   break;
                           }
                   }
           }
           if($encontrado!=1)
           {
                   $this->items[$idart]=$art;
                   $this->num_items++;
           }
        }
        // Elimina un articulo $art fuera de la carta con indice $idart
        /****************************************/
        function Remove_Item($idart)
        {
            $encontrado=0;
            if($this->num_items!=0)
            {
                foreach($this->items as $k => $valor)
                {
                    if($k==$idart)
                    {
                        $encontrado=1;
                        $this->num_items--;
                    }	
                    else			
                        $tmp[$k]=$valor;			
                }
            }
            $this->items=$tmp;
            if($encontrado)
               return true;
            else
               return false;
        }
         // Remove carta
        /****************************************/
        function Remove_Cart()
        {
         unset($this->items);
               $this->num_items=0;
        }
        /****************************************/
        function &Get_Items()
        {	
            return $this->items;
        }
        /****************************************/
        function Put_strCesta($cesta)
        {
            $this->cadcesta=$cesta;
        }
        /****************************************/
        function Get_strCesta()
        {
            return $this->cadcesta;
        }
        /****************************************/
        function mas()
        {
            $this->num_items++;
        }
        /****************************************/
        function valor()
        {
            return $this->num_items;
        }
    }
?>