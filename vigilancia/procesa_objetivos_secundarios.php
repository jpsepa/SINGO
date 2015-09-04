<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST["id"];

$descripcion = strtoupper($_POST["descripcion"]);
$descripcion_2 = strtr($descripcion, "ñáéíóú", "ÑÁÉÍÓÚ");	

$responsable = strtoupper($_POST["responsable"]);
$responsable_2 = strtr($responsable, "ñáéíóú", "ÑÁÉÍÓÚ");	

$plazo = $_POST["plazo"];
$cumpl_real = $_POST["cumpl_real"];
$cumpl_prog = $_POST["cumpl_prog"];

	mysqli_query($link, "INSERT INTO objetivos_secundarios(id_objetivos, descripcion, responsable, plazo, cumpl_real, cumpl_prog)
		VALUES ('$id', '$descripcion_2', '$responsable_2', '$plazo', '$cumpl_real', '$cumpl_prog')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

header("Location: objetivos_secundarios.php?id=$id")

?>