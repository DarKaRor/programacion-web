<?php

# Devuelve la cédula con separador de miles. Devuelve falso si es menor o igual a 0.
function set_cedula($cedula){
    if($cedula<=0) return false;
    return  number_format($cedula,0,'',".");
}

# Devuelve el sueldo con dos puntos decimales. Devuelve falso si es menor igual a 0.
function set_sueldo($sueldo){
    if($sueldo<=0) return false;
    return number_format((float)$sueldo, 2, '.', '');
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

foreach($empleados as $empleado){
    foreach($empleado as $key => $value){
          echo $key.": ".$value."\n";
    }
    echo "\n\n";
}
