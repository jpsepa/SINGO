<?php

header("Content-Type: text/html;charset=utf-8");

session_start();

include "../config.php";

$link = Conectarse();

mysqli_query("SET NAMES utf8");

$area = "VIGILANCIA";
$descripcion = strtoupper($_POST["descripcion"]);
$descripcion_2 = strtr($descripcion, "ñáéíóú", "ÑÁÉÍÓÚ");	
$responsable = $_POST["responsable"];

header('Content-Type: text/html; charset=iso-8859-1');

mysqli_query($link, "INSERT INTO objetivos(area, descripcion, responsable) VALUES ('".utf8_decode($area)."', '".utf8_decode($descripcion_2)."', '".utf8_decode($responsable)."')");
mysqli_close($link); // Cerramos la conexion con la base de datos

header("Location: objetivos.php")

?>