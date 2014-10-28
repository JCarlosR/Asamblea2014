<?php
	date_default_timezone_set('America/Lima');
	$date = date('Y-m-d h:i:s a', time());
	session_start();
	$con = mysqli_connect('localhost','root','','asamblea2014');
	// Creo 1 nueva modificación y capturo su ID:
	mysqli_query($con, "INSERT modificacion VALUES(NULL, '".$date."', '".$_SESSION['usuario']."')");
	$resultado = mysqli_query($con, "SELECT MAX(ID_Modificacion) AS id FROM modificacion");
	$ultimo = mysqli_fetch_row($resultado)[0];
	// Creo 1 nuevo título y capturo su ID:
	mysqli_query($con, "INSERT titulo VALUES(NULL, '".$_POST['descripcion']."', '".$_POST['nroTit']."', '".$ultimo."')");
	$resultado = mysqli_query($con, "SELECT MAX(ID_Titulo) AS id FROM titulo");
	$ultimo = mysqli_fetch_row($resultado)[0];	
	echo $ultimo;
?>

