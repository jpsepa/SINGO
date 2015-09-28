<?php

session_start();

include "../config.php";

$link = Conectarse();

$id = $_POST['id'];

date_default_timezone_set("America/Santiago");

$fecha_termino = $_POST["fecha_termino"];
$hora_termino = $_POST["hora_termino"];

$sql = "UPDATE despacho_libro_acta SET fecha_termino='$fecha_termino', hora_termino='$hora_termino' WHERE id='$id'";

mysqli_query($link,$sql);

header("Location: pendientes.php");

?>