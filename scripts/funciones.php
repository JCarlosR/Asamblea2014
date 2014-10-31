<?php

$conexion = null;

function abrirConex()
{
	global $conexion;
	// Conexión con el servidor de base de datos MySQL
	$conexion = mysqli_connect('localhost','root','','asamblea2014');
	mysqli_set_charset($conexion, 'utf8');
}

function cerrarConex($result='')
{
	if($result!='')
		mysqli_free_result($result); 

	// Cerrar conexión a la BD
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
	
	if( !isset($titulos) ) 
		$titulos = array();

	cerrarConex($resulSet);
	return $titulos;
}

function getCapitulos($idTit)
{
	abrirConex();
	// Obtener todos los capítulos del título t (últimas modificaciones)
	global $conexion; // Para evitar escribir $GLOBALS['conexion']
	// AL EDITAR TÍTULOS, se crea 1 nuevo título que debería heredar los caps que apuntaban al título modificado, y quitar el apunte a ese
	$resulSet = mysqli_query($conexion, "SELECT MAX(numeroCap) FROM capitulo WHERE ID_Titulo=".$idTit);
	$maxNumeroCap = mysqli_fetch_row($resulSet)[0];
	for($i=1; $i<=$maxNumeroCap; ++$i)
	{
		$resulSet = mysqli_query($conexion, "
			SELECT * FROM capitulo WHERE ID_Capitulo = 
			(SELECT MAX(ID_Capitulo) FROM capitulo WHERE numeroCap=".$i." AND ID_Titulo=".$idTit.")
		");
		$capitulos[$i-1] = mysqli_fetch_row($resulSet);
	}

	if( !isset($capitulos) ) 
		$capitulos = array();

	cerrarConex($resulSet);
	return $capitulos;	
}

function getInfoTit($idTit)
{
	abrirConex();
	global $conexion; // Para evitar escribir $GLOBALS['conexion']
	$resultado = mysqli_query($conexion, "SELECT * FROM titulo WHERE ID_Titulo=".$idTit);
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
	$j = 0;
	for($i=1; $i<=$maxNumeroArt; ++$i)
	{
		$resulSet = mysqli_query($conexion, "
			SELECT * FROM articulo WHERE ID_Articulo =  
			(SELECT MAX(ID_Articulo) FROM articulo WHERE numeroArt=".$i." AND ID_Capitulo=".$c.")
		");
		if( $fila = mysqli_fetch_row($resulSet) )
			$articulos[$j++] = $fila;
	}

	if( !isset($articulos) ) 
		$articulos = array();

	cerrarConex($resulSet);
	return $articulos;	
}

function getInfoCap($idCap)
{
	global $conexion;
	abrirConex();
	$resultado = mysqli_query($conexion, "SELECT * FROM capitulo WHERE ID_Capitulo=".$idCap);
	$fila = mysqli_fetch_row($resultado);
	cerrarConex($resultado);
	return $fila;
}

/* FUNCIONES UTILITARIAS */

function ejecutarQuery($query)
{
	global $conexion;
	abrirConex();
	mysqli_query($conexion, $query);
	cerrarConex();
}

function getResultSet($query)
{
	global $conexion;
	abrirConex();
	$resultSet = mysqli_query($conexion, $query);
	cerrarConex();
	return $resultSet;
}

function getFirstRow($query)
{
	return mysqli_fetch_row( getResultSet($query) );
}

function getFirstValue($query)
{
	return getFirstRow($query)[0];		
}

/* ÚLTIMO NRO DE TIT, ART */

function getMaxNroTit()
{
	return getFirstValue("SELECT MAX(numeroTit) FROM titulo");	
}

function getMaxNroArt($idCap)
{
	return getFirstValue("SELECT MAX(numeroArt) FROM articulo WHERE ID_Capitulo=".$idCap);
}

/* ÚLTIMA VERSIÓN PARA UN NRO DETERMINADO */

function getIdTitActivo($nroTit)
{
	return getFirstValue("SELECT MAX(ID_Titulo) FROM titulo WHERE numeroTit=".$nroTit);	
}

function getIdCapActivo($nroCap, $nroTit)
{
	$idTit = getIdTitActivo($nroTit);
	return getFirstValue("SELECT MAX(ID_Capitulo) FROM capitulo WHERE numeroCap=".$nroCap." AND ID_Titulo=".$idTit);	
}

function getIdArtActivo($nroArt, $nroCap, $nroTit)
{
	$idCap = getIdCapActivo($nroCap, $nroTit);
	return getFirstValue("SELECT MAX(ID_Articulo) FROM articulo WHERE numeroArt=".$nroArt." AND ID_Capitulo=".$idCap);		
}

/* OBTENER AGREGADOS RIGHT NOW */

function getLastTit()
{
	return getFirstValue("SELECT MAX(ID_Titulo) FROM titulo");
}


?>