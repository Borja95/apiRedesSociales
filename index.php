<?php
include "db/BD.php";
include "./encabezados.php";

//Consultar
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
      $consulta= "use heroku_c8381f705ba64e3; SELECT * FROM redes_sociales";
      $resultado = consultaGet($consulta);  
      echo json_encode($resultado->fetchAll());
  header("HTTP/1.1 200 OK");
  exit();
}
