<?php 
	include ('../scripts/funciones.php');	
	if( !haIniciadoSesion() )
		header('Location: estatuto.php');	
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
		<h2>Versión 2014</h2>
		<p>Última modificación: <?= getFirstValue("SELECT fecha FROM modificacion ORDER BY ID_Modificacion DESC LIMIT 1") ?></p>
	</header>
<?php
	$titulos = getTitulos();
	for($i=0; $i<sizeof($titulos); ++$i)
	{
?>
	<section class="seccion-titulo">
		<h3>Título <?= $titulos[$i][2] ?>: <?= $titulos[$i][1] ?></h3>
		<a class="link" href="fragmento.php?tit=<?= $titulos[$i][2] ?>">Imprimir</a>
<?php 
		$capitulos = getCapitulos($titulos[$i][0]);
		for($j=0; $j<sizeof($capitulos); ++$j)
		{
?>
			<article class="capitulo">
				<h4>Capítulo <?= $capitulos[$j][2] ?>: <?= $capitulos[$j][1] ?></h4>
				<a class="link" href="fragmento.php?tit=<?= $titulos[$i][2] ?>&cap=<?= $capitulos[$j][2] ?>">Imprimir</a>
				<a class="link" href="../capitulos.php?title=<?= $titulos[$i][0] ?>">Editar</a>
<?php 
			$articulos = getArticulos($capitulos[$j][0]);
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
	</section>	
<?php		
	}
?>
<!--
	<section class="seccion-titulo">
		<h3>Título: BLABLABLA</h3>
		<article class="capitulo">
			<h4>Capítulo 1: BLEBLEBLE</h4>
			<div class="articulo">
				<span>Artículo 1.</span>
				<p class="contenido">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi sed qui, dolore voluptate atque? Consequatur quas tenetur harum dolor, explicabo ullam ipsa, est commodi dolore illum vel consequuntur neque id!
				</p>
			</div>
		</article>
				<article class="capitulo">
			<h4>Capítulo 2: BLEBLEBLE</h4>
			<div class="articulo">
				<span>Artículo 1.</span>
				<p class="contenido">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi sed qui, dolore voluptate atque? Consequatur quas tenetur harum dolor, explicabo ullam ipsa, est commodi dolore illum vel consequuntur neque id!
				</p>
			</div>
			<div class="articulo">
				<span>Artículo 2.</span>
				<p class="contenido">
					Excepturi sed qui, dolore voluptate atque? Consequatur quas tenetur harum dolor, explicabo ullam ipsa, est commodi dolore illum vel consequuntur neque id!
				</p>
			</div>			
		</article>
		<article class="capitulo">
			<h4>Capítulo 3: BLEBLEBLE</h4>
			<div class="articulo">
				<span>Artículo 1.</span>
				<p class="contenido">
					Ullam ipsa, est commodi dolore illum vel consequuntur neque id!
				</p>
			</div>
			<div class="articulo">
				<span>Artículo 2.</span>
				<p class="contenido">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ullam ipsa, est commodi dolore illum vel consequuntur neque id!
				</p>
			</div>
			<div class="articulo">
				<span>Artículo 3.</span>
				<p class="contenido">
					Excepturi sed qui, dolore voluptate atque? Consequatur quas tenetur harum dolor, explicabo ullam ipsa, est commodi dolore illum vel consequuntur neque id!
				</p>
			</div>						
		</article>
	</section>
-->
</body>
</html>