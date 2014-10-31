$(document).on('ready', funcPrincipal);

function funcPrincipal() 
{
	$('#btnAdd').on('click', mostrarNuevo);
	$('#btnCancel').on('click', ocultarEditar);
	$(document).on('submit', '.formAjax', evitarEnvio);

	$('.radiobtn:first').attr('checked', true);
}

function evitarEnvio()
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