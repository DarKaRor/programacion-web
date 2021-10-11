<?php

class Empleado{
    public $nombre, 
    $apellido,
    $departamento,
    $lugar_de_trabajo;

    private $cedula, 
    $sueldo;
    
    function __construct($n,$a,$d,$l){
        $this->nombre = $n;
        $this->apellido = $a;
        $this->departamento = $d;
        $this->lugar_de_trabajo = $l;
    }
    
    function set_cedula($cedula){
        if($cedula<=0) return false;
        $this->cedula = number_format($cedula,0,'',".");
        return true;
    }

    function set_sueldo($sueldo){
        if($sueldo<=0) return false;
        $this->sueldo = number_format((float)$sueldo, 2, '.', '');
        return true;
    }

    function get_cedula(){ return $this->cedula;}
    function get_sueldo(){return $this->sueldo;}
}

$empleados = [];
array_push($empleados,new Empleado("Luis","Fernandez","Informática","Maracaibo"));
print_r($empleados[0]);
