$('#btnAccept').on('click', agregarCapitulo);
$('#txtCapitulo').on('keyup', keyUpNuevo);

$('#btnEdit').on('click', mostrarEditar);

window.onload = function () 
{
	if(window.XMLHttpRequest)
		peticion_http = new XMLHttpRequest();
	else if(window.ActiveXObject)
	    peticion_http = new ActiveXObject("Microsoft.XMLHTTP");
};

function keyUpNuevo(e) 
{
    if( e.which == 13 )
        agregarCapitulo();
    else this.value = this.value.toUpperCase();
}

var nroCap, descrip;
function agregarCapitulo() 
{   
	nroTit = $("span.nroTit").text();
	nroCap = $("span.nroCap").text();
	descrip = $("#txtCapitulo").val();
	// Realizar peticion HTTP
	peticion_http.open('POST', './scripts/agregarCapitulo.php', true);
	peticion_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	peticion_http.send('descripcion='+descrip+'&nroCap='+nroCap+'&nroTit='+nroTit);

	peticion_http.onreadystatechange = muestraContenido;

	$('#txtCapitulo').val('');
	$('#txtCapitulo').blur();
	ocultarEditar();
}
 
function muestraContenido() 
{
	if(peticion_http.readyState == 4) 
    	if(peticion_http.status == 200)
    	{
    		alert("El capítulo se agregó correctamente.");
    		mostrarNuevoCapitulo(peticion_http.responseText);
    	} else alert("Ocurrió un error inesperado.");    
}
 
function mostrarNuevoCapitulo(idNuevo) 
{
	var esto = '<div class="contenedor"><a href="articulos.php?cap='+idNuevo+'"><input type="radio" name="grupoRbtn" value="'+idNuevo+'" class="radiobtn" /><img src="img/capitulo.png" alt="Capítulo" class="izquierda"><p class="title"><strong>Capítulo '+nroCap+':</strong> '+descrip+'</p></a></div>';
	document.getElementsByClassName("seccion-titulos")[0].innerHTML += esto;
	$("span:last").text(++nroCap);
}


var nroSelected, contEditando;
function mostrarEditar() 
{
	if( $('#panel').is(":visible")  )
	{
		alert('Debe cancelar la edición actual.');
		return;
	}
	nroSelected = $('.radiobtn:checked').val();
	contEditando = $('.radiobtn:checked').parent();

	$('<section class="editar" id="panel"><form class="formAjax" action=""><label for="txtNuevo" class="como-bloque">Ingrese <strong>Capítulo <span>'+nroSelected+'</span></strong>:</label><input type="text" id="txtNuevo" class="como-bloque"><div class="edicion-boton" id="btnGoEdit"><img src="img/aceptar.png" alt="Aceptar">Aceptar</div><div class="edicion-boton" id="btnCancelEdit"><img src="img/cancelar.png" alt="Cancelar">Cancelar</div></form></section>').insertAfter(contEditando);
	$('#panel').show(); // Ya que .editar es hidden por default
	$('#txtNuevo').focus();

	$('#btnCancelEdit').on('click', function () {
		$('#panel').remove();
	});
	
	$('#btnGoEdit').on('click', modificarCapitulo);	

	$(document).on('keyup', '#txtNuevo', keyUpEdicion);
}

function keyUpEdicion(e) 
{
    if( e.which == 13 )
        modificarCapitulo();
    else this.value = this.value.toUpperCase();
}

var nuevaDescrip, nroTit;
function modificarCapitulo() 
{
	nroTit = $("span.nroTit").text();
	nuevaDescrip = $('#txtNuevo').val();
	$('#panel').remove();	
	// Realizar peticion HTTP
	peticion_http.open('POST', './scripts/agregarCapitulo.php', true);
	peticion_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	peticion_http.send('descripcion='+nuevaDescrip+'&nroCap='+nroSelected+'&nroTit='+nroTit);

	peticion_http.onreadystatechange = actualizaContenido;

	// No es necesario quitar nada ya que se usó remove sobre #panel
}

function actualizaContenido() 
{
	if(peticion_http.readyState == 4) 
    	if(peticion_http.status == 200)
    	{	// contEditando es <a>
			$(contEditando).children('.title').html('<strong>Capítulo '+nroSelected+':</strong> '+nuevaDescrip);
			// document.write(peticion_http.responseText);
			$(contEditando).attr('href', 'articulos.php?cap='+peticion_http.responseText);
    		alert("El capítulo se modificó correctamente.");
    	} else alert("Ocurrió un error inesperado.");	
}