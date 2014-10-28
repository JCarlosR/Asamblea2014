$('#btnAccept').on('click', agregarTitulo);
$('#txtTitulo').on('keyup', teclaPresionada);

function teclaPresionada(e) 
{
    if( e.which == 13 )
        agregarTitulo();
    else this.value = this.value.toUpperCase();
}

var nroTit, descrip;
function agregarTitulo() 
{   
	nroTit = $("span:first").text()
	descrip = $("#txtTitulo").val();
	// Realizar peticion HTTP
	peticion_http.open('POST', './scripts/agregarTitulo.php', true);
	peticion_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	peticion_http.send('descripcion='+descrip+'&nroTit='+nroTit);

	peticion_http.onreadystatechange = muestraContenido;

	$('#txtTitulo').val('');
	$('#txtTitulo').blur();
	ocultarEditar();
}
 
function muestraContenido() 
{
	if(peticion_http.readyState == 4) 
    	if(peticion_http.status == 200)
    	{
    		alert("El título se agregó correctamente.");
    		mostrarNuevoTitulo(peticion_http.responseText);
    	} else alert("Ocurrió un error inesperado.");
}
 
window.onload = function () 
{
	if(window.XMLHttpRequest) {
		peticion_http = new XMLHttpRequest();
	} else if(window.ActiveXObject) {
	    peticion_http = new ActiveXObject("Microsoft.XMLHTTP");
	}
};

function mostrarNuevoTitulo(idNuevo) 
{
	var esto = '<div class="contenedor"><img src="img/titulo.png" alt="Título" class="izquierda"><p class="title"><strong>Título '+nroTit+':</strong> '+descrip+'</p><a href="capitulos.php?title='+idNuevo+'"><img src="img/ir.png" alt="titulo1" class="derecha"></a></div>';
	document.getElementsByClassName("seccion-titulos")[0].innerHTML += esto;
}