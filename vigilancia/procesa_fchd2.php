<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST["id"];

$region = $_POST["region"];

$comuna_sector = strtoupper($_POST["comuna_sector"]);
$comuna_sector_2 = strtr($comuna_sector, "áéíóú", "ÁÉÍÓÚ");

$pk = strtoupper($_POST["pk"]);
$pk_2 = strtr($pk, "áéíóú", "ÁÉÍÓÚ");

$fecha = $_POST["fecha"];

$hora = $_POST["hora"];

$numero_parte = strtoupper($_POST["numero_parte"]);
$numero_parte_2 = strtr($numero_parte, "áéíóú", "ÁÉÍÓÚ");

$unidad_policial = strtoupper($_POST["unidad_policial"]);
$unidad_policial_2 = strtr($unidad_policial, "áéíóú", "ÁÉÍÓÚ");

$fiscalia_mp = strtoupper($_POST["fiscalia_mp"]);
$fiscalia_mp_2 = strtr($fiscalia_mp, "áéíóú", "ÁÉÍÓÚ");

$tribunal = strtoupper($_POST["tribunal"]);
$tribunal_2 = strtr($tribunal, "áéíóú", "ÁÉÍÓÚ");

$ruc = strtoupper($_POST["ruc"]);
$ruc_2 = strtr($ruc, "áéíóú", "ÁÉÍÓÚ");

$rit = strtoupper($_POST["rit"]);
$rit_2 = strtr($rit, "áéíóú", "ÁÉÍÓÚ");

if ($region=="" or $comuna_sector=="" or $pk=="" or $fecha=="" or $hora=="" or $numero_parte=="" or $unidad_policial=="" or $fiscalia_mp=="")
{

	header("Location: ingresar_fchd2_error.php?id=$id");
	
}else{

	mysqli_query($link, "INSERT INTO vigilancia_antecedentes(id_denunciante, region, comuna_sector, pk, fecha, hora, numero_parte, unidad_policial, fiscalia_mp, tribunal, ruc, rit)
			VALUES ('$id', '$region', '".utf8_decode($comuna_sector_2)."', '".utf8_decode($pk_2)."', '$fecha', '$hora', '".utf8_decode($numero_parte_2)."', '".utf8_decode($unidad_policial_2)."', '".utf8_decode($fiscalia_mp_2)."', '".utf8_decode($tribunal_2)."', '".utf8_decode($ruc_2)."', '".utf8_decode($rit_2)."')");

	mysqli_close($link); // Cerramos la conexion con la base de datos

	header("Location: ingresar_fchd3.php?id=$id");

}

?>