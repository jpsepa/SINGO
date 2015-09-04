<?php

include "../config.php";

$link = Conectarse();

session_start();

$desde = $_POST['fecha_desde'];
$fecha1 = strtotime($desde);
$ano1=date("Y", $fecha1);
$mes1=date("m", $fecha1);
$dia1=date("d", $fecha1);
if ($mes1=="01") {
	$mes1="ENERO";
}elseif ($mes1=="02") {
	$mes1="FEBRERO";
}elseif ($mes1=="03") {
	$mes1="MARZO";
}elseif ($mes1=="04") {
	$mes1="ABRIL";
}elseif ($mes1=="05") {
	$mes1="MAYO";
}elseif ($mes1=="06") {
	$mes1="JUNIO";
}elseif ($mes1=="07") {
	$mes1="JULIO";
}elseif ($mes1=="08") {
	$mes1="AGOSTO";
}elseif ($mes1=="09") {
	$mes1="SEPTIEMBRE";
}elseif ($mes1=="10") {
	$mes1="OCTUBRE";
}elseif ($mes1=="11") {
	$mes1="NOVIEMBRE";
}elseif ($mes1=="12") {
	$mes1="DICIEMBRE";
}

$hasta = $_POST['fecha_hasta'];
$fecha2 = strtotime($hasta);
$ano2=date("Y", $fecha2);
$mes2=date("m", $fecha2);
$dia2=date("d", $fecha2);
if ($mes2=="01") {
	$mes2="ENERO";
}elseif ($mes2=="02") {
	$mes2="FEBRERO";
}elseif ($mes2=="03") {
	$mes2="MARZO";
}elseif ($mes2=="04") {
	$mes2="ABRIL";
}elseif ($mes2=="05") {
	$mes2="MAYO";
}elseif ($mes2=="06") {
	$mes2="JUNIO";
}elseif ($mes2=="07") {
	$mes2="JULIO";
}elseif ($mes2=="08") {
	$mes2="AGOSTO";
}elseif ($mes2=="09") {
	$mes2="SEPTIEMBRE";
}elseif ($mes2=="10") {
	$mes2="OCTUBRE";
}elseif ($mes2=="11") {
	$mes2="NOVIEMBRE";
}elseif ($mes2=="12") {
	$mes2="DICIEMBRE";
}


$sql = "SELECT vigilancia_denunciante.id AS id, vigilancia_denunciante.nombre AS nombre_denunciante, vigilancia_denunciante.domicilio
AS domicilio_denunciante,  vigilancia_antecedentes.fecha AS fecha, vigilancia_antecedentes.hora AS hora, 
vigilancia_antecedentes.comuna_sector AS comuna_sector, vigilancia_antecedentes.pk AS pk, 
vigilancia_antecedentes.unidad_policial AS unidad_policial
FROM vigilancia_denunciante, vigilancia_antecedentes WHERE vigilancia_denunciante.id=vigilancia_antecedentes.id_denunciante AND vigilancia_antecedentes.fecha BETWEEN '$desde' AND '$hasta'";

if(!$result = mysqli_query($link, $sql)) die();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tren Central - Sistema Integrado de Gestión Operacional</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="../img/favicon.ico" rel="icon">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/jquery.orgchart.css">
<!--[if lt IE 9]>
<link href="css/rgba-fallback.css" rel="stylesheet">
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->


</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="../img/logo-tmsa.png"></a>
				<center><h2 style="color:#000"><b>Sistema Integrado de Gestión Operacional</b> - Gerencia de Operaciones</h2></center>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<h3><?php echo $_SESSION['nombre']." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="ingresar_fchd1.php"><span class="glyphicon glyphicon-tags"></span> Registrar Hecho Delictual</a></li>
			<li class="active"><a href="consultar_hecho_delictual.php"><span class="glyphicon glyphicon-question-sign"></span>Consultar Hechos Delictuales</a></li>
			<li><a href="objetivos.php"><span class="glyphicon glyphicon-tasks"></span> Objetivos</a></li>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-user'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Consultar Hechos Delictuales</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Vigilancia</h1>
				<h2 class="page-header">Consultar Hechos Delictuales</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row col-no-gutter-container">

			<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
			<form method="post" action="resultado_hecho_delictual.php">
				<label>Buscar Hechos Delictuales Desde: <input data-provide="datepicker" type="text" style="text-align:center" readonly="true" name="fecha_desde"> Hasta: <input data-provide="datepicker" style="text-align:center" readonly="true" type="text" name="fecha_hasta"></label>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" style="background:#0065ad" class="btn btn-default btn-md">Buscar</button><br><br>
			</form>
				<div class="panel panel-default">
					<div class="panel-heading">Listado de Hechos Delictuales ocurridos entre: <?php echo $dia1." DE ".$mes1." DEL ".$ano1." - ".$dia2." DE ".$mes2." DEL ".$ano2;?> </div>
					<div class="panel-body">
						<table data-toggle="table">
						    <thead>
						    <tr>
						        <th>Fecha y Hora del Hecho</th>
						        <th>Nombre Denunciante</th>
						        <th>Domicilio Denunciante</th>
						        <th>Comuna/Sector Ocurrido el Hecho</th>
						        <th>P.K. Ocurrido el Hecho</th>
						        <th>Unidad Policial</th>
						        <th></th>
						    </tr>
						    </thead>
						    <?php
						    while($row = mysqli_fetch_array($result)) 
							{
								$id = $row["id"];
								echo "<tr>
								<td>".$row["fecha"]." ".$row["hora"]."</td>
								<td>".utf8_encode($row["nombre_denunciante"])."</td>
								<td>".utf8_encode($row["domicilio_denunciante"])."</td>
								<td>".utf8_encode($row["comuna_sector"])."</td>
								<td>".utf8_encode($row["pk"])."</td>
								<td>".utf8_encode($row["unidad_policial"])."</td>
								<td><a href='detalle_hecho_delictual.php?id=$id'><span class='glyphicon glyphicon-sunglasses'></span>Detalle</a></td>
								</tr>";
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		</div>
		
		<div class="row col-no-gutter-container row-margin-top">
			
		</div><!--/.row-->

		<div class="row">
			
		</div><!--/.row-->

		<div class="row">
			
		</div><!--/.row-->	
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap-table.js"></script>

	<script>
	window.onload = function(){ 
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		
	};
	</script>
</body>

</html>
