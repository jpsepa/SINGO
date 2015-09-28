<?php

session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$sql = "SELECT t1.*, t2.nombre_falla as id_falla, t3.nombre as id_subcategoria, t4.nombre as tipo_equipo, t5.numero as numero_equipo

FROM operaciones_ingresos t1

INNER JOIN operaciones_fallas t2 ON (t1.id_falla=t2.id)

INNER JOIN operaciones_subcategorias t3 ON (t1.id_subcategoria=t3.id)

INNER JOIN operaciones_equipos t4 ON (t1.tipo_equipo=t4.id)

INNER JOIN operaciones_numero_equipo t5 ON (t1.numero_equipo=t5.id)

WHERE t1.fecha_egreso='0000-00-00' AND t1.hora_egreso='00:00:00'

ORDER BY id DESC";

mysqli_set_charset($link, "utf8"); //formato de datos utf8


if(!$result = mysqli_query($link, $sql)) die();

$libro_de_acta_array = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$fecha_actual = date("Y-m-d");
	$id = $row["id"];
	$fecha_hora_ingreso = $row["fecha_ingreso"]." ".$row["hora_ingreso"];
	$fecha_hora_egreso = $row["fecha_egreso"]." ".$row["hora_egreso"];
	$id_falla = $row["id_falla"];
	$id_subcategoria = $row["id_subcategoria"];
	$descripcion_falla = $row["descripcion_falla"];
	$lugar = $row["lugar"];
	$tipo_equipo = $row["tipo_equipo"];
	$numero_equipo = $row["numero_equipo"];
	$usuario = $row["usuario"];
	$intervalo_dias = (strtotime($fecha_actual) - strtotime($row["fecha_ingreso"])) / (60 * 60 * 24);
	if ($intervalo_dias < 8 and $intervalo_dias >= 5) {

		$intervalo_dias2 = "<label style='color:black;background-color:yellow;width:100%;text-align:center'><b>".$intervalo_dias."</b></label>";

	}elseif($intervalo_dias >= 8){

		$intervalo_dias2 = "<label style='background-color:red;width:100%;text-align:center'><b>".$intervalo_dias."</b></label>";

	}elseif($intervalo_dias < 5){

		$intervalo_dias2 = "<label style='width:100%;text-align:center'><b>".$intervalo_dias."</b></label>";

	}
	$fecha_sistema = $row["fecha_sistema"];
	$modificar = "<a href='retirar_taller.php?id=$id'>Retirar Taller</a>";

	$libro_de_acta_array[] = array('id'=> $id, 'fecha_hora_ingreso'=> $fecha_hora_ingreso, 'fecha_hora_egreso'=> $fecha_hora_egreso, 'id_falla'=> $id_falla, 'id_subcategoria'=> $id_subcategoria, 'descripcion_falla'=> $descripcion_falla, 'lugar'=> $lugar, 'tipo_equipo'=> $tipo_equipo, 'numero_equipo'=> $numero_equipo, 'usuario'=> $usuario, 'fecha_sistema'=> $fecha_sistema, 'modificar'=> $modificar, 'cant_dias'=> $intervalo_dias2);
}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string2 = json_encode($libro_de_acta_array,JSON_UNESCAPED_UNICODE);

echo $json_string2;

?>