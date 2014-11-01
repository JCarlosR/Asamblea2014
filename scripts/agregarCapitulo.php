<?php
	include ('funciones.php');
	date_default_timezone_set('America/Lima');
	$date = date('Y-m-d h:i:s a', time());
	session_start();
	$con = mysqli_connect('localhost','root','','asamblea2014');
	// Creo 1 nueva modificación y capturo su ID:
	mysqli_query($con, "INSERT modificacion VALUES(NULL, '".$date."', '".$_SESSION['usuario']."')");
	$resultado = mysqli_query($con, "SELECT MAX(ID_Modificacion) AS id FROM modificacion");
	$ultimo = mysqli_fetch_row($resultado)[0];

	// Antes de crearlo, preguntamos si existe 1 previo (indicaría edición).
	$penUltimo = getIdCapActivo($_POST['nroCap'], $_POST['nroTit']);

	// Creo 1 nuevo capítulo y capturo su ID:
	mysqli_query($con, "INSERT capitulo VALUES(NULL, '".$_POST['descripcion']."', '".$_POST['nroCap']."', '".$ultimo."', ".$_POST['nroTit'].")");
	$resultado = mysqli_query($con, "SELECT MAX(ID_Capitulo) AS id FROM capitulo");
	$ultimo = mysqli_fetch_row($resultado)[0];
	echo $ultimo;
	// Si existía 1 previo reasignamos sus artículos hacia el nuevo:
	if($penUltimo)
		ejecutarQuery("UPDATE articulo SET ID_Capitulo=".$ultimo." WHERE ID_Capitulo=".$penUltimo);	
?>