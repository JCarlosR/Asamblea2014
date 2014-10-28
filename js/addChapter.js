$("#btnAccept").on('click', agregarCapitulo);

var nroCap, descrip;
function agregarCapitulo() 
{   
	nroTit = $("span:first").text()
	nroCap = $("span:last").text()
	descrip = $("#txtCapitulo").val();
	// Realizar peticion HTTP
	peticion_http.open('POST', './scripts/agregarCapitulo.php', true);
	peticion_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	peticion_http.send('descripcion='+descrip+'&nroCap='+nroCap+'&nroTit='+nroTit);

	peticion_http.onreadystatechange = muestraContenido;
	$('.editar').hide();
}
 
function muestraContenido() 
{
	if(peticion_http.readyState == 4 && peticion_http.status == 200) 
    {
    	alert("El capítulo se agregó correctamente.");
    	mostrarNuevoCapitulo(peticion_http.responseText);
    }// else alert("Ocurrió un error inesperado.");
}
 
window.onload = function () 
{
	if(window.XMLHttpRequest) {
		peticion_http = new XMLHttpRequest();
	} else if(window.ActiveXObject) {
	    peticion_http = new ActiveXObject("Microsoft.XMLHTTP");
	}
};

function mostrarNuevoCapitulo(idNuevo) 
{
	var esto = '<div class="contenedor"><img src="img/capitulo.png" alt="Capítulo" class="izquierda"><p class="title"><strong>Capítulo '+nroCap+':</strong> '+descrip+'</p><a href="articulos.php?cap='+idNuevo+'"><img src="img/ir.png" alt="capítulo1" class="derecha"></a></div>';
	document.getElementsByClassName("seccion-titulos")[0].innerHTML += esto;
}