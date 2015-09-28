<?php

error_reporting(E_ERROR);

include "config.php";

$link = Conectarse();

mysql_query("SET NAMES 'utf8'");

session_start();

date_default_timezone_set("America/Santiago");

$desde_fecha = $_POST["desde_fecha"];
$desde_hora = $_POST["desde_hora"];
$hasta_fecha = $_POST["hasta_fecha"];
$hasta_hora = $_POST["hasta_hora"];

$block = utf8_decode($_POST["block"]);
$block_2 = strtoupper($block);
$block_3 = strtr($block_2, "áéíóú", "ÁÉÍÓÚ");

$tipo = utf8_decode($_POST["tipo"]);
$tipo_2 = strtoupper($tipo);
$tipo_3 = strtr($tipo_2, "áéíóú", "ÁÉÍÓÚ");

$circulacion_trenes = utf8_decode($_POST["circulacion_trenes"]);
$circulacion_trenes_2 = strtoupper($circulacion_trenes);
$circulacion_trenes_3 = strtr($circulacion_trenes_2, "áéíóú", "ÁÉÍÓÚ");

$vias = utf8_decode($_POST["vias"]);
$vias_2 = strtoupper($vias);
$vias_3 = strtr($vias_2, "áéíóú", "ÁÉÍÓÚ");

$desde_sector = utf8_decode($_POST["desde_sector"]);
$desde_sector_2 = strtoupper($desde_sector);
$desde_sector_3 = strtr($desde_sector_2, "áéíóú", "ÁÉÍÓÚ");

$hasta_sector = utf8_decode($_POST["hasta_sector"]);
$hasta_sector_2 = strtoupper($hasta_sector);
$hasta_sector_3 = strtr($hasta_sector_2, "áéíóú", "ÁÉÍÓÚ");

$empresa = utf8_decode($_POST["empresa"]);
$empresa_2 = strtoupper($empresa);
$empresa_3 = strtr($empresa_2, "áéíóú", "ÁÉÍÓÚ");

$encargados = utf8_decode($_POST["encargados"]);
$encargados_2 = strtoupper($encargados);
$encargados_3 = strtr($encargados_2, "áéíóú", "ÁÉÍÓÚ");

$telefonos = utf8_decode($_POST["telefonos"]);
$telefonos_2 = strtoupper($telefonos);
$telefonos_3 = strtr($telefonos_2, "áéíóú", "ÁÉÍÓÚ");

$descripcion = utf8_decode($_POST["descripcion"]);
$descripcion_2 = strtoupper($descripcion);
$descripcion_3 = strtr($descripcion_2, "áéíóú", "ÁÉÍÓÚ");

$despachador = $_SESSION['nombre']." ".$_SESSION['apellido_pat'];
$despachador_2=strtoupper($despachador);
$despachador_3 = strtr($despachador_2, "áéíóú", "ÁÉÍÓÚ");

$aprobacion = $_POST["aprobacion"];

$fecha_ingreso = date("Y-m-d G:i:s");

if($desde_fecha == "" or $desde_hora == "" or $hasta_fecha == "" or $hasta_hora == "" or $block == "" or $tipo == "" or $circulacion_trenes == "" or $vias == "" or $empresa == "" or $encargados == "" or $telefonos == "" or $descripcion == "")
{
	header("Location: cargar_solicitud_error.php");

}else{

	mysqli_query($link, "INSERT INTO despacho_solicitud(desde_fecha, desde_hora, hasta_fecha, hasta_hora, block, tipo, circulacion_trenes, vias, desde_sector, hasta_sector, empresa, encargados, telefonos, descripcion, aprobacion, fecha_ingreso, despachador, estado)
		VALUES ('$desde_fecha', '$desde_hora', '$hasta_fecha', '$hasta_hora', '$block_3', '$tipo_3', '$circulacion_trenes_3', '$vias_3', '$desde_sector_3', '$hasta_sector_3', '$empresa_3', '$encargados_3', '$telefonos_3', '$descripcion_3', '$aprobacion', '$fecha_ingreso', '$despachador_3','ABIERTO')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

	header("Location: cortadas_solicitadas.php");

} 


?>