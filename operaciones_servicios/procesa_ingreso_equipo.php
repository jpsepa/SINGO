<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$fecha_ingreso = $_POST["fecha_ingreso"];

$hora_ingreso = $_POST["hora_ingreso"];

$motivo_ingreso = $_POST["motivo_ingreso"];

$tipo_equipo = $_POST["tipo_equipo"];

$lugar = strtoupper($_POST["lugar"]);
$lugar2 = strtr($lugar, "ñáéíóú", "ÑÁÉÍÓÚ");

$descripcion_falla = strtoupper($_POST["descripcion_falla"]);
$descripcion_falla2 = strtr($descripcion_falla, "ñáéíóú", "ÑÁÉÍÓÚ");

$numero_equipo = $_POST["numero_equipo"];

$subcategoria = $_POST["subcategoria"];

$usuario = $_SESSION["nombre"]." ".$_SESSION["apellido_pat"];

$fecha_sistema = date("Y-m-d G:m:s");

mysqli_query($link, "INSERT INTO operaciones_ingresos(id_falla, id_subcategoria, descripcion_falla, lugar, fecha_ingreso, hora_ingreso, tipo_equipo, numero_equipo, usuario, fecha_sistema) VALUES ('$motivo_ingreso', '$subcategoria', '".utf8_decode($descripcion_falla2)."', '".utf8_decode($lugar2)."', '$fecha_ingreso', '$hora_ingreso', '$tipo_equipo', '$numero_equipo', '$usuario', '$fecha_sistema')");

header("Location: ingreso_equipo.php?ingreso=exitoso");

mysqli_close($link); // Cerramos la conexion con la base de datos

?>