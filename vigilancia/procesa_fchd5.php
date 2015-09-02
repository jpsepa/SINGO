<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST["id"];

$nombre = strtoupper($_POST["nombre"]);
$nombre_2 = strtr($nombre, "áéíóú", "ÁÉÍÓÚ");

$cargo = strtoupper($_POST["cargo"]);
$cargo_2 = strtr($cargo, "áéíóú", "ÁÉÍÓÚ");

$telefono = $_POST["telefono"];

$celular = $_POST["celular"];

$email = $_POST["email"];

if ($nombre=="" or $cargo=="")
{
	
	header("Location: ingresar_fchd5_error.php?id=$id");

}else{

	$query = "INSERT INTO vigilancia_fiscalia(id_denunciante, nombre, cargo, telefono, celular, email)
			VALUES ('$id', '".utf8_decode($nombre_2)."', '".utf8_decode($cargo_2)."', '$telefono', '$celular', '$email')";

	mysqli_query($link, $query);

	header("Location: finalizar.php?id=$id");

	mysqli_close($link); // Cerramos la conexion con la base de datos

}

?>