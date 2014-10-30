<?php
	date_default_timezone_set('America/Lima');
	$date = date('Y-m-d h:i:s a', time());
	session_start();
	$con = mysqli_connect('localhost','root','','asamblea2014');

	// Creo 1 nueva modificación y capturo su ID:
	mysqli_query($con, "INSERT modificacion VALUES(NULL, '".$date."', '".$_SESSION['usuario']."')");
	$resultado = mysqli_query($con, "SELECT MAX(ID_Modificacion) AS id FROM modificacion");
	$ultModif = mysqli_fetch_row($resultado)[0];	

	// Consultamos el mayor numeroArt del capítulo actual
	$resultSet = mysqli_query($con, "SELECT MAX(numeroArt) FROM articulo WHERE ID_Capitulo=".$_POST['idCap']);
	$ultNroArt = mysqli_fetch_row($resultSet)[0];

	$nroCap=$_POST['nroCap'];
	$nroTit=$_POST['nroTit'];
	/*echo "SELECT MAX(ID_Titulo) FROM titulo WHERE numeroTit=".$nroTit;
	$resultSet = mysqli_query($con,"SELECT MAX(ID_Titulo) FROM titulo WHERE numeroTit=".$nroTit);
	$idTit = mysqli_fetch_row($resultSet)[0];*/

	while($ultNroArt==0 && $nroCap>0 ) // Vamos por el ultNroArt del cap anterior
		{	//echo "SELECT MAX(ID_Capitulo) FROM capitulo WHERE numeroCap=".(--$nroCap)." AND ID_Titulo=".$idTit;
			$resultSet = mysqli_query($con, "SELECT MAX(ID_Capitulo) FROM capitulo WHERE numeroCap=".(--$nroCap));
			$idCapAnterior = mysqli_fetch_row($resultSet)[0];

			$resultSet = mysqli_query($con, "SELECT MAX(numeroArt) FROM articulo WHERE ID_Capitulo=".$idCapAnterior);
			$ultNroArt=mysqli_fetch_row($resultSet)[0];		

		}
/*	do
	{
		while($ultNroArt==0 && $nroCap>0 ) // Vamos por el ultNroArt del cap anterior
		{	//echo "SELECT MAX(ID_Capitulo) FROM capitulo WHERE numeroCap=".(--$nroCap)." AND ID_Titulo=".$idTit;
			$resultSet = mysqli_query($con, "SELECT MAX(ID_Capitulo) FROM capitulo WHERE numeroCap=".(--$nroCap)." AND ID_Titulo=".$idTit);
			$idCapAnterior = mysqli_fetch_row($resultSet)[0];

			$resultSet = mysqli_query($con, "SELECT MAX(numeroArt) FROM articulo WHERE ID_Capitulo=".$idCapAnterior);
			if( empty($resultSet) )
			{
				$ultNroArt = 0;
			}
			else {
				if($fila=mysqli_fetch_row($resultSet))
					$ultNroArt = $fila[0];
				else $ultNroArt =
			} 							
		}				
		$resultSet = mysqli_query($con,"SELECT MAX(ID_Titulo) FROM titulo WHERE numeroTit=".(--$nroTit));
		$idTit = mysqli_fetch_row($resultSet)[0];
		$nroCap = mysqli_query($con,"SELECT MAX(numeroCap) FROM capitulo WHERE ID_Titulo=".$idTit);			
	} while ($ultNroArt==0 && $nroTit>0);*/ 

	++$ultNroArt; // Dado que el que vamos a agregar será el último ahora
	// Agregamos el nuevo artículo
	mysqli_query($con, "INSERT articulo VALUES(NULL, '".$_POST['contenido']."', ".$ultNroArt.", ".$ultModif.", ".$_POST['idCap'].")");

	// DBMOS AFECTAR A TODOS LOS ARTICULOS QUE TENGAN UN NROARTICULO >= AL Q ACABAMOS DE AGREGAR PERO QUE SE ENCUENTREN EN ID_CAP DIFERENTE

	// Consultamos el mayor numeroArt del capítulo actual
	$resultSet = mysqli_query($con, "UPDATE articulo SET numeroArt=numeroArt+1 WHERE numeroArt>=".$ultNroArt." AND ID_Capitulo<>".$_POST['idCap']);

?>