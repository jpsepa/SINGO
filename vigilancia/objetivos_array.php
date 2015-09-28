<?php

session_start();

include "../config.php";

$link = Conectarse();

$sql = "SELECT * FROM objetivos WHERE area='VIGILANCIA'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8


if(!$result = mysqli_query($link, $sql)) die();

$objetivos_array = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['id'];

	$result2=mysqli_query($link, "SELECT SUM(cumpl_real) as cumplimiento_real FROM objetivos_secundarios WHERE id_objetivos='$id'");
	$row2=mysqli_fetch_array($result2);

	$result3=mysqli_query($link, "SELECT SUM(cumpl_prog) as cumplimiento_prog FROM objetivos_secundarios WHERE id_objetivos='$id'");
	$row3=mysqli_fetch_array($result3);

	$suma_obj_secund=mysqli_query($link, "SELECT COUNT(*) FROM objetivos_secundarios WHERE id_objetivos='$id'");
	$row_obj_secund=mysqli_fetch_array($suma_obj_secund);
	$total_obj_secund=$row_obj_secund[0];

	$prom_real=$row2['cumplimiento_real'] / $total_obj_secund;

	$prom_prog=$row3['cumplimiento_prog'] / $total_obj_secund;

	$descripcion="<a href='objetivos_secundarios.php?id=$id'>".$row['descripcion']."";
	$responsable=$row['responsable'];
	$cumplimiento_real=round($prom_real, 0)." %";
	$cumplimiento_prog=round($prom_prog, 0)." %";

	$objetivos_array[] = array('id'=> $id, 'descripcion'=> $descripcion, 'responsable'=> $responsable, 'plazo'=> $plazo, 'cumplimiento'=> $cumplimiento_real, 'cumplimiento_prog'=> $cumplimiento_prog);

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string2 = json_encode($objetivos_array,JSON_UNESCAPED_UNICODE);

echo $json_string2;

?>