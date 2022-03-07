<?php
    class clsCnnmysqli {

        private $HostName;		 
        private $BaseDatos;	 
        private $User; 		 
        private $Password; 	 

        var     $Cnn; 			  

        #Constructor	
        /*-----------------------------------------------------*/		
        function __construct() 
        {  
            $objCnn = new clsCnn();
            $this->HostName  = $objCnn->gHostName;
            $this->BaseDatos = $objCnn->gBaseDatos;
            $this->User      = $objCnn->gUser;
            $this->Password  = $objCnn->gPassword;						  						
        }

        #Metodo que crea y retorna la conexion a la BD
        /*-----------------------------------------------------*/		
        function AbrirConexion()
        {				  
            try{ 
                $this->Cnn = new mysqli($this->HostName, $this->User, $this->Password, $this->BaseDatos);   

                if( $this->Cnn->connect_error ) {
                    die("Error al conectarse a MySQL: (" . $this->Cnn->connect_error . ") " . $this->Cnn->connect_error);
                }
            }catch (Exception $e){
                    die("Error!: " . $e->getMessage() . '<br/>'."\n");
            }
        }

        #Metodo que cierra la conexion a la BD
        /*-----------------------------------------------------*/	 
        function CerrarConexion(){	
            $this->Cnn->close();
        }

        #Metodo que ejecuta un query sql; 
        #Retorna un resultado si es un SELECT
        /*-----------------------------------------------------*/
        function Sql($strSql){

            $this->AbrirConexion();
            $arrSql = explode(";",$strSql);
            $nn     = count($arrSql);

            if( $nn == 1 ){
                $rs = $this->Cnn->query($strSql);

                if(!$rs){
                      $this->Cnn->rollback();
                }else{			
                      $this->Cnn->commit();
                }
            }else{		
                $rsx = $this->Cnn->multi_query($strSql);	

                if(!$rsx){
                  $this->Cnn->rollback();
                }else{			
                  $this->Cnn->commit();
                }

                if ($rsx) {

                    do {

                        if ($result = $this->Cnn->store_result()) {
                            while ($row = $result->fetch_row()) {

                                $iCount = count($row);
                                if ( $iCount == 2) {                                 
                                    $rs = $row[0]."...".$row[1];
                                }else if ( $iCount == 3) {
                                    $rs = $row[0]."...".$row[1]."...".$row[2];                                 
                                }else if ( $iCount == 4) {
                                    $rs = $row[0]."...".$row[1]."...".$row[2]."...".$row[3];
                                }else if ( $iCount == 5) {
                                    $rs = $row[0]."...".$row[1]."...".$row[2]."...".$row[3]."...".$row[4];
                                }else if ( $iCount == 6) {
                                    $rs = $row[0]."...".$row[1]."...".$row[2]."...".$row[3]."...".$row[4]."...".$row[5];
                                }
                                
                                
                                
                            }
                            $result->free();
                        }

                        if (!$this->Cnn->more_results()) break;

                    } while ( $this->Cnn->next_result());

                }	   
            }		

            $this->CerrarConexion();
            return $rs;  
        }			 
    }
?>