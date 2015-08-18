<?php

session_start();

error_reporting(E_ERROR);

setlocale(LC_CTYPE,"es_ES");

include "config.php";

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$link = Conectarse();

$id = $_POST["id"];
$id_ct = $_POST["identificador"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$it = utf8_encode(mb_strtoupper($_POST["it"],'utf-8'));
$usuario = mb_strtoupper($_SESSION['nombre']." ".$_SESSION['apellido_pat']);

if($id_ct == "" or $fecha == "" or $hora == "" or $it == "" or $usuario == "")
{
	echo "<script>
			alert('Debe llenar todos los campos');
			document.location=('libro_cortada.php?id=$id');
		</script>";

}else{

	mysqli_query($link, "INSERT INTO trafico_libro(id_despacho_solicitud, fecha_autorizacion, hora_autorizacion, numero_ct, nombre_it, usuario) VALUES ('$id', '$fecha', '$hora', '$id_ct', '$it', '$usuario')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

	header("Location:cortadas_registradas.php?ingreso=exitoso");

} 


?>