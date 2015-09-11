<?php

session_start();

include "../config.php";

$link = Conectarse();

$sql = "SELECT * FROM despacho_libro_acta WHERE categoria='' ORDER BY id DESC";
mysqli_set_charset($link, "utf8"); //formato de datos utf8


if(!$result = mysqli_query($link, $sql)) die();

$libro_de_acta_array = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$id = $row["id"];
	$fecha_hora_inicio = $row["fecha_inicio"]." ".$row["hora_inicio"];
	$fecha_termino = $row["fecha_termino"];
	$hora_termino = $row["hora_termino"];
	if ($fecha_termino=="0000-00-00" AND $hora_termino=="00:00:00")
	{
		$fecha_hora_termino = "NO INGRESADA";
	}else{
		$fecha_hora_termino = $row["fecha_termino"]." ".$row["hora_termino"];;
	}
	$categoria = $row["categoria"];
	$km_lugar = $row["km_lugar"];
	$den_des = $row["den_des"];
	$descripcion = $row["descripcion"];
	$notificador = $row["notificador"];
	$usuario = $row["usuario"];
	$fecha_hora = $row["fecha_hora"];

	$libro_de_acta_array[] = array('id'=> $id, 'fecha_inicio'=> $fecha_hora_inicio, 'hora_inicio'=> $hora_inicio, 'fecha_termino'=> $fecha_hora_termino, 'categoria'=> $categoria, 'km_lugar'=> $km_lugar, 'den_des'=> $den_des, 'descripcion'=> $descripcion, 'notificador'=> $notificador, 'usuario'=> $usuario, 'fecha_hora'=> $fecha_hora);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string2 = json_encode($libro_de_acta_array,JSON_UNESCAPED_UNICODE);

echo $json_string2;

?>