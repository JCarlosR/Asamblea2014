<header class="encabezado">
	<h1 class="encabezado-titulo">
		<a href="titulos.php">
			Asamblea2014
		</a>
	</h1>
	<a href="scripts/cerrar-sesion.php" class="logout">
		<img src="img/cerrar.png" title="Cerrar sesión">
	</a>		
	<p class="encabezado-profile">Usted está identificado como <strong><?= $_SESSION['nombre'] ?></strong>.</p>
</header>