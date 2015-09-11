<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$fecha_inicio = $_POST["fecha_inicio"];

$categorias = $_POST["categorias"];

$km_lugar = strtoupper($_POST["km_lugar"]);
$km_lugar_2 = strtr($km_lugar, "ñáéíóú", "ÑÁÉÍÓÚ");

$den_des = strtoupper($_POST["den_des"]);

$descripcion = strtoupper($_POST["descripcion"]);
$descripcion_2 = strtr($descripcion, "ñáéíóú", "ÑÁÉÍÓÚ");

$notificador = strtoupper($_POST["notificador"]);
$notificador_2 = strtr($notificador, "ñáéíóú", "ÑÁÉÍÓÚ");

//TODAS LLENAS
//--------------------
if ($fecha_inicio!="" AND $categorias!="" AND $km_lugar!="" AND $den_des!="" AND $descripcion!="" AND $notificador!="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' AND km_lugar LIKE '%$km_lugar_2%' AND den_des LIKE '%$den_des%' AND descripcion LIKE '%$descripcion_2%' AND notificador LIKE '%$notificador_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//TODAS VACÍAS
//--------------------
if ($fecha_inicio=="" AND $categorias=="" AND $km_lugar=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO FECHA INICIO
//--------------------
if ($categorias=="" AND $km_lugar=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO CATEGORÍA
//--------------------
if ($fecha_inicio=="" AND $km_lugar=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE categoria='$categorias' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO KM/LUGAR
//--------------------
if ($fecha_inicio=="" AND $categorias=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE km_lugar LIKE '%$km_lugar_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO DEN/DES
//--------------------
if ($fecha_inicio=="" AND $categorias=="" AND $km_lugar=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE km_lugar LIKE '%$den_des%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO DESCRIPCIÓN
//--------------------
if ($fecha_inicio=="" AND $categorias=="" AND $km_lugar=="" AND $den_des=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE km_lugar LIKE '%$descripcion_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO NOTIFICADOR
//--------------------
if ($fecha_inicio=="" AND $categorias=="" AND $km_lugar=="" AND $den_des=="" AND $descripcion=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE km_lugar LIKE '%$notificador_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO FECHA_INICIO Y CATEGORIA
//--------------------
if ($km_lugar=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO FECHA_INICIO Y KM/LUGAR
//--------------------
if ($categorias=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND km_lugar LIKE '%$km_lugar_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO FECHA_INICIO Y DEN/DES
//--------------------
if ($categorias=="" AND $km_lugar=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND den_des LIKE '%$den_des%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO FECHA_INICIO Y DESCRIPCION
//--------------------
if ($categorias=="" AND $km_lugar=="" AND $den_des=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND descripcion LIKE '%$descripcion_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

//SOLO FECHA_INICIO Y NOTIFICADOR
//--------------------
if ($categorias=="" AND $km_lugar=="" AND $den_des=="" AND $descripcion=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND notificador LIKE '%$notificador_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}
//--------------------

if ($den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' AND km_lugar LIKE '%$km_lugar_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

if ($descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' AND km_lugar LIKE '%$km_lugar_2%' AND den_des LIKE '%$den_des%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

if ($notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' AND km_lugar LIKE '%$km_lugar_2%' AND den_des LIKE '%$den_des%' AND descripcion LIKE '%$descripcion_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

//COMBINATORIA CON CATEGORÍA
if ($fecha_inicio=="" AND $categorias=="" AND $km_lugar=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

if ($categorias=="" AND $km_lugar=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

if ($km_lugar=="" AND $den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

if ($den_des=="" AND $descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' AND km_lugar LIKE '%$km_lugar_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

if ($descripcion=="" AND $notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' AND km_lugar LIKE '%$km_lugar_2%' AND den_des LIKE '%$den_des%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}

if ($notificador=="")
{
	$sql=mysqli_query($link, "SELECT * FROM despacho_libro_acta WHERE fecha_inicio='$fecha_inicio' AND categoria='$categorias' AND km_lugar LIKE '%$km_lugar_2%' AND den_des LIKE '%$den_des%' AND descripcion LIKE '%$descripcion_2%' ORDER BY fecha_hora DESC");
	$row=mysqli_fetch_array($sql);
}








?>