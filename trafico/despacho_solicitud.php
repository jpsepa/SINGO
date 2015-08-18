<?php

session_start();

include "config.php";

$link = Conectarse();

$sql = "SELECT * FROM despacho_solicitud";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

$cortadas = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['id'];
	$desde_fecha=$row['desde_fecha'].' '.$row['desde_hora'];
	$desde_hora=$row['desde_hora'];
	$hasta_fecha=$row['hasta_fecha'].' '.$row['hasta_hora'];
	$hasta_hora=$row['hasta_hora'];
	$block=$row['block'];
	$tipo=$row['tipo'];
	$circulacion_trenes=$row['circulacion_trenes'];
	$vias=utf8_decode($row['vias']);
	$empresa=$row['empresa'];
	$encargados=$row['encargados'];
	$telefonos=$row['telefonos'];
	$descripcion=($row['descripcion']);
	$aprobacion=$row['aprobacion'];
	$fecha_ingreso=$row['fecha_ingreso'];
	$despachador=$row['despachador'];
	$estado=$row['estado'];
	$editar="<a href='registrar_cortada_detalle.php?id=$id'>&#x270E;</a>";

	$cortadas[] = array('id'=>$id, 'desde_fecha'=> $desde_fecha, 'desde_hora'=> $desde_hora, 'hasta_fecha'=> $hasta_fecha, 'hasta_hora'=> $hasta_hora,
						'block'=> $block, 'tipo'=> $tipo, 'circulacion_trenes'=>$circulacion_trenes, 'vias'=> $vias, 'empresa'=> $empresa, 
						'encargados'=> $encargados, 'telefonos'=> $telefonos, 'descripcion'=> $descripcion, 'aprobacion'=> $aprobacion, 
						'fecha_ingreso'=> $fecha_ingreso, 'despachador'=>$despachador, 'estado'=>$estado, 'editar'=>$editar);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string = json_encode($cortadas,JSON_UNESCAPED_UNICODE);

echo $json_string;

?>