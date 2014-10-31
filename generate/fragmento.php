<?php // ¡ Se reciben nros, no ids !
	include ('../scripts/funciones.php');	
	if( !haIniciadoSesion() )
		header('Location: login.php');
	if( !isset($_GET['tit']) )
		header('Location: estauto.php');
	// Inició sesión y especificó tit:
	$tit = intval($_GET['tit']);
	if( $tit<=0 )
		header('Location: ../404.html');
	else {
		if( isset($_GET['cap']) )
		{	// Si $cap es 0 mostrar TODO 1 título.
			$cap = intval($_GET['cap']);
			if($cap<0) $cap = 0;
		} else $cap = 0;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Estatuto Generado</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="estilos.css">
</head>
<body>
	<header>
		<h1>Estatuto UNT</h1>
<?php 
	if($cap==0)
	{
?>
		<h2>Fragmento: "Título <?= $tit ?>"</h2>
<?php
	} else {
?>
		<h2>Fragmento: "Capítulo <?= $cap ?> del Título <?= $tit ?>"</h2>
<?php
	}
?>
	</header>
<?php
	$idTit = getIdTitActivo($tit);
	if($idTit)
		$infoTit = getInfoTit($idTit); 
	else header('Location: ../404.html');
?>
	<section class="seccion-titulo">
		<h3>Título <?php echo $infoTit[2] ?>: <?php echo $infoTit[1] ?></h3>
<?php 
		if($cap==0)
		// So pro... It works with an array or an element.
			$capitulos = getCapitulos($idTit);
		else {
			$idCap = getIdCapActivo($cap, $tit);
			if($idCap)
				$capitulos[0] = getInfoCap($idCap);			
			else header('Location: ../404.html');
		}
		for($j=0; $j<sizeof($capitulos); ++$j)
		{
			escribirCapitulo($capitulos[$j]);
		}
?>
	</section>	


<?php 
	function escribirCapitulo($infoCap)
	{
?>
		<article class="capitulo">
			<h4>Capítulo <?php echo $infoCap[2] ?>: <?php echo $infoCap[1] ?></h4>
<?php 
			$articulos = getArticulos($infoCap[0]);
			for($k=0; $k<sizeof($articulos); ++$k)
			{
?>				
				<div class="articulo">
					<span>Artículo <?php echo $articulos[$k][2] ?>.</span>
					<p class="contenido">
						<?php echo $articulos[$k][1] ?>
					</p>
				</div>
<?php 
			}
?>
		</article>
<?php
	}
?>
</body>
</html>