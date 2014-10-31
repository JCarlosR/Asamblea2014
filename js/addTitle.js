$('#btnAccept').on('click', agregarTitulo);
$('#txtTitulo').on('keyup', keyUpNuevo);

$('#btnEdit').on('click', mostrarEditar);

window.onload = function () 
{	// Habilitar XMLHttpRequest (AJAX)
	if(window.XMLHttpRequest) {
		peticion_http = new XMLHttpRequest();
	} else if(window.ActiveXObject) {
	    peticion_http = new ActiveXObject("Microsoft.XMLHTTP");
	}
};

function keyUpNuevo(e) 
{
    if( e.which == 13 )
        agregarTitulo();
    else this.value = this.value.toUpperCase();
}

var nroTit, descrip;
function agregarTitulo() 
{   
	nroTit = $("span:first").text();
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
 
function mostrarNuevoTitulo(idNuevo) 
{
	var nuevoContenedor = '<div class="contenedor"><a href="capitulos.php?title='+idNuevo+'"><input type="radio" name="grupoRbtn" value="'+nroTit+'" class="radiobtn" /><img src="img/titulo.png" alt="Título" class="izquierda"><p class="title"><strong>Título '+nroTit+':</strong> '+descrip+'</p></a></div>';
	document.getElementsByClassName("seccion-titulos")[0].innerHTML += nuevoContenedor;
	$("span:first").text(++nroTit);
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

	$('<section class="editar" id="panel"><form class="formAjax" action=""><label for="txtNuevo" class="como-bloque">Ingrese <strong>Título <span>'+nroSelected+'</span></strong>:</label><input type="text" id="txtNuevo" class="como-bloque"><div class="edicion-boton" id="btnGoEdit"><img src="img/aceptar.png" alt="Aceptar">Aceptar</div><div class="edicion-boton" id="btnCancelEdit"><img src="img/cancelar.png" alt="Cancelar">Cancelar</div></form></section>').insertAfter(contEditando);
	$('#panel').show(); // Ya que .editar es hidden por default
	$('#txtNuevo').focus();

	$('#btnCancelEdit').on('click', function () {
		$('#panel').remove();
	});
	
	$('#btnGoEdit').on('click', function () {
		modificarTitulo();
	});	

	$(document).on('keyup', '#txtNuevo', keyUpEdicion);
}

function keyUpEdicion(e) 
{
    if( e.which == 13 )
        modificarTitulo();
    else this.value = this.value.toUpperCase();
}

var nuevaDescrip;
function modificarTitulo() 
{
	nuevaDescrip = $('#txtNuevo').val();
	$('#panel').remove();	
	// Realizar peticion HTTP
	peticion_http.open('POST', './scripts/agregarTitulo.php', true);
	peticion_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	peticion_http.send('descripcion='+nuevaDescrip+'&nroTit='+nroSelected);

	peticion_http.onreadystatechange = actualizaContenido;

	// No es necesario quitar nada ya que se usó remove sobre #panel
}

function actualizaContenido() 
{
	if(peticion_http.readyState == 4) 
    	if(peticion_http.status == 200)
    	{	// contEditando es <a>
			$(contEditando).children('.title').html('<strong>Título '+nroSelected+':</strong> '+nuevaDescrip);
			$(contEditando).attr('href', 'capitulos.php?title='+peticion_http.responseText);
    		alert("El título se modificó correctamente.");
    	} else alert("Ocurrió un error inesperado.");	
}