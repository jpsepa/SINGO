<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST["id"];
$descripcion = $_POST["descripcion"];
$responsable = $_POST["responsable"];
$plazo = $_POST["plazo"];
$cumpl_real = $_POST["cumpl_real"];
$cumpl_prog = $_POST["cumpl_prog"];

	mysqli_query($link, "INSERT INTO objetivos_secundarios(id_objetivos, descripcion, responsable, plazo, cumpl_real, cumpl_prog)
		VALUES ('$id', '$descripcion', '$responsable', '$plazo', '$cumpl_real', '$cumpl_prog')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

header("Location: objetivos_secundarios.php?id=$id")

?>