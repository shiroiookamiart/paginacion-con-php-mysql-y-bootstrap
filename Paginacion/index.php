<?php

include "./app/models/Conex.php";
include "./app/models/cls_paginador.php";

class Index extends Conex{
    
    public function __construct() {
        $this->conectar();
        $this->cargarInterface();
    }
    
    public function cargarInterface(){
        $pagesize = 2;
        $start_record = (!empty($_GET['pg']))? (($_GET['pg'] * $pagesize) - $pagesize) : 0;
        $datos = $this->getDatos($pagesize, $start_record);
        $valor = $this->getTodosRegistros();
        $pagi = new Paginator($valor, $pagesize);
        include "./app/template/paginacion.php";
    }

}

new Index();