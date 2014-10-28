<?php
include ('scripts/funciones.php');

if( haIniciadoSesion() )
{
	$nro = intval($_GET['cap']);
	if( $nro<=1 ) $nro=1;

	$articulos = getArticulos( $nro );
	$infoCap = getInfoCap( $nro );
	$infoTit = getInfoTit( $infoCap[4] );
} else header('Location: login.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Artículos</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<nav class="volver">
		<a href="capitulos.php?title=<?php echo $infoCap[4] ?>" title="Ir atrás"><img src="img/Volver.png" alt="Volver" class="imgVolver"></a>
		<label>Volver a Capítulos</label>
	</nav>

	<header class="actual">
		<p>Estás en <strong>Título <?= $infoTit[2] ?>: "<?= $infoTit[1] ?>"</strong></p>
		<p>Específicamente en <strong>Capítulo <?= $infoCap[2] ?>: "<?=$infoCap[1] ?>"</strong></p>
	</header>

	<nav class="menu-navegacion espacio-superior">
		<a href="EditionArticle1.html" class="botones"><img src="img/agregar.png" alt="Agregar">Agregar</a>
		<a href="EditionArticle2.html" class="botones"><img src="img/editar.png" alt="Editar">Editar</a>
	</nav>
	
	<section class="seccion-titulos">
<?php 
	for($i=0; $i<sizeof($articulos); ++$i)
	{
?>
		<div class="contenedor">
			<img src="img/documento.png" alt="Articulo" class="izquierda">
			<p class="title"><strong>Artículo <?= $articulos[$i][2] ?>:</strong> <?= $articulos[$i][1] ?></p>
			<a href="#"><img src="img/ir.png" alt="titulo1" class="derecha"></a>
		</div>		
<?php 
	}
?>
	</section>
<!--	<div class="contenedor">
			<img src="img/documento.png" alt="Titulo" class="imgOK">
			<p class="title">Artículo 1 : Disposiciones generales</p>
			<a href="#"><img src="img/ir.png" alt="titulo1" class="imgOK"></a>
		</div> -->
		
	
	
	<script src="js/jquery.js"></script>
</body>
</html>