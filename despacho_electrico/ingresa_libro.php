<?php

session_start();

error_reporting(E_ERROR);

date_default_timezone_set("America/Santiago");

include "../config.php";

$link = Conectarse();

$id_solicitud = $_POST["id_solicitud"];
$id_trafico_libro = $_POST["id_trafico_libro"];
$numero_ct = $_POST["numero_ct"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$den_des = $_POST["den_des"];
$ncortada = $_POST["ncortada"];
$cortador = $_POST["cortador"];
$notificador = $_POST["notificador"];
$nombre = utf8_decode($_SESSION['nombre']." ".$_SESSION['apellido_pat']);
$fecha_sistema = date("Y-m-d G:i:s");

if($id_solicitud == "" or $id_trafico_libro == "" or $numero_ct == "" or $fecha == "" or $hora == "" or $den_des == "" or $ncortada == "" or $cortador == "" or $notificador == "" or $nombre == "")
{
	header("Location: libro_cortada_error.php?id=$id");

}else{

	mysqli_query($link, "INSERT INTO despacho_libro(id_solicitud, id_trafico_libro, numero_ct, fecha, hora, den_des, ncortada, cortador, notificador, nombre, fecha_sistema)
		VALUES ('$id_solicitud', '$id_trafico_libro', '$numero_ct','$fecha', '$hora', '$den_des', '$ncortada', '$cortador', '$notificador', '$nombre', '$fecha_sistema')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

	header("Location: libro_acta.php");

} 


?>