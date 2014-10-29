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
    <title>Creación de un nuevo artículo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php 
        require_once 'header.php'; 
    ?>
    <span style="display: none;"><?= $infoCap[0] ?></span>
    <nav class="volver">
        <a href="articulos.php?cap=<?php echo $infoCap[0] ?>" title="Ir atrás"><img src="img/Volver.png" alt="Volver" class="imgVolver"></a>
        <label>Volver a Artículos</label>
    </nav>
    <header class="actual">
        <p>Estás creando un nuevo artículo en <strong>Título <span><?= $infoTit[2] ?></span>: "<?= $infoTit[1] ?>"</strong></p>
        <p>Específicamente en el <strong>Capítulo <span><?= $infoCap[2] ?></span>: "<?=$infoCap[1] ?>"</strong></p>
    </header>    
    <form class="formAjax" action="">
        <p>Contenido del artículo:</p>
        <textarea id="txtContenido" class="areaRedaccion" placeholder="Escriba el contenido del artículo" cols="66" rows="21"></textarea>

        <div id="btnGuardar" class="edicion-boton">
            <img src="img/guardar.png" alt="Guardar">
            Guardar
        </div>
        <a href="articulos.php?cap=<?php echo $infoCap[4] ?>" class="edicion-boton">
            <img src="img/cancelar.png" alt="Cancelar">
            Cancelar        
        </a>
    </form>
</div>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/addArticle.js"></script>    
</body>
</html>