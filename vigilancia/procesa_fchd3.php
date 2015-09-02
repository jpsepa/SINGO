<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST["id"];

$circunstancias = strtoupper($_POST["circunstancias"]);
$circunstancias_2 = strtr($circunstancias, "áéíóú", "ÁÉÍÓÚ");

$testigos = $_POST["testigos"];

$avaluo_especies = $_POST["avaluo_especies"];

if ($circunstancias=="" or $testigos=="" or $avaluo_especies=="")
{

	header("Location: ingresar_fchd3_error.php?id=$id");

}else{

	$query = "INSERT INTO vigilancia_hechos(id_denunciante, circunstancias, testigos, avaluo_especies)
		VALUES ('$id', '".utf8_decode($circunstancias_2)."', '$testigos', '$avaluo_especies')";

	mysqli_query($link, $query);

	header("Location: ingresar_fchd4.php?id=$id");

	mysqli_close($link); // Cerramos la conexion con la base de datos

}

?>