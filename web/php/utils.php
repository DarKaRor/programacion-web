<?php

// Retorna un número redondeado a dos puntos decimales.
function format_float_two($n){
   return number_format((float)$n, 2, '.', '');
}

?>