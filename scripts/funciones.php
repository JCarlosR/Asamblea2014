<?php

$conexion = null;

function abrirConex()
{
	// Conexión con el servidor de base de datos MySQL
	$GLOBALS['conexion'] = mysqli_connect('localhost','root','','asamblea2014');
	mysqli_set_charset($GLOBALS['conexion'], 'utf8');
}

function cerrarConex($result)
{
	// Cerrar conexión a la BD
	mysqli_free_result($result); 
	mysqli_close($GLOBALS['conexion']);
}

function sonDatosCorrectos($usuario, $clave) 
{	
	abrirConex();
	// Sentencia SQL para consultar el nombre del usuario
	$sql = "SELECT * FROM asambleista WHERE asamUsername='".$usuario."' AND asamPassword='".$clave."'";
	$resultado = mysqli_query($GLOBALS['conexion'], $sql);

	// Si existe, inicia 1 sesión y guarda info del usuario
	if( $fila = mysqli_fetch_row($resultado) )
	{	
		session_start();
		// Comenzamos a usar variables de sesión
		$_SESSION['usuario'] = $usuario;
		$_SESSION['nombre'] = $fila[1];
		cerrarConex($resultado);

		return true; // Indicamos que sí existe
	} 
	return false;  
}

// Para verificar que ya se ha iniciado sesión previamente
function haIniciadoSesion()
{
	// Continuar una sesión iniciada
	session_start();
	// Verificamos la existencia de la variable de sesión
	if( isset($_SESSION['usuario']) ) return true;
	return false;
}

function getTitulos()
{
	abrirConex();
	// Obtener todos los títulos (últimas modificaciones)
	global $conexion; // Para evitar escribir $GLOBALS['conexion']
	$resulSet = mysqli_query($conexion, "SELECT MAX(numeroTit) FROM titulo");
	$maxNumeroTit = mysqli_fetch_row($resulSet)[0];
	for($i=1; $i<=$maxNumeroTit; ++$i)
	{
		$resulSet = mysqli_query($conexion, "
			SELECT * FROM titulo WHERE ID_Titulo = 
			(SELECT MAX(ID_Titulo) FROM titulo WHERE numeroTit=".$i.")
		");
		$titulos[$i-1] = mysqli_fetch_row($resulSet);
	}
	
/*	$resultado = mysqli_query($GLOBALS['conexion'], "SELECT * FROM titulo ORDER BY numeroTit ASC");
	$i = 0;
	while( $fila = mysqli_fetch_row($resultado) )
	{
		$titulos[$i] = $fila; ++$i;
	}	*/
	if( !isset($titulos) ) 
		$titulos = array();

	cerrarConex($resulSet);
	return $titulos;
}

function getCapitulos($t)
{
	abrirConex();
	// Obtener todos los capítulos del título t (últimas modificaciones)
	global $conexion; // Para evitar escribir $GLOBALS['conexion']
	// AL EDITAR TÍTULOS, se crea 1 nuevo título que debería heredar los caps que apuntaban al título modificado, y quitar el apunte a ese
	$resulSet = mysqli_query($conexion, "SELECT MAX(numeroCap) FROM capitulo WHERE ID_Titulo=".$t);
	$maxNumeroCap = mysqli_fetch_row($resulSet)[0];
	for($i=1; $i<=$maxNumeroCap; ++$i)
	{
		$resulSet = mysqli_query($conexion, "
			SELECT * FROM capitulo WHERE ID_Capitulo = 
			(SELECT MAX(ID_Capitulo) FROM capitulo WHERE numeroCap=".$i." AND ID_Titulo=".$t.")
		");
		$capitulos[$i-1] = mysqli_fetch_row($resulSet);
	}

/*	$resultado = mysqli_query($GLOBALS['conexion'], "SELECT * FROM capitulo WHERE ID_Titulo=".$t." ORDER BY numeroCap ASC");
	$i = 0;
	while( $fila = mysqli_fetch_row($resultado) )
	{
		$capitulos[$i] = $fila; ++$i;
	}	*/
	if( !isset($capitulos) ) 
		$capitulos = array();

	cerrarConex($resulSet);
	return $capitulos;	
}

function getInfoTit($t)
{
	abrirConex();
	global $conexion; // Para evitar escribir $GLOBALS['conexion']
	$resultado = mysqli_query($conexion, "SELECT * FROM titulo WHERE ID_Titulo=".$t);
	$fila = mysqli_fetch_row($resultado);
	cerrarConex($resultado);
	return $fila;
}

function getArticulos($c)
{
	abrirConex();
	global $conexion; // Para evitar escribir $GLOBALS['conexion']
	$resulSet = mysqli_query($conexion, "SELECT MAX(numeroArt) FROM articulo WHERE ID_Capitulo=".$c);
	$maxNumeroArt = mysqli_fetch_row($resulSet)[0];
	for($i=1; $i<=$maxNumeroArt; ++$i)
	{
		$resulSet = mysqli_query($conexion, "
			SELECT * FROM articulo WHERE ID_Articulo =  
			(SELECT MAX(ID_Articulo) FROM articulo WHERE numeroArt=".$i." AND ID_Capitulo=".$c.")
		");
		$articulos[$i-1] = mysqli_fetch_row($resulSet);
	}

/*	$resultado = mysqli_query($GLOBALS['conexion'], "SELECT * FROM articulo WHERE ID_Capitulo=".$c." ORDER BY numeroArt ASC");
	$i = 0;
	while( $fila = mysqli_fetch_row($resultado) )
	{
		$articulos[$i] = $fila; ++$i;
	}	*/
	if( !isset($articulos) ) 
		$articulos = array();

	cerrarConex($resulSet);
	return $articulos;	
}

function getInfoCap($c)
{
	abrirConex();
	$resultado = mysqli_query($GLOBALS['conexion'], "SELECT * FROM capitulo WHERE ID_Capitulo=".$c);
	$fila = mysqli_fetch_row($resultado);
	cerrarConex($resultado);
	return $fila;
}

?>