<?php
include ('scripts/funciones.php');

if( haIniciadoSesion() )
{   // Se recibe el nroArt
    if( isset($_GET['art']) )
        $nro = intval($_GET['art']);
    else $nro = 0;
    if($nro<=0)
        header('Location: 404.html');
/*  Info capturada al cargar la página, 
    permitirá reconocer si hubo cambios mientras se editaba. */
    $idArt = getIdArtActivo( $nro );
    $infoArt = getInfoArt( $idArt );
    $artPrevios = getArtPrev( $infoArt[2] );
    $infoCap = getInfoCap( $infoArt[4] );
    $infoTit = getInfoTit( $infoCap[4] );
    if( empty($infoTit) )
        header('Location: 404.html');  
} else header('Location: login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edición de artículo</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php 
        require_once 'header.php'; 
    ?>
    <span id="idCap" style="display: none;"><?= $infoCap[0] ?></span>
    <nav class="volver">
        <a href="articulos.php?cap=<?php echo $infoCap[0] ?>" title="Ir atrás"><img src="img/Volver.png" alt="Volver" class="imgVolver"></a>
        <label>Volver a Artículos</label>
    </nav>
    <header class="actual">
        <p><strong>Título <span id="nroTit"><?= $infoTit[2] ?></span>: "<?= $infoTit[1] ?>"</strong></p>
        <p><strong>Capítulo <span id="nroCap"><?= $infoCap[2] ?></span>: "<?=$infoCap[1] ?>"</strong></p>
        <p>Artículo en edición: <strong>Artículo <span id="nroArt"><?= $infoArt[2] ?></span></strong></p>
    </header>    
    <form class="formAjax" action="">
        <p>Contenido del artículo:</p>
        <textarea id="txtContenido" class="areaRedaccion" placeholder="Escriba el contenido del artículo" cols="66" rows="21"><?= $infoArt[1] ?></textarea>

        <div id="btnGuardar" class="edicion-boton">
            <img src="img/guardar.png" alt="Guardar">
            Guardar cambios
        </div>
        <a href="articulos.php?cap=<?php echo $infoCap[0] ?>" class="edicion-boton">
            <img src="img/cancelar.png" alt="Cancelar">
            Dejar de editar        
        </a>
    </form>

    <section class="espacio-superior">
    	<table class="tablilla">
    		<thead>
    			<tr><th>
                    Últimos cambios realizados:
                </th></tr>
    		</thead>
    		<tbody>
<?php 
    for($i=0; $i<sizeof($artPrevios); ++$i)
    {   // ¿Quién? ¿Cuándo?
?>
            <tr class="tablilla-fila">
                <td>Cambio realizado por <?= $artPrevios[$i][0] ?> el <?= $artPrevios[$i][1] ?><img src="img/Link.png" alt="ver" title="Ver" class="copy<?= $i ?>"></td>
            </tr>
<?php
    }
?>
    		</tbody>
    	</table>
    </section>

    <a href="antes-articulo.php?art=<?= $nro ?>" class="edicion-boton">
        <img src="img/Ver.png" alt="Ver más" title="Ver más">
        Ver más...
    </a>

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
    $(document).on('click', asignarFuncionlidad);
    var contenidos = [];
    function asignarFuncionlidad() {
<?php 
    for($i=0; $i<sizeof($artPrevios); ++$i)
    {   // ¿Qué contenido?
?>
        contenidos[<?= $i ?>] = '<?= $artPrevios[$i][2] ?>';
        $('.copy<?= $i ?>').on('click', function(){
            $('#txtContenido').val(contenidos[<?= $i ?>]);
        });
        
<?php
    }
?>  }
    </script>
    <script src="js/editArticle.js"></script> 
</body>
</html>