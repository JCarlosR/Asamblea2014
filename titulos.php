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
	<header>
		<h1>Asamblea2014</h1>
	</header>
	
	<nav class="menu-navegacion">
		<a href="#" class="botones" id="btnAdd">
			<img src="img/agregar.png" alt="Agregar">
			Agregar
		</a>
		<a href="#" class="botones" id="btnEdit">
			<img src="img/editar.png" alt="Editar">
			Editar
		</a>
		<a href="scripts/cerrar-sesion.php" class="botones" id="btnLogout">
			<img src="img/cerrar.png" alt="Registrarse">
			Cerrar sesión
		</a>
	</nav>

	<section class="editar">
		<form action="#">
			<label for="txtTitulo" class="como-bloque">
				Ingrese <strong>Título <span><?= sizeof($titulos)+1 ?></span></strong>:
			</label>
			<input type="text" id="txtTitulo" class="como-bloque" onkeyup="javascript:this.value=this.value.toUpperCase();">
			<a href="#" class="botones" id="btnAccept">
				<img src="img/aceptar.png" alt="Aceptar">
				Aceptar
			</a>
			<a href="#" class="botones" id="btnCancel">
				<img src="img/cancelar.png" alt="Cancelar">
				Cancelar
			</a>			
		</form>
	</section>

	<section class="seccion-titulos">
<?php
	for($i=0; $i<sizeof($titulos); ++$i)
	{
?>
	<div class="contenedor">
		<img src="img/titulo.png" alt="Titulo" class="izquierda">
		<p class="title"><strong>Título <?= $titulos[$i][2] ?>:</strong> <?= $titulos[$i][1] ?></p>
		<a href="capitulos.php?title=<?php echo $titulos[$i][0] ?>">
			<img src="img/ir.png" alt="Título 1" class="derecha">
		</a>
	</div>	
<?php
	}
?>
<!--		
	<div class="contenedor">
		<img src="img/titulo.png" alt="Titulo" class="imgOK">
		<p class="title">Título 1: Disposiciones generales</p>
		<a href="capitulos.html"><img src="img/ir.png" alt="titulo1" class="imgOK"></a>
	</div>
-->			
	</section>
	
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<script src="js/addTitles.js"></script>
</body>
</html>