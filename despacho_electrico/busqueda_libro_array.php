<?php

session_start();

include "config.php";

$link = Conectarse();

$desde = $_POST['desde'];

$hasta = $_POST['hasta'];

$sql = "SELECT * FROM despacho_libro WHERE fecha BETWEEN '$desde' AND '$hasta'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

$registros_libro = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['id'];
	$id_ct=$row['id_ct'];
	$fecha=$row['fecha'];
	$hora=$row['hora'];
	$den_des=$row['den_des'];
	$ncortada=$row['ncortada'];
	$despachador=$row['despachador'];
	$cortador=$row['cortador'];
	$inspector_turno=$row['inspector_turno'];
	$notificador=$row['notificador'];
	$descripcion=$row['descripcion'];
	$nombre=$row['nombre'];
	$fecha_sistema=$row['fecha_sistema'];
	$estado=$row['estado'];
	$despachador_solicitud=$row['despachador_solicitud'];

	$registros_libro[] = array('id'=> $id, 'id_ct'=> $id_ct, 'fecha'=> $fecha, 'hora'=> $hora, 'den_des'=> $den_des, 'ncortada'=> $ncortada,
						'despachador'=> $despachador, 'cortador'=> $cortador, 'inspector_turno'=>$inspector_turno, 'notificador'=> $notificador,
						'descripcion'=> $descripcion, 'nombre'=> $nombre, 'fecha_sistema'=> $fecha_sistema, 'estado'=> $estado,
						'despachador_solicitud'=> $despachador_solicitud);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string3 = json_encode($registros_libro,JSON_UNESCAPED_UNICODE);

echo $json_string3;

?>