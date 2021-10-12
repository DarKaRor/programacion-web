<?php

require __DIR__ . '\utils.php';

# Devuelve la cédula con separador de miles. Devuelve falso si es menor o igual a 0.
function set_cedula($cedula){
    if($cedula<=0) return false;
    return  number_format($cedula,0,'',".");
}

# Devuelve el sueldo con dos puntos decimales. Devuelve falso si es menor igual a 0.
function set_sueldo($sueldo){
    if($sueldo<=0) return false;
    return format_float_two($sueldo); 
    # number_format((float)$sueldo, 2, '.', '');
}

$empleados = [];

# Nombre de claves
$nKey = "nombre";
$aKey = "apellido";
$dKey = "departamento";
$lKey = "lugar_de_trabajo";
$cKey = "cedula";
$sKey = "sueldo";
$financiamiento = "financiamiento";
$control = "control";

$cantidad = 3;

# Departamentos
$departamentos = [
   $financiamiento => [
        "Planeación financiera",
        "Relaciones financieras",
        "Tesorería",
        "Obtención de recursos",
        "Inversiones",
    ],
    $control => [
        "Contabilidad general",
        "Contabilidad de costos",
        "Presupuestos",
        "Auditoría interna",
        "Estadística",
        "Crédito y cobranza",
        "Impuestos",
    ]
];

# Inicializar variables
for($i = 0;$i<$cantidad;$i++){
    $empleado = [];
    $empleado[$nKey] = "";
    $empleado[$aKey] = "";
    $empleado[$dKey] = $departamentos[$financiamiento][0];
    $empleado[$lKey] = "Maracaibo";
    $empleado[$cKey] = 0;
    $empleado[$sKey] = 0;
    array_push($empleados,$empleado);
}

# Pasar por referencia
$empleado = &$empleados[0];

# Agregar valores
$empleado[$nKey] = "Alfredo";
$empleado[$aKey] = "Gutierrez";
$empleado[$dKey] = $departamentos[$financiamiento][0];
$empleado[$lKey] = "Maracaibo";
$cedula = set_cedula(29714201);
if($cedula) $empleado[$cKey] = $cedula;
$sueldo = set_sueldo(12312.12837129);
if($sueldo) $empleado[$sKey] = $sueldo;


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Registro de Empleados</title>
</head>
<body>
    <header>
        <h1>Registro de Empleados</h1>
        <h2>Johandry López - 29714201</h2>
    </header>
        <?php
            foreach($empleados as $empleado){
                echo " <div class=\"data\">";
                foreach($empleado as $key => $value){
                      echo "<p>".$key.": ".$value."</p>";
                }
                echo "</div>";
            }
        ?>

    <nav class="activities row center">
        <a href="../index.html">Regresar</a>
        <a href="https://github.com/DarKaRor/programacion-web/blob/master/web/php/triangulo.php">GitHub</a>
     </nav>
<body>
</html>
