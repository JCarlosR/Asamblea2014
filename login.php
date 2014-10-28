<?php
include ('scripts/funciones.php');

if( haIniciadoSesion() )
	header('Location: titulos.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Asamblea 2014</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<header>
		<h1>Bienvenid@s a Asamblea2014 Software</h1>
		<img src="img/unt_logo.png" alt="Logo Asamblea" title="Logo UNT">
	</header>

	<form action="scripts/iniciar-sesion.php" method="POST">
		<label for="txtUser" class="como-bloque">
			Nombre de usuario:
		</label>
		<input type="text" name="txtUser">	

		<label for="txtPass" class="como-bloque">
			Contraseña:
		</label>
		<input type="password" name="txtPass">

		<button class="edicion-boton como-bloque" onclick="document.forms[0].submit()">
			<img src="img/iniciar.png" alt="Iniciar sesión">
			Iniciar sesión
		</button>
	</form>
	
	<script src="js/jquery.js"></script>
</body>
</html>