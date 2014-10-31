$(document).on('ready', funcPrincipal);

function funcPrincipal() 
{
	$('#btnAdd').on('click', mostrarNuevo);
	$('#btnCancel').on('click', ocultarEditar);
	$('.formAjax').on('submit', envioForm);

	$('.radiobtn:first').attr('checked', true);
}

function envioForm()
{
	event.preventDefault();
}

function mostrarNuevo() 
{
	$('.editar').show();
	$('.formAjax input').focus();
}

function ocultarEditar() 
{
	$('.editar').hide();
}