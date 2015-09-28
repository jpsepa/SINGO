<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$id = $_POST["id"];

$fecha_hora = date("Y-m-d G:m:s");

$fecha = $_POST["fecha"];

$hora_inicio = $_POST["hora_inicio"];

$fecha_termino = $_POST["fecha_termino"];

$hora_termino = $_POST["hora_termino"];

$km_lugar = strtoupper($_POST["km_lugar"]);
$km_lugar_2 = strtr($km_lugar, "ñáéíóú", "ÑÁÉÍÓÚ");
$km_lugar_3 = utf8_decode($km_lugar_2);

$categoria = strtoupper($_POST["categoria"]);
$categoria_2 = strtr($categoria, "ñáéíóú", "ÑÁÉÍÓÚ");
$categoria_3 = utf8_decode($categoria_2);

$den_des = strtoupper($_POST["den_des"]);

$descripcion = strtoupper($_POST["descripcion"]);
$descripcion_2 = strtr($descripcion, "ñáéíóú", "ÑÁÉÍÓÚ");
$descripcion_3 = utf8_decode($descripcion_2);

$notificador = strtoupper($_POST["notificador"]);
$notificador_2 = strtr($notificador, "ñáéíóú", "ÑÁÉÍÓÚ");
$notificador_3 = utf8_decode($notificador_2);

mysqli_query($link, "UPDATE despacho_libro_acta SET fecha_inicio='$fecha', hora_inicio='$hora_inicio', fecha_termino='$fecha_termino', hora_termino='$hora_termino', categoria='$categoria_3', km_lugar='$km_lugar_2', den_des='$den_des', descripcion='$descripcion_3', notificador='$notificador_3' WHERE id='$id'");

header("Location: libro_de_acta.php?ingreso=modificado");

mysqli_close($link); // Cerramos la conexion con la base de datos

?>