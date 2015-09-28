<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST["id"];

$nombre = strtoupper($_POST["nombre"]);
$nombre_2 = strtr($nombre, "ñáéíóú", "ÑÁÉÍÓÚ");

$cedula_identidad = $_POST["cedula_identidad"];

$ocupacion = strtoupper($_POST["ocupacion"]);
$ocupacion_2 = strtr($ocupacion, "ñáéíóú", "ÑÁÉÍÓÚ");

$domicilio = strtoupper($_POST["domicilio"]);
$domicilio_2 = strtr($domicilio, "ñáéíóú", "ÑÁÉÍÓÚ");

if ($nombre=="" or $cedula_identidad=="" or $ocupacion=="" or $domicilio=="")
{
	
	header("Location: ingresar_fchd4_error.php?id=$id");

}else{

	$query = "INSERT INTO vigilancia_imputados(id_denunciante, nombre, cedula_identidad, ocupacion, domicilio)
		VALUES ('$id', '".utf8_decode($nombre_2)."', '$cedula_identidad', '".utf8_decode($ocupacion_2)."', '".utf8_decode($domicilio_2)."')";

	mysqli_query($link, $query);

	header("Location: ingresar_fchd4.php?id=$id");

	mysqli_close($link); // Cerramos la conexion con la base de datos

}

?>