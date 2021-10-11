<?php 
function calcular_hipotenusa($a,$b){
    return sqrt(pow($a,2) + pow($b,2));
}
$lado_a = 3;
$lado_b = 4;
$unidad = "cm";
$hipotenusa = calcular_hipotenusa($lado_a,$lado_b);
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
        <p>Lado a: <?php echo $lado_a." ".$unidad?></p>
        <div class="separator"></div>
        <p>Lado b: <?php echo $lado_b." ".$unidad?></p>
        <div class="separator"></div>
        <p>Valor de la hipotenusa: <?php echo $hipotenusa." ".$unidad?></p>
        <div class="separator"></div>
    </div>
    <nav class="activities row center">
        <a href="../index.html">Regresar</a>
        <a href="https://github.com/DarKaRor/programacion-web/blob/master/web/php/triangulo.php">GitHub</a>
     </nav>
</head>
<body>
</html>