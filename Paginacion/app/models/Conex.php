<?php
define('HOST','127.0.0.1'); 
define('USER','root');
define('PASS','123456');
define('DBNAME','prueba');

class Conex
{
    protected $conexion;
    protected $db;
 
    public function conectar()
    {
        $this->conexion = mysql_connect(HOST, USER, PASS);
        if ($this->conexion == 0) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error());
        $this->db = mysql_select_db(DBNAME, $this->conexion);
        if ($this->db == 0) DIE("Lo sentimos, no se ha podido conectar con la base datos: " . DBNAME);
 
        return true;
 
    }
 
    public function desconectar()
    {
        if ($this->conectar->conexion) {
            mysql_close($this->$conexion);
        }
 
    }
 
    public function getTodosRegistros(){
        $sql = "Select count(*) as cantidad from algo";
        $result = mysql_query($sql, $this->conexion);
        $cont = 0;
        $row = mysql_fetch_array($result);
        $cont = $row["cantidad"];
        return $cont;
    }
    
    public function getDatos($limit, $offset){
        $sql = "Select * from algo LIMIT ".$limit." OFFSET ".$offset;
        $result = mysql_query($sql, $this->conexion);
        return $result; 
    }
}

