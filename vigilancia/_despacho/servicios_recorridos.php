<?php

session_start();

include "config.php";

$link = Conectarse();

$sql = "SELECT porteador, tren, tipo_equipo, num_equipo, km_reales, est_origen_real, est_destino_real, h_salida_real, h_llegada_real, dif_minutos FROM servicios_recorridos";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

$servicios = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$porteador=$row['porteador'];
	$tren=$row['tren'];
	$tipo_equipo=$row['tipo_equipo'];
	$num_equipo=$row['num_equipo'];
	$km_reales=$row['km_reales'];
	$est_origen_real=$row['est_origen_real'];
	$est_destino_real=$row['est_destino_real'];
	$h_salida_real=$row['h_salida_real'];
	$h_llegada_real=$row['h_llegada_real'];
	$dif_minutos=$row['dif_minutos'];
	if ($porteador=='T.MET-Metrotren' and $dif_minutos>5)
	{
		$dif_minutos='Atrasado';
	}
	elseif ($porteador=='T.MET-Metrotren' and $dif_minutos<6)
	{
		$dif_minutos='Itinerario';
	}
	

	$servicios[] = array('porteador'=> $porteador, 'tren'=> $tren, 'tipo_equipo'=> $tipo_equipo, 'num_equipo'=> $num_equipo,
						'km_reales'=> $km_reales, 'est_origen_real'=> $est_origen_real, 'est_destino_real'=> $est_destino_real,
						'h_salida_real'=> $h_salida_real, 'h_llegada_real'=> $h_llegada_real, 'dif_minutos'=> $dif_minutos);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string = json_encode($servicios,JSON_UNESCAPED_UNICODE);

echo $json_string;

?>