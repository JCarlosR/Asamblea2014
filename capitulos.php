<?php
include ('scripts/funciones.php');

if( haIniciadoSesion() )
{
	if( isset($_GET['title']) )
	{
		$nro = intval($_GET['title']);
		if( $nro<=1 ) $nro=1;
	}
	else $nro = 1;

	$capitulos = getCapitulos( $nro );
	$infoTit = getInfoTit( $nro );
	if( empty($infoTit) )
		header('Location: 404.html');
} else header('Location: login.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Capítulos</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<?php 
		require_once 'header.php'; 
	?>
	<nav class="volver">
		<a href="titulos.php" title="Ir atrás">
			<img src="img/Volver.png" alt="Volver">
		</a>
		<label>Volver a Títulos</label>
	</nav>

	<header class="actual">
		<label>Estás en <strong>Título <span><?php echo $infoTit[2] ?></span>: "<?php echo $infoTit[1] ?>"</strong></label>
	</header>

	<nav class="menu-navegacion">
		<div class="menu-boton" id="btnAdd">
			<img src="img/agregar.png" alt="Agregar">       
			Agregar
		</div>
		<div class="menu-boton" id="btnEdit">
			<img src="img/editar.png" alt="Editar">
			Editar
		</div>		
		<a href="generate/estatuto.php" class="menu-boton" id="btnLogout">
			<img src="img/exportar.png" alt="Imprimir">
			Ver estatuto
		</a>		
	</nav>	

	<section class="editar">
		<form class="formAjax" action="">
			<label for="txtCapitulo" class="como-bloque">
				Ingrese <strong>Capítulo <span><?= sizeof($capitulos)+1 ?></span></strong>:
			</label>
			<input type="text" id="txtCapitulo" class="como-bloque">
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
	for($i=0; $i<sizeof($capitulos); ++$i)
	{
?>
		<div class="contenedor">
			<a href="articulos.php?cap=<?php echo $capitulos[$i][0] ?>">
			<input type="radio" name="grupoRbtn" value="<?= $capitulos[$i][2] ?>" class="radiobtn" />
			<img src="img/capitulo.png" alt="Capítulo" class="izquierda">
			<p class="title"><strong>Capítulo <?= $capitulos[$i][2] ?>:</strong> <?= $capitulos[$i][1] ?></p>
			</a>
		</div>
<?php 
	}
?>
<!--
		<div class="contenedor">
			<img src="img/capitulo.png" alt="Capítulo" class="izquierda">
			<p class="title">Capítulo 1: Disposiciones generales</p>
			<a href="articulos.php?cap="><img src="img/ir.png" alt="capítulo1" class="derecha"></a>
		</div>
-->
	</section>

	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<script src="js/addChapter.js"></script>
<?php
	require_once 'menu-lateral.html';
?>
</body>
</html>