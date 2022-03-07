<?php
    ob_start();
    $sep="../../../";
    require_once $sep."funciones/session.php";    
    if(!isset($_SESSION["sUser"])){ 
       exit();
    }
    require_once $sep."funciones/conexion.php";
    require_once "../clases/clsBiblioteca.php";
    
    $objBiblioteca = new clsBiblioteca();
    
    $accion   = isset($_GET['accion'])   ? $_GET['accion']   : null;
    
    $cObligatorio = ["txtAccion","txtId","txtFecha","txtTitulo","txtFile_edit"];
    $nArr=count($cObligatorio);

    switch($accion)
    {
        case "crud":
            $nombreFile = $_FILES["file"]["name"];
         
            if($nombreFile!=''){
               
                $tipo    = $_FILES["file"]["type"];
                $tam     = $_FILES["file"]["size"];
                $tmp     = $_FILES["file"]["tmp_name"];
                
                $prefijo = substr(md5(uniqid(rand())),0,6);
                $destino = $_SERVER["DOCUMENT_ROOT"]."/libertad/resources/images/slider/".$prefijo."_".$nombreFile."";
                $ruta    = $prefijo."_".$nombreFile;

                if (move_uploaded_file($tmp, $destino)) {
                    $ln_retorno = $objBiblioteca -> _procMant($_POST['txtAccion'],$_POST['txtId'],$_POST['txtFecha'],$_POST['txtTitulo'],$_POST['txtDescripcion'],$ruta,
                                                              $_POST['txtBoton'],$_POST['txtEnlace'],0,0,2);
                }
            }else{
                $txtPath = $_POST['txtFile_edit'];
                $ln_retorno = $objBiblioteca -> _procMant($_POST['txtAccion'],$_POST['txtId'],$_POST['txtFecha'],$_POST['txtTitulo'],$_POST['txtDescripcion'],$txtPath,
                                                          $_POST['txtBoton'],$_POST['txtEnlace'],0,0,2);
            }            
            
            $ln_arr     = explode("...",$ln_retorno);
            $vRetorno   = $ln_arr[0];
            $vMsgs      = $ln_arr[1];

            $vMsg = ($vRetorno > 0) ? 'success='.$vMsgs :  'warning='.$vMsgs;
            header("Location: ../biblioteca.php?rand=".GeraHash(13)."&pagina=1&".$vMsg); 
            exit;
        break;
    }
    
    switch($_GET["page"])
    {
        case "new";case "edit":

            if($_GET["page"]=="new"){  		
                $titulo     = "Nuevo";
                $txtAccion  = 1;
                $txtId      = 0;
                $txtFecha   = date("d/m/Y");
                $txtPath_edit = $txtBoton = $txtEnlace = "-";
            }else{
                $titulo    = "Modificar";
                $rs        = $objBiblioteca->Listar(1,$_GET["id"],2);
                $fila      = $rs->fetch_assoc();
                $txtAccion      = 2;
                $txtId          = $fila["BIB_ID"];
                $txtFecha       = FechaFormato($fila["BIB_FECHA"]);
                $txtTitulo      = $fila["BIB_TITULO"];
                $txtDescripcion = $fila["BIB_DESCRIPCION"];                
                $txtPath_edit   = $fila["BIB_PATH"];
                $txtBoton       = $fila["BIB_BOTON"];
                $txtEnlace      = $fila["BIB_LINK"];
            }
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-auto">
            <div class="col-sm-6"><h1>Banner</h1></div>          
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">       
    <div class="container-fluid">         
        <div class="row">
            <div class="col-md-12">          
                <div class="card card-primary card-outline">                       
                    <div class="card-header"><h3 class="card-title"> > <?=$titulo?></h3></div>
                    <form id="frmDocumento" name="frmDocumento" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lblId">N°:</label>
                                        <input type="hidden" value="<?=$txtId?>" name="txtId" id="txtId" />
                                        <input type="hidden" value="<?=$txtAccion?>" name="txtAccion" id="txtAccion" />
                                        <label for="lblFecha">Fecha:</label>
                                        <input type="text" class="form-control" id="txtFecha" name="txtFecha" 
                                               placeholder="Fecha" value="<?=$txtFecha;?>" title="Fecha" tabindex="2">
                                    </div>                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                       <label for="lblTitulo">Título(80 caracteres máximo):</label>
                                        <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" 
                                               placeholder="Título" value="<?=($_GET["page"]=='new') ? '' : $txtTitulo;?>" title="Título" tabindex="2" maxlength="80">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lblDescripcion">Descripción(250 caracteres máximo):</label>
                                        <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción..."  
                                               value="<?=($_GET["page"]=='new') ? '' : $txtDescripcion;?>" tabindex="3" autocomplete="off" maxlength="250">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="lblArchivo">Cargar:</label>
                                        <input type="file" class="form-control" id="txtFile" name="txtFile" tabindex="5">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="lblArchivo">Archivo:</label>
                                        <input type="text" class="form-control" id="txtFile_edit" name="txtFile_edit" tabindex="5" value="<?=$txtPath_edit?>" 
                                               readonly="readonly">
                                    </div>     
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                       <label for="lblTitulo">Texto de botón (80 caracteres máximo):</label>
                                        <input type="text" class="form-control" id="txtBoton" name="txtBoton" 
                                               placeholder="Texto de botón" value="<?=$txtBoton;?>" title="Texto de botón" tabindex="2" maxlength="80">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                       <label for="lblTitulo">Enlace de botón:</label>
                                        <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" 
                                               placeholder="Enlace de botón" value="<?=$txtEnlace;?>" title="Enlace de botón" tabindex="2" maxlength="80">
                                    </div>
                                </div>
                            </div>        
                        </div>
                        <div class="card-footer">
                            <button type="button" onclick="doFile('administrador/forms/frm_biblioteca.php?rand=<?=GeraHash(13)?>&accion=crud','<?php for ($i=0; $i<$nArr; $i++){ echo $cObligatorio[$i]."-"; } ?>'); " class="btn btn-primary btn-sm">Guardar</button>
                            <button type="button" onclick="myajax.Link('administrador/biblioteca.php?rand=<?=GeraHash(13)?>&pagina=<?=$_GET["pagina"];?>', 'Contenido');" class="btn btn-primary btn-sm">Regresar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    }
?>