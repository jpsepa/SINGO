<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST["id"];

$descripcion = strtoupper($_POST["descripcion"]);
$descripcion_2 = strtr($descripcion, "ñáéíóú", "ÑÁÉÍÓÚ");	
$descripcion_3 = utf8_decode($descripcion_2);

$responsable = strtoupper($_POST["responsable"]);
$responsable_2 = strtr($responsable, "ñáéíóú", "ÑÁÉÍÓÚ");	
$responsable_3 = utf8_decode($responsable_2);

$plazo = $_POST["plazo"];
$cumpl_real = $_POST["cumpl_real"];
$cumpl_prog = $_POST["cumpl_prog"];

	mysqli_query($link, "UPDATE objetivos_secundarios SET descripcion='$descripcion_3', responsable='$responsable_3', plazo='$plazo', cumpl_real='$cumpl_real', cumpl_prog='$cumpl_prog'
			WHERE id_objetivos='$id'");
	mysqli_close($link); // Cerramos la conexion con la base de datos

header("Location: objetivos_secundarios.php?id=$id");

?>