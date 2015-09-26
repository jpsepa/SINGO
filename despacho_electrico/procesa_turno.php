<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$turno = $_POST["turno"];

$usuario = $_SESSION['user'];

$cargo = $_SESSION["cargo"];

$fecha_hora = date("Y-m-d G:m:s");

mysqli_query($link, "INSERT INTO sesiones(nombre, turno, cargo, fecha) VALUES ('$usuario', '$turno', '".utf8_decode($cargo)."', '$fecha_hora')");

$_SESSION["turno"]=$turno;

header("Location: libro_de_acta.php");

mysqli_close($link); // Cerramos la conexion con la base de datos

?>