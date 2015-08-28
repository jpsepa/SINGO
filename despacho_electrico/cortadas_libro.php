<?php

session_start();

include "config.php";

$link = Conectarse();

$sql = "SELECT trafico_libro.numero_ct as numero_ct, trafico_libro.nombre_it as nombre_it, despacho_libro.fecha as fecha, despacho_libro.hora as hora, despacho_libro.den_des as den_des, despacho_libro.ncortada as ncortada, despacho_libro.cortador as cortador, despacho_libro.notificador as notificador, despacho_solicitud.despachador as despachador,
despacho_solicitud.descripcion as descripcion, despacho_solicitud.estado as estado FROM trafico_libro, despacho_libro, despacho_solicitud WHERE despacho_solicitud.id = despacho_libro.id_solicitud";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

$cortadas_libro = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$numero_ct=$row['numero_ct'];
	$fecha=$row['fecha'];
	$hora=$row['hora'];
	$den_des=$row['den_des'];
	$ncortada=$row['ncortada'];
	$despachador=$row['despachador'];
	$cortador=$row['cortador'];
	$nombre_it=$row['nombre_it'];
	$notificador=$row['notificador'];
	$descripcion=$row['descripcion'];
	$estado=$row['estado'];

	$cortadas_libro[] = array('numero_ct'=> $numero_ct, 'fecha'=> $fecha, 'hora'=> $hora, 'den_des'=> $den_des, 'ncortada'=> $ncortada,
						'despachador'=> $despachador, 'cortador'=> $cortador, 'nombre_it'=>$nombre_it, 'notificador'=> $notificador,
						'descripcion'=> $descripcion, 'estado'=> $estado);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string2 = json_encode($cortadas_libro,JSON_UNESCAPED_UNICODE);

echo $json_string2;

?>