/* Franz's*/
/***************************************/
function doFile(vUrl,vArr){
 
    var formData = new FormData();

    var fileSelect = document.getElementById("txtFile");
	
    if(fileSelect.files && fileSelect.files.length === 1){
       var file = fileSelect.files[0];
       formData.set("file", file , file.name);
    }

    
    var vCampo = vArr.split("-");
    var vBandera = 0;
    
    for ( i=0; i < vCampo.length-1; i++) {
        campo = document.getElementById(vCampo[i]);
        
        if ( campo.value === "" || campo.value === "--Seleccione--" ){
            alert("Campo obligatorio en "+campo.title+"");
            campo.focus();
            return (false);
        }else {
            vBandera = 1;
            formData.set(campo.id, campo.value);
        }       
    }
     
    var objAjax = new XMLHttpRequest();
        objAjax.open('POST', vUrl);
	
    objAjax.onreadystatechange=function(){
        if( objAjax.readyState===4 ){
            document.getElementById('Contenido').innerHTML = objAjax.responseText;
        }
    }
      
    if ( vBandera===1 ) {
        var answer = confirm("Esta seguro de guardar registro?");
        if (answer){
            objAjax.send(formData);
        }
    }
    
}