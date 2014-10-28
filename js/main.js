$(document).on('ready', funcPrincipal);

function funcPrincipal() 
{
	$('#btnAdd').on('click', mostrarEditar);
	$('#btnCancel').on('click', ocultarEditar);
}

function mostrarEditar() 
{
	$('.editar').show();
	document.getElementById("txtTitulo").focus();
}

function ocultarEditar() 
{
	$('.editar').hide();
}