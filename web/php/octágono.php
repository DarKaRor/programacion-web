<?php

// Retorna un número redondeado a dos puntos decimales.
function format_float_two($n){
    return number_format((float)$n, 2, '.', '');
 }

function calcular_area($lado){
    $perimetro = $lado*8;
    $apotema = $lado/(2*tan(deg2rad(22.5)));
    $area = ($perimetro*$apotema)/2;
    return $area;
}

$lado = rand(0,100);
$area = format_float_two(calcular_area($lado));
$unidad = "cm";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
     $lado = $_POST['lado'];
     $area = format_float_two(calcular_area($lado));
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Cálculo de Hipotenusa</title>
</head>
</body>
<header>
        <h1>Cálculo de hipotenusa</h1>
        <h2>Johandry López - 29714201</h2>
    </header>
    <div class="data">
        <form action="octágono.php" onsubmit="return false" method="post">
            <p>Ingrese el valor del lado</p>
            <input type="number" required name="lado" id="lado" min="1" value="<?php echo $lado ?>"/>
            <input type="submit" name="submit" value="Aceptar"/>
        </form>
        <p>Valor de los lados: <?php echo $lado." ".$unidad?></p>
        <div class="separator"></div>
        <p>Valor del área: <?php echo $area." ".$unidad."²"?></p>
        <div class="separator"></div>
    </div>
    <nav class="activities row center">
        <a href="../index.html">Regresar</a>
        <a href="https://github.com/DarKaRor/programacion-web/blob/master/web/php/octágono.php">GitHub</a>
    </nav>
<script>
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<body>

</html>