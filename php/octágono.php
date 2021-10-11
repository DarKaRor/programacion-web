<?php
function calcular_area($lado){
    $perimetro = $lado*8;
    $apotema = $lado/(2*tan(deg2rad(22.5)));
    $area = ($perimetro*$apotema)/2;
    return $area;
}

echo calcular_area(1231);