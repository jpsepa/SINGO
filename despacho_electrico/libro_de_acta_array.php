<?php

session_start();

include "../config.php";

$link = Conectarse();

$turnos = $_SESSION["turno"];

$sql = "SELECT * FROM despacho_libro_acta WHERE turno='$turnos' ORDER BY id DESC";
mysqli_set_charset($link, "utf8"); //formato de datos utf8


if(!$result = mysqli_query($link, $sql)) die();

$libro_de_acta_array = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	if($row["categoria"]=="PENDIENTE"){

		$id = $row["id"];
		$fecha_hora_inicio = "<label style='background-color:red;width:100%'>".$row["fecha_inicio"]." ".$row["hora_inicio"]."</label>";
		$fecha_termino = "<label style='background-color:red;width:100%'>".$row["fecha_termino"]."</label>";
		$hora_termino = "<label style='background-color:red;width:100%'>".$row["hora_termino"]."</label>";
		if ($fecha_termino=="0000-00-00" AND $hora_termino=="00:00:00")
		{
			$fecha_hora_termino = "<label style='background-color:red;width:100%'>NO INGRESADA</label>";
		}else{
			$fecha_hora_termino = "<label style='background-color:red;width:100%'>".$row["fecha_termino"]." ".$row["hora_termino"]."</label>";
		}
		$categoria = "<label style='background-color:red;width:100%'>".$row["categoria"]."</label>";
		$km_lugar = "<label style='background-color:red;width:100%;text-align:center'>".$row["km_lugar"]."</label>";
		$den_des = "<label style='background-color:red;width:100%'>".$row["den_des"]."</label>";
		$descripcion = "<label style='background-color:red;width:100%'>".$row["descripcion"]."</label>";
		$notificador = "<label style='background-color:red;width:100%'>".$row["notificador"]."</label>";
		$usuario = "<label style='background-color:red;width:100%'>".$row["usuario"]."</label>";
		$fecha_hora = "<label style='background-color:red;width:100%'>".$row["fecha_hora"]."</label>";
		$modificar = "<a style='background-color:red;width:100%' href='modificar_registro.php?id=$id'>Editar/Cerrar</a>";

		$libro_de_acta_array[] = array('id'=> $id, 'fecha_inicio'=> $fecha_hora_inicio, 'hora_inicio'=> $hora_inicio, 'fecha_termino'=> $fecha_hora_termino, 'categoria'=> $categoria, 'km_lugar'=> $km_lugar, 'den_des'=> $den_des, 'descripcion'=> $descripcion, 'notificador'=> $notificador, 'usuario'=> $usuario, 'fecha_hora'=> $fecha_hora, 'modificar'=> $modificar);

	}else{

		$id = $row["id"];
		$fecha_hora_inicio = $row["fecha_inicio"]." ".$row["hora_inicio"];
		$fecha_termino = $row["fecha_termino"];
		$hora_termino = $row["hora_termino"];
		if ($fecha_termino=="0000-00-00" AND $hora_termino=="00:00:00")
		{
			$fecha_hora_termino = "NO INGRESADA";
		}else{
			$fecha_hora_termino = $row["fecha_termino"]." ".$row["hora_termino"];
		}
		$categoria = $row["categoria"];
		$km_lugar = "<label style='background-color:green;width:100%;text-align:center'>".$row["km_lugar"]."</label>";
		$den_des = $row["den_des"];
		$descripcion = $row["descripcion"];
		$notificador = $row["notificador"];
		$usuario = $row["usuario"];
		$fecha_hora = $row["fecha_hora"];
		$modificar = "<a href='modificar_registro.php?id=$id'>Editar/Cerrar</a>";

		$libro_de_acta_array[] = array('id'=> $id, 'fecha_inicio'=> $fecha_hora_inicio, 'hora_inicio'=> $hora_inicio, 'fecha_termino'=> $fecha_hora_termino, 'categoria'=> $categoria, 'km_lugar'=> $km_lugar, 'den_des'=> $den_des, 'descripcion'=> $descripcion, 'notificador'=> $notificador, 'usuario'=> $usuario, 'fecha_hora'=> $fecha_hora, 'modificar'=> $modificar);

	}


	$id = $row["id"];
	$fecha_hora_inicio = $row["fecha_inicio"]." ".$row["hora_inicio"];
	$fecha_termino = $row["fecha_termino"];
	$hora_termino = $row["hora_termino"];
	if ($fecha_termino=="0000-00-00" AND $hora_termino=="00:00:00")
	{
		$fecha_hora_termino = "NO INGRESADA";
	}else{
		$fecha_hora_termino = $row["fecha_termino"]." ".$row["hora_termino"];
	}
	$categoria = $row["categoria"];
	$km_lugar = "<label style='background-color:green;width:100%;text-align:center'>".$row["km_lugar"]."</label>";
	$den_des = $row["den_des"];
	$descripcion = $row["descripcion"];
	$notificador = $row["notificador"];
	$usuario = $row["usuario"];
	$fecha_hora = $row["fecha_hora"];
	$modificar = "<a href='modificar_registro.php?id=$id'>Editar/Cerrar</a>";

	$libro_de_acta_array[] = array('id'=> $id, 'fecha_inicio'=> $fecha_hora_inicio, 'hora_inicio'=> $hora_inicio, 'fecha_termino'=> $fecha_hora_termino, 'categoria'=> $categoria, 'km_lugar'=> $km_lugar, 'den_des'=> $den_des, 'descripcion'=> $descripcion, 'notificador'=> $notificador, 'usuario'=> $usuario, 'fecha_hora'=> $fecha_hora, 'modificar'=> $modificar);
}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string2 = json_encode($libro_de_acta_array,JSON_UNESCAPED_UNICODE);

echo $json_string2;

?>