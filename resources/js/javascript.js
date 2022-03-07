/* Franz's*/

var vRand = parseInt(Math.random()*999999999999999);

/***************************************/
function Buscar(event,Url,NombreFormulario,Raiz) 
{
    if(Raiz=='undefined') Raiz="";
    var key = (document.all) ? event.which : event.keyCode;

    if(key==13 || event==13){
        
        if(document.getElementById('pagina')!=null) document.getElementById('pagina').value=1;		
        
        switch(NombreFormulario){
            case 'fch':	
                myajax.Link(Url+'?rand=' + vRand+'&action=search&TxtDesde='+document.getElementById("TxtDesde").value+'&TxtHasta='+document.getElementById('TxtHasta').value, 'Contenido');               
                break;
            case 'busq':	
                myajax.Link(Url+'?rand=' + vRand+'&action=search&TipoBus='+document.getElementById("TipoBus").options[document.getElementById("TipoBus").selectedIndex].value+'&TxtCampoBus='+document.getElementById('TxtCampoBus').value, 'Contenido');               
                break;
        }
    }else{
        return key;
    }
};

/***************************************/
function doPost(form,arr){
	
   var a=arr.split("-");
   var i = 0;
   for (x=0;x<a.length-1;x++)
   {
       campo=document.getElementById(a[x]);
       if (campo.value==="" || campo.value === "--Seleccione--" ){
               alert("Campo obligatorio en "+campo.title+"");
               campo.focus();
               return (false);
       }else {
              i=1; 
       }
   }
	
   if ( i===1 ) {
       var answer = confirm("Esta seguro de guardar registro?");
       if (answer){
           myajax.Form(form, 0);
       }
   }	

}

/***************************************/
function Estado(vUrl,vParam){
    myajax.Link(vUrl+vParam,'Contenido');	
}

/***************************************/
function Eliminar(url,vParam){
    var answer = confirm("Esta seguro de eliminar registro?");
    if (answer){
        myajax.Link(url+vParam,'Contenido');
    }
}

/***************************************/
function Descargar(vUrl,vParam){
    myajax.Link(vUrl+vParam);	
}

function Insertar(url,vParam) {
		 
    var answer = confirm("Esta seguro de guardar registro?");
    if (answer){
        myajax.Link(url+vParam,'Contenido');
    }
}