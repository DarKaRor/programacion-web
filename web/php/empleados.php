<?php

$empleados = [];

# Nombre de claves
$nKey = "nombre";
$aKey = "apellido";
$dKey = "departamento";
$lKey = "lugar_de_trabajo";
$cKey = "cedula";
$sKey = "sueldo";

$cantidad = 3;
$error = FALSE;
$errorMessage = "";
$posted = FALSE;

// Retorna un número redondeado a dos puntos decimales.
function format_float_two($n){
    return number_format((float)$n, 2, '.', '')."$";
 }

# Devuelve la cédula con separador de miles. Devuelve falso si es menor o igual a 0.
function set_cedula($cedula,$empleados = []){
    if($cedula<=0) return FALSE;
    $cedula = number_format($cedula,0,'',".");
    return  $cedula;
}

# Devuelve el sueldo con dos puntos decimales. Devuelve falso si es menor igual a 0.
function set_sueldo($sueldo){
    if($sueldo<=0) return FALSE;
    return format_float_two($sueldo); 
}

# Departamentos
$departamentos = [
"Planeación financiera",
"Relaciones financieras",
"Tesorería",
"Obtención de recursos",
"Inversiones",
"Contabilidad general",
"Contabilidad de costos",
"Presupuestos",
"Auditoría interna",
"Estadística",
"Crédito y cobranza",
"Impuestos",
];

# Inicializar variables
for($i = 0;$i<$cantidad;$i++){
    $empleado = [];
    $empleado[$nKey] = "";
    $empleado[$aKey] = "";
    $empleado[$dKey] = $departamentos[0];
    $empleado[$lKey] = "Maracaibo";
    $empleado[$cKey] = 0;
    $empleado[$sKey] = 0;
    array_push($empleados,$empleado);
}

function form_component($i){
    global $aKey,$cKey,$dKey,$lKey,$nKey,$sKey,$departamentos;
    $num = $i+1;
    $empleado = "empleados[{$i}]";
    $component = "";
    $component.="
        <div class='empleado'>
        <h3>Empleado {$num}:</h3>
        <div class='two'>
            <div class='chained'>
                <label for='Nombre{$i}'> Nombre</label>
                <input type=text required id='Nombre{$i}' name={$empleado}[{$nKey}]/>
            </div>
            <div class='chained'>
                <label for='Apellido{$i}'> Apellido</label>
                <input type=text required id='Apellido{$i}' name={$empleado}[{$aKey}]/>
            </div>
        </div>
        <div class='two'>
            <div class='chained'>
                <label for='Cedula{$i}'> Cédula</label>
                <input type=number min=1 id='Cedula{$i}' required name={$empleado}[$cKey]/>
            </div>
            <div class='chained'>
                <label for='Sueldo{$i}'> Sueldo</label>
                <input type=number min=1 id='Sueldo{$i}' required name={$empleado}[$sKey]/>
            </div>
        </div>
        <label for='Departamento{$i}'> Departamento</label>";
    $component.=drop_down_component($departamentos,"{$empleado}[$dKey]",$i);
    $component.="
        <label for='Lugar{$i}'> Lugar de trabajo</label>
        <input type=text required id='Lugar{$i}' name={$empleado}[$lKey]/>
        </div>";
        
    return $component;
}

function drop_down_component($items,$name,$index){
    $component = "";
    $component.= "<select type=text id='Departamento{$index}' required name={$name}>";
    for($i = 0;$i<count($items);$i++) $component.="<option value=\"{$items[$i]}\">{$items[$i]}</option>";
    $component.= "</select>";
    return $component;
}

if($_SERVER["REQUEST_METHOD"]==="POST"){
    //print_r($_POST['empleados']);
    $holder_empleados = $_POST['empleados'];
    global $error,$errorMessage,$posted;
    $cedulas = [];
    $error = FALSE;
    $errorMessage = "";
    for($i = 0;$i<count($holder_empleados);$i++){
        $current = &$holder_empleados[$i];
        $cedula = $current[$cKey];
        $current[$cKey] = set_cedula($current[$cKey]);
        $current[$sKey] = set_sueldo($current[$sKey]);
        
        array_push($cedulas,[$i,$cedula]);
        for($j = 0;$j<count($cedulas);$j++){
            if($cedulas[$j][1] == $cedula && $cedulas[$j][0]!=$i){
                $error = TRUE;
                $errorMessage = "No pueden existir dos cédulas iguales";
                break;
            }
        }
    }
    
    if(!$error) 
    {   
        $posted = TRUE;
        $empleados = $holder_empleados;
    }

}


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
        <?php if($error) :?>
            <div class="error">
                <p><?php echo $errorMessage ?></p>
            </div>
        <?php endif; ?>
        <?php if($posted) :?>
        <div class="data">
        <?php for($i=0;$i<$cantidad;$i++){
                $num = $i+1;
                echo "<h3> Empleado {$num}</h3>";
            foreach($empleados[$i] as $key => $value){
                $title = str_replace("_"," ",$key);
                $title = ucfirst($title);
                echo "<p>{$title} : {$value}</p>";
            }
            echo "<div class='separator'></div>";
        } ?>
        </div>
        <?php else : ?>
        <form action="" method="post" class="empleados">
        <?php for($i=0;$i<$cantidad;$i++) 
            echo form_component($i);
        ?>
        <input type=submit />
        </form>
        <?php endif; ?>
        
    <nav class="activities row center">
        <a href="../index.html">Regresar</a>
        <a href="https://github.com/DarKaRor/programacion-web/blob/master/web/php/empleados.php">GitHub</a>
     </nav>
</body>
</html>
