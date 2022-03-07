var archivo_1  = "../funciones/fcn_suggest.php";
var subject_id = '';
var code_id    = '';
var opt_       = '';
var content_   = '';

var obj_http = zXmlHttp.createRequest();
/***************************************/
function getScriptPage(opcion,div_id,content_id,cod_id,cod_id2,limite,otro)
{
    var cadd = "";
    var rnd  = parseInt(Math.random()*99999999);

    subject_id = div_id;
    opt_       = opcion;
    code_id    = cod_id;
    content_   = document.getElementById(content_id).value;
    
    cadd = archivo_1+"?rnd="+rnd+"&content=" + escape(content_)+"&opcion="+opcion+"&nombre="+content_id+"&ident="+cod_id+"&campo2="+cod_id2+"&limite="+limite+otro;
    
    obj_http.open("GET",cadd, true);
    obj_http.onreadystatechange = handleHttpResponse;
    obj_http.send(null);
    if(content_.length>0)
        boxpanel('1');
    else
        boxpanel('0');
}
/***************************************/ 
function handleHttpResponse() {
    if (obj_http.readyState === 4) {
        if (subject_id !== '') {
            document.getElementById(subject_id).innerHTML = obj_http.responseText;
        }
    }
}
/***************************************/ 
function boxpanel(act) {
    if( act === '0' ) {
        if(subject_id.length>0) {
            document.getElementById(subject_id).style.display = 'none';
            if(content_.length===0){
                document.getElementById(code_id).value='';
            }
        }
    }else{
        if(subject_id.length > 0){
            document.getElementById(subject_id).style.display = 'block';
        }
    }
}
/***************************************/
function highlight(action,id) {
    if(action){	
        document.getElementById(opt_+'word'+id).bgColor = "#C2B8F5";
    }else{
        document.getElementById(opt_+'word'+id).bgColor = "#F8F8F8";
    }
}
   
function fdisplay(word,destino,pase)
{
    document.getElementById(destino).value = word;
    if( pase===1 ){
        document.getElementById(subject_id).style.display = 'none';	
        document.getElementById(destino).focus();
    }
}
