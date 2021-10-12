<?php

require __DIR__ . '\utils.php';

function calcular_area($lado){
    $perimetro = $lado*8;
    $apotema = $lado/(2*tan(deg2rad(22.5)));
    $area = ($perimetro*$apotema)/2;
    return $area;
}

$lado = rand(1,100);
$area = format_float_two(calcular_area($lado));
$unidad = "cm";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Cálculo de Hipotenusa</title>
    <header>
        <h1>Cálculo de hipotenusa</h1>
        <h2>Johandry López - 29714201</h2>
    </header>
    <div class="data">
        <p>Valor de los lados: <?php echo $lado." ".$unidad?></p>
        <div class="separator"></div>
        <p>Valor del área: <?php echo $area." ".$unidad."²"?></p>
        <div class="separator"></div>
    </div>
    <nav class="activities row center">
        <a href="../index.html">Regresar</a>
        <a href="https://github.com/DarKaRor/programacion-web/blob/master/web/php/triangulo.php">GitHub</a>
    </nav>
</head>
<body>
</html>