<?php
include ('scripts/funciones.php');

if( haIniciadoSesion() )
	$titulos = getTitulos();
else 
	header('Location: login.php');
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Títulos</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<?php 
		require_once 'header.php'; 
	?>
	<nav class="menu-navegacion">
		<div class="menu-boton" id="btnAdd">
			<img src="img/agregar.png" alt="Agregar">
			Agregar
		</div>
		<div class="menu-boton" id="btnEdit">
			<img src="img/editar.png" alt="Editar">
			Editar
		</div>
		<a href="generate/estatuto-edicion.php" class="menu-boton" id="btnLogout">
			<img src="img/exportar.png" alt="Imprimir">
			Ver estatuto
		</a>
		<a href="scripts/cerrar-sesion.php" class="menu-boton" id="btnLogout">
			<img src="img/cerrar.png" alt="Registrarse">
			Cerrar sesión
		</a>
	</nav>

	<section class="editar">
		<form class="formAjax" action="">
			<label for="txtTitulo" class="como-bloque">
				Ingrese <strong>Título <span><?= sizeof($titulos)+1 ?></span></strong>:
			</label>
			<input type="text" id="txtTitulo" class="como-bloque">
			<div class="edicion-boton" id="btnAccept">
				<img src="img/aceptar.png" alt="Aceptar">
				Aceptar
			</div>
			<div class="edicion-boton" id="btnCancel">
				<img src="img/cancelar.png" alt="Cancelar">
				Cancelar
			</div>			
		</form>
	</section>

	<section class="seccion-titulos">
<?php
	for($i=0; $i<sizeof($titulos); ++$i)
	{
?>
	<div class="contenedor">
		<a href="capitulos.php?title=<?php echo $titulos[$i][0] ?>">
			<input type="radio" name="grupoRbtn" value="<?= $titulos[$i][2] ?>" class="radiobtn" />
			<img src="img/titulo.png" alt="Título" class="izquierda">
			<p class="title"><strong>Título <?= $titulos[$i][2] ?>:</strong> <?= $titulos[$i][1] ?></p>
		</a>
	</div>	
<?php
	}
?>
	</section>
	
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<script src="js/addTitle.js"></script>
	<?php require_once 'menu-lateral.html'; ?>
</body>
</html>