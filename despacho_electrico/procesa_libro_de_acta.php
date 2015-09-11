<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$usuario = $_SESSION["nombre"]." ".$_SESSION["apellido_pat"];

$fecha_hora = date("Y-m-d G:m:s");

$fecha = $_POST["fecha"];

$hora_inicio = $_POST["hora_inicio"];

$km_lugar = strtoupper($_POST["km_lugar"]);
$km_lugar_2 = strtr($km_lugar, "ñáéíóú", "ÑÁÉÍÓÚ");

$categoria = strtoupper($_POST["categoria"]);
$categoria_2 = strtr($categoria, "ñáéíóú", "ÑÁÉÍÓÚ");

$den_des = strtoupper($_POST["den_des"]);

$descripcion = strtoupper($_POST["descripcion"]);
$descripcion_2 = strtr($descripcion, "ñáéíóú", "ÑÁÉÍÓÚ");

$notificador = strtoupper($_POST["notificador"]);
$notificador_2 = strtr($notificador, "ñáéíóú", "ÑÁÉÍÓÚ");

mysqli_query($link, "INSERT INTO despacho_libro_acta(fecha_inicio, hora_inicio, categoria, km_lugar, den_des, descripcion, notificador, usuario, fecha_hora) VALUES ('$fecha', '$hora_inicio', '".utf8_decode($categoria)."', '".utf8_decode($km_lugar_2)."', '$den_des', '".utf8_decode($descripcion_2)."', '".utf8_decode($notificador_2)."', '$usuario', '$fecha_hora')");

$id = mysqli_insert_id($link);

header("Location: libro_de_acta.php?ingreso=exitoso");

mysqli_close($link); // Cerramos la conexion con la base de datos

?>