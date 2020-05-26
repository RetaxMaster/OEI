<?php

class Conexion extends mysqli
{

  public function __construct()
  {
    parent::__construct("localhost","root","","oei");
    $this->query("SET NAMES 'utf8'");
    $this->connect_errno ? die("No se conecto") : $x="Conectado";
    //echo $x;
    unset($x);
  }

  public function recorrer($y){
    return mysqli_fetch_array($y);
  }

  public function filas($y){
    return mysqli_num_rows($y);
  }
}


 ?>
