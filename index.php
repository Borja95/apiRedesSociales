<?php
include "db/BD.php";
include "./encabezados.php";

//Consultar
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      $consulta= "SELECT * FROM redes_sociales where id=".$_GET['id'];
      $resultado = consultaGet($consulta);  
      echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
	  }
    else {
      $consulta= "SELECT * FROM redes_sociales";
      $resultado = consultaGet($consulta);  
      echo json_encode($resultado->fetchAll());
  }
  header("HTTP/1.1 200 OK");
  exit();
}