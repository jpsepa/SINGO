<?php

session_start();

error_reporting(E_ERROR);

setlocale(LC_CTYPE,"es_ES");

include "config.php";

$link = Conectarse();

$id = $_POST["id"];
$id_ct = $_POST["identificador"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$den_des = strtoupper($_POST["den_des"]);
$ncortada = strtoupper($_POST["ncortada"]);
$despachador = mb_strtoupper($_POST["despachador"],'utf-8');
$cortador = mb_strtoupper($_POST["cortador"],'utf-8');
$it = mb_strtoupper($_POST["it"],'utf-8');
$notificador = mb_strtoupper($_POST["notificador"],'utf-8');
$descripcion = mb_strtoupper($_POST["descripcion"],'utf-8');
$estado = strtoupper($_POST["estado"]);
$usuario = strtoupper($_SESSION['user']);
$nombre = mb_strtoupper(utf8_encode($_SESSION['nombre']),'utf-8')." ".mb_strtoupper(utf8_encode($_SESSION['apellido_pat']),'utf-8');
$despachador_solicitud = mb_strtoupper($_POST["despachador_solicitud"],'utf-8');
$fecha_sistema = date("Y-m-d h:i:s");

if($id_ct == "" or $fecha == "" or $hora == "" or $den_des == "" or $ncortada == "" or $despachador == "" or $cortador == "" or $it == "" or $notificador == "" or $descripcion == "" or $estado == "" or $usuario == "" or $nombre == "" or $despachador_solicitud == "")
{
	echo "<script>
			alert('Debe llenar todos los campos');
			document.location=('libro_cortada.php?id=$id');
		</script>";

}else{

	$tildes = $link->query("SET NAMES 'utf8'");
	$tildes = strtoupper($tildes);
	mysqli_query($link, "INSERT INTO despacho_libro(id_ct, fecha, hora, den_des, ncortada, despachador, cortador, inspector_turno, notificador, descripcion, usuario, nombre, fecha_sistema, estado, despachador_solicitud)
		VALUES ('$id_ct', '$fecha', '$hora', '$den_des', '$ncortada', '$despachador', '$cortador', '$it', '$notificador', '$descripcion', '$usuario', '$nombre', '$fecha_sistema', '$estado', '$despachador_solicitud')");
	mysqli_close($link); // Cerramos la conexion con la base de datos

	echo "<script>
			alert('Cortada ingresada correctamente');
			document.location=('libro_acta.php');
		</script>";

} 


?>