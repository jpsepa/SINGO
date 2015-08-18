<?php

session_start();

include "config.php";

$link = Conectarse();

$sql = "SELECT trafico_libro.fecha_autorizacion as fecha_autorizacion, trafico_libro.hora_autorizacion as hora_autorizacion, trafico_libro.numero_ct as numero_ct, despacho_solicitud.block as block ,trafico_libro.nombre_it as nombre_it, trafico_libro.usuario as usuario, despacho_solicitud.descripcion as descripcion FROM trafico_libro, despacho_solicitud WHERE trafico_libro.id_despacho_solicitud=despacho_solicitud.id";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

$cortadas = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$numero_ct=$row['numero_ct'];
	$fecha_autorizacion=$row['fecha_autorizacion']." ".$row['hora_autorizacion'];
	$block=$row['block'];
	$descripcion=$row['descripcion'];
	$it=$row['nombre_it'];
	$usuario=utf8_encode($row['usuario']);

	$cortadas[] = array('numero_ct'=>$numero_ct, 'fecha_autorizacion'=>$fecha_autorizacion, 'block'=>$block, 'descripcion'=>$descripcion, 'nombre_it'=>$it, 'usuario'=>$usuario);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string = json_encode($cortadas,JSON_UNESCAPED_UNICODE);

echo $json_string;

?>