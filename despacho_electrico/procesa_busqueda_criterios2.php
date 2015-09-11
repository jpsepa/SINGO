<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$fecha_inicio = $_POST["fecha_inicio"];

$categorias = $_POST["categorias"];

$km_lugar = strtoupper($_POST["km_lugar"]);
$km_lugar_2 = strtr($km_lugar, "ñáéíóú", "ÑÁÉÍÓÚ");

$den_des = strtoupper($_POST["den_des"]);

$descripcion = strtoupper($_POST["descripcion"]);
$descripcion_2 = strtr($descripcion, "ñáéíóú", "ÑÁÉÍÓÚ");

$notificador = strtoupper($_POST["notificador"]);
$notificador_2 = strtr($notificador, "ñáéíóú", "ÑÁÉÍÓÚ");

$campos = array('fecha_inicio', 'categoria', 'km_lugar', 'den_des', 'descripcion', 'notificador');
$filtros = array();
 
foreach($campos as $campo) {
      if(isset($_GET['campo'])) {
            $filtros[] = "$campo" = '%$buscar%';
      }
}
 
$consulta = "SELECT * FROM tabla WHERE " . implode(' OR ', $filtros);

?>