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
	<nav class="volver">
		<a href="titulos.php" title="ir atrás"><img src="img/Volver.png" alt="Volver" class="imgVolver"></a>
		<label>Volver a Títulos</label>
	</nav>

	<header class="actual">
		<label>Estás en <strong>Título <span><?php echo $infoTit[2] ?></span>: "<?php echo $infoTit[1] ?>"</strong></label>
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
	</nav>	

	<section class="editar">
		<form action="#">
			<label for="txtCapitulo" class="como-bloque">
				Ingrese <strong>Capítulo <span><?= sizeof($capitulos)+1 ?></span></strong>:
			</label>
			<input type="text" id="txtCapitulo" class="como-bloque" onkeyup="javascript:this.value=this.value.toUpperCase();">
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
	for($i=0; $i<sizeof($capitulos); ++$i)
	{
?>
		<div class="contenedor">
			<img src="img/capitulo.png" alt="Capítulo" class="izquierda">
			<p class="title"><strong>Capítulo <?= $capitulos[$i][2] ?>:</strong> <?= $capitulos[$i][1] ?></p>
			<a href="articulos.php?cap=<?php echo $capitulos[$i][0] ?>"><img src="img/ir.png" alt="capítulo1" class="derecha"></a>
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
</body>
</html>