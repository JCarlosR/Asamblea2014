<?php
include ('funciones.php');

// Pasados por formulario:
$usuario = $_POST['txtUser'];
$clave = $_POST['txtPass'];

// Usamos las funciones de funciones.php
if( sonDatosCorrectos($usuario, $clave) )
{
	// Accedemos a titulos.php
	header('Location: ../titulos.php');
} else {
	// Sino volvemos al formulario inicial
?>
	<script>
	alert('Los datos ingresados son incorrectos.')
	location.href = "../login.php";
	</script>
<?php
}
?>