<?php
include ('scripts/funciones.php');

if( haIniciadoSesion() )
{
	if( isset($_GET['cap']) )
	{
		$nro = intval($_GET['cap']);
		if( $nro<=1 ) $nro=1;
	}
	else $nro = 1;

	$articulos = getArticulos( $nro );
	$infoCap = getInfoCap( $nro );
	$infoTit = getInfoTit( $infoCap[4] );
	if( empty($infoTit) )
		header('Location: 404.html');	
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
	<?php 
		require_once 'header.php'; 
	?>
	<nav class="volver">
		<a href="capitulos.php?title=<?php echo $infoCap[4] ?>" title="Ir atrás"><img src="img/Volver.png" alt="Volver" class="imgVolver"></a>
		<label>Volver a Capítulos</label>
	</nav>

	<header class="actual">
		<p>Estás en <strong>Título <?= $infoTit[2] ?>: "<?= $infoTit[1] ?>"</strong></p>
		<p>Específicamente en <strong>Capítulo <?= $infoCap[2] ?>: "<?=$infoCap[1] ?>"</strong></p>
	</header>

	<nav class="menu-navegacion">
		<a href="nuevoArt.php?cap=<?= $nro ?>" class="menu-boton">
			<img src="img/agregar.png" alt="Agregar">Agregar
		</a>
		<div class="menu-boton" id="btnEdit">
			<img src="img/editar.png" alt="Editar">Editar
		</div>
		<a href="generate/estatuto-edicion.php" class="menu-boton" id="btnLogout">
			<img src="img/exportar.png" alt="Imprimir">
			Ver estatuto
		</a>		
	</nav>
	
	<section class="seccion-titulos">
<?php 
	for($i=0; $i<sizeof($articulos); ++$i)
	{
?>
		<div class="contenedor">
			<input type="radio" name="grupoRbtn" value="<?= $articulos[$i][2] ?>" class="radiobtn" />
			<img src="img/documento.png" alt="Artículo" class="izquierda">
			<p class="title"><strong>Artículo <?= $articulos[$i][2] ?>:</strong> <?= substr($articulos[$i][1],0,71)." ..." ?></p>
		</div>		
<?php 
	}
	
?>
	</section>
	
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<script>
	$('#btnEdit').on('click', redirigir);
	function redirigir() 
	{
		nroArt = $('.radiobtn:checked').val();
		location.href = 'modificarArt.php?art='+nroArt;
	}
	</script>
<?php 
	require_once 'menu-lateral.html';
?>
</body>
</html>