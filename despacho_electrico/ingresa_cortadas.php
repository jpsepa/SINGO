<?php

session_start();

include "config.php";

$link = Conectarse();

$desde_fecha = $_POST["desde_fecha"];
$desde_hora = $_POST["desde_hora"];
$hasta_fecha = $_POST["hasta_fecha"];
$hasta_hora = $_POST["hasta_hora"];
$block = mb_strtoupper($_POST["block"],'utf-8');
$tipo = mb_strtoupper($_POST["tipo"],'utf-8');
$circulacion_trenes = mb_strtoupper($_POST["circulacion_trenes"],'utf-8');
$vias = mb_strtoupper($_POST["vias"],'utf-8');
$empresa = mb_strtoupper($_POST["empresa"],'utf-8');
$encargados = mb_strtoupper($_POST["encargados"],'utf-8');
$telefonos = mb_strtoupper($_POST["telefonos"],'utf-8');
$descripcion = mb_strtoupper($_POST["descripcion"],'utf-8');
$aprobacion = mb_strtoupper($_POST["aprobacion"],'utf-8');
$fecha_ingreso = date("Y-m-d h:i:s");

if($desde_fecha == "" or $desde_hora == "" or $hasta_fecha == "" or $hasta_hora == "" or $block == "" or $tipo == "" or $circulacion_trenes == "" or $vias == "" or $empresa == "" or $encargados == "" or $telefonos == "" or $descripcion == "")
{
	echo "<script>
			alert('Debe llenar todos los campos');
			document.location=('libro_cortada.php');
		</script>";

}else{

	$tildes = $link->query("SET NAMES 'utf8'");
	mysqli_query($link, "INSERT INTO despacho_solicitud(desde_fecha, desde_hora, hasta_fecha, hasta_hora, block, tipo, circulacion_trenes, vias, empresa, encargados, telefonos, descripcion, aprobacion, fecha_ingreso, estado)
		VALUES ('$desde_fecha', '$desde_hora', '$hasta_fecha', '$hasta_hora', '$block', '$tipo', '$circulacion_trenes', '$vias', '$empresa', '$encargados', '$telefonos', '$descripcion', '$aprobacion', '$fecha_ingreso', 'ABIERTO')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

	echo "<script>
			alert('Cortada ingresada correctamente');
			document.location=('solicitud_cortada.php');
		</script>";

} 


?>