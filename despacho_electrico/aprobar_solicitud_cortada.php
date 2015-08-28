<?php

session_start();

include "config.php";

$link = Conectarse();

$id=$_GET["id"];

$query=("SELECT * FROM despacho_solicitud_temp WHERE id='$id'");
$result=mysqli_query($link,$query);

date_default_timezone_set("America/Santiago");

while($row = mysqli_fetch_array($result)) 
{ 
	$desde_fecha=$row['desde_fecha'];
	$desde_hora=$row['desde_hora'];
	$hasta_fecha=$row['hasta_fecha'];
	$hasta_hora=$row['hasta_hora'];
	$block=$row['block'];
	$tipo=$row['tipo'];
	$circulacion_trenes=$row['circulacion_trenes'];
	$vias=$row['vias'];
	$desde_sector=$row['desde_sector'];
	$hasta_sector=$row['hasta_sector'];
	$empresa=$row['empresa'];
	$encargados=$row['encargados'];
	$telefonos=$row['telefonos'];
	$descripcion=$row['descripcion'];
	$fecha_ingreso=date("Y-m-d G:i:s");
	$despachador=$_SESSION['nombre']." ". $_SESSION['apellido_pat'];
	$despachador_2=strtoupper($despachador);
	$despachador_3 = strtr($despachador_2, "áéíóú", "ÁÉÍÓÚ");
}

$query2=("INSERT INTO despacho_solicitud(desde_fecha, desde_hora, hasta_fecha, hasta_hora, block,tipo, circulacion_trenes, vias, desde_sector,
	 hasta_sector, empresa, encargados, telefonos, descripcion, aprobacion, fecha_ingreso, despachador, estado) VALUES('$desde_fecha', '$desde_hora',
	 '$hasta_fecha', '$hasta_hora', '$block', '$tipo', '$circulacion_trenes', '$vias', '$desde_sector', '$hasta_sector', '$empresa', '$encargados', 
	 '$telefonos', '$descripcion','APROBADO', '$fecha_ingreso', '$despachador_3', 'ABIERTO')");
mysqli_query($link,$query2);

$query3=("DELETE FROM despacho_solicitud_temp WHERE id='$id'");
mysqli_query($link,$query3);

header("Location: solicitud_cortada_temp.php");


?>