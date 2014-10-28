<?php
include ('funciones.php');
if( haIniciadoSesion() )
{
	// Se eliminan los valores, se destruye la sesión y volvemos
	session_unset();
	session_destroy();
} 
// Si el usuario intenta cerrar sin iniciar ...
header('Location: ../login.php');
?>
