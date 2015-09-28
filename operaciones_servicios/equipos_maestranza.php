<?php

	include "../config.php";

	$link = Conectarse();

	$ano = $_POST["ano"];

	$enero = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=1 AND YEAR(fecha_ingreso)='$ano'"));
	$febrero = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=2 AND YEAR(fecha_ingreso)='$ano'"));
	$marzo = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=3 AND YEAR(fecha_ingreso)='$ano'"));
	$abril = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=4 AND YEAR(fecha_ingreso)='$ano'"));
	$mayo = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=5 AND YEAR(fecha_ingreso)='$ano'"));
	$junio = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=6 AND YEAR(fecha_ingreso)='$ano'"));
	$julio = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=7 AND YEAR(fecha_ingreso)='$ano'"));
	$agosto = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=8 AND YEAR(fecha_ingreso)='$ano'"));
	$septiembre = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=9 AND YEAR(fecha_ingreso)='$ano'"));
	$octubre = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=10 AND YEAR(fecha_ingreso)='$ano'"));
	$noviembre = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=11 AND YEAR(fecha_ingreso)='$ano'"));
	$diciembre = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as cantidad FROM operaciones_ingresos WHERE MONTH(fecha_ingreso)=12 AND YEAR(fecha_ingreso)='$ano'"));

	$data = array(0 => round($enero['cantidad'],0),
				  1 => round($febrero['cantidad'],0),
				  2 => round($marzo['cantidad'],0),
				  3 => round($abril['cantidad'],0),
				  4 => round($mayo['cantidad'],0),
				  5 => round($junio['cantidad'],0),
				  6 => round($julio['cantidad'],0),
				  7 => round($agosto['cantidad'],0),
				  8 => round($septiembre['cantidad'],0),
				  9 => round($octubre['cantidad'],0),
				  10 => round($noviembre['cantidad'],0),
				  11 => round($diciembre['cantidad'],0)
				  );
	echo json_encode($data);

?>