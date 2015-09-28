<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$id = $_POST["id"];

$fecha_egreso = $_POST["fecha_egreso"];

$hora_egreso = $_POST["hora_egreso"];

mysqli_query($link, "UPDATE operaciones_ingresos SET fecha_egreso='$fecha_egreso', hora_egreso='$hora_egreso' WHERE id='$id'");

header("Location: ingreso_equipo.php?ingreso=retiro");

mysqli_close($link); // Cerramos la conexion con la base de datos

?>