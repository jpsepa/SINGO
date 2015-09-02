<?php

session_start();

include "../config.php";

$link = Conectarse();

$fecha = $_POST["fecha"];

$nombre_denunciante = strtoupper($_POST["nombre_denunciante"]);
$nombre_denunciante_2 = strtr($nombre_denunciante, "áéíóú", "ÁÉÍÓÚ");	

$cedula_denunciante = $_POST["cedula_denunciante"];

$domicilio_denunciante = strtoupper($_POST["domicilio_denunciante"]);
$domicilio_denunciante_2 = strtr($domicilio_denunciante, "áéíóú", "ÁÉÍÓÚ");

$telefono_denunciante = $_POST["telefono_denunciante"];

if ($fecha=="" or $nombre_denunciante=="" or $cedula_denunciante=="" or $domicilio_denunciante=="" or $telefono_denunciante=="")
{

	header("Location: ingresar_fchd1_error.php?id=$id");

}else{

	$query = "INSERT INTO vigilancia_denunciante(fecha_hora, nombre, cedula_identidad, domicilio, telefono)
			VALUES ('$fecha', '".utf8_decode($nombre_denunciante_2)."', '$cedula_denunciante', '".utf8_decode($domicilio_denunciante_2)."', '$telefono_denunciante')";

	mysqli_query($link, $query);

	$id = mysqli_insert_id($link);

	header("Location: ingresar_fchd2.php?id=$id");

	mysqli_close($link); // Cerramos la conexion con la base de datos

}

?>