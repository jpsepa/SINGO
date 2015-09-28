<?php

	include "../config.php";

	$link = Conectarse();

	$ano = $_POST["ano"];

	$falla_electrica = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as falla FROM operaciones_ingresos WHERE id_falla=1 AND YEAR(fecha_ingreso)='$ano'"));
	$falla_neumatica = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as falla FROM operaciones_ingresos WHERE id_falla=2 AND YEAR(fecha_ingreso)='$ano'"));
	$falla_mecanica = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as falla FROM operaciones_ingresos WHERE id_falla=3 AND YEAR(fecha_ingreso)='$ano'"));
	$falla_estructural = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as falla FROM operaciones_ingresos WHERE id_falla=4 AND YEAR(fecha_ingreso)='$ano'"));
	$falla_aire_instr = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as falla FROM operaciones_ingresos WHERE id_falla=5 AND YEAR(fecha_ingreso)='$ano'"));

	$data = array(0 => round($falla_electrica['falla'],0),
				  1 => round($falla_neumatica['falla'],0),
				  2 => round($falla_mecanica['falla'],0),
				  3 => round($falla_estructural['falla'],0),
				  4 => round($falla_aire_instr['falla'],0)
				  );
	echo json_encode($data); 

?>