<?php

session_start();

include "config.php";

$link = Conectarse();

$desde_fecha = $_POST["desde_fecha"];
$desde_hora = $_POST["desde_hora"];
$hasta_fecha = $_POST["hasta_fecha"];
$hasta_hora = $_POST["hasta_hora"];
$block = $_POST["block"];
$tipo = $_POST["tipo"];
$circulacion_trenes = $_POST["circulacion_trenes"];
$vias = $_POST["vias"];
$empresa = $_POST["empresa"];
$encargados = $_POST["encargados"];
$telefonos = $_POST["telefonos"];
$descripcion = $_POST["descripcion"];
$aprobacion = $_POST["aprobacion"];
$fecha_ingreso = date("Y-m-d h:i:s");

if($desde_fecha == "" or $desde_hora == "" or $hasta_fecha == "" or $hasta_hora == "" or $block == "" or $tipo == "" or $circulacion_trenes == "" or $vias == "" or $empresa == "" or $encargados == "" or $telefonos == "" or $descripcion == "")
{
	echo "<script>
			alert('Debe llenar todos los campos');
			document.location=('libro_cortada.php');
		</script>";

}else{

	$tildes = $link->query("SET NAMES 'utf8'");
	mysqli_query($link, "INSERT INTO despacho_cortadas(desde_fecha, desde_hora, hasta_fecha, hasta_hora, block, tipo, circulacion_trenes, vias, empresa, encargados, telefonos, descripcion, aprobacion, fecha_ingreso, estado)
		VALUES ('$desde_fecha', '$desde_hora', '$hasta_fecha', '$hasta_hora', '$block', '$tipo', '$circulacion_trenes', '$vias', '$empresa', '$encargados', '$telefonos', '$descripcion', '$aprobacion', '$fecha_ingreso', 'Abierta')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

	echo "<script>
			alert('Cortada ingresada correctamente');
			document.location=('solicitud_cortada.php');
		</script>";

} 


?>