$('#btnGuardar').on('click', agregarArticulo);

var nroTit, nroCap, idCap, contenido;
function agregarArticulo() 
{   
	idCap = $("#idCap").text();
	nroTit = $("#nroTit").text();
	nroCap = $("#nroCap").text();
	contenido = $("#txtContenido").val();
	// Realizar peticion HTTP
	peticion_http.open('POST', './scripts/agregarArticulo.php', true);
	peticion_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	peticion_http.send('contenido='+contenido+'&nroTit='+nroTit+'&nroCap='+nroCap+'&idCap='+idCap);

	peticion_http.onreadystatechange = muestraContenido;
}
 
function muestraContenido() 
{
	if(peticion_http.readyState == 4) 
    	if(peticion_http.status == 200)
    	{
    		alert("El artículo se agregó correctamente.");
    		location.href = 'articulos.php?cap='+idCap;
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