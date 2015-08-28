<?php

session_start();

include "../config.php";

$link = Conectarse();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$sql = "SELECT * FROM despacho_solicitud_temp";

mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

$cortadas = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 

	$id=$row['id'];
	$desde_fecha=$row['desde_fecha'].' '.$row['desde_hora'];
	$hasta_fecha=$row['hasta_fecha'].' '.$row['hasta_hora'];
	$block=$row['block'];
	$tipo=$row['tipo'];
	$circulacion_trenes=$row['circulacion_trenes'];
	$vias=$row['vias'];
	$sector=$row['desde_sector'].' - '.$row['hasta_sector'];
	$empresa=$row['empresa'];
	$encargados=$row['encargados'];
	$descripcion=$row['descripcion'];
	$despacho="<a href='aprobar_solicitud_cortada.php?id=$id'><p style='color:#0ba007'>Aprobar</p></a><br><a href='libro_cortada.php?id=$id'><p style='color:red'>Rechazar</p></a>";

	$cortadas[] = array('id'=> $id, 'desde_fecha'=> $desde_fecha, 'hasta_fecha'=> $hasta_fecha, 
						'block'=> $block, 'tipo'=> $tipo, 'circulacion_trenes'=> $circulacion_trenes,
						'vias'=> $vias, 'sector'=> $sector, 'empresa'=> $empresa, 'encargados'=> $encargados, 
						'descripcion'=> $descripcion, 'despacho'=> $despacho);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string = json_encode($cortadas,JSON_UNESCAPED_UNICODE);

echo $json_string;

?>