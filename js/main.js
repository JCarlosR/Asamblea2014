$(document).on('ready', funcPrincipal);

function funcPrincipal() 
{
	$('#btnAdd').on('click', mostrarEditar);
	$('#btnCancel').on('click', ocultarEditar);
	$('.formAjax').on('submit', envioForm);

	$('.radiobtn:first').attr('checked', true);
	$('#btnEdit').on('click', function(){
		alert("Pronto estará disponible EDITAR: "+$('.radiobtn:checked').val());
	});
}

function envioForm()
{
	event.preventDefault();
}

function mostrarEditar() 
{
	$('.editar').show();
	// document.getElementById("txtTitulo").focus();
	$('.formAjax input').focus();
}

function ocultarEditar() 
{
	$('.editar').hide();
}