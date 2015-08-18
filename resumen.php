<?php

session_start();

include "config.php";

error_reporting(E_ERROR);

$link = Conectarse();

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


//Metrotren
$total_metrotren = mysqli_query($link, "SELECT COUNT(*) FROM servicios_recorridos WHERE porteador='T.MET-Metrotren'");
$cant_metrotren = $total_metrotren->fetch_row();
$cant_total_metrotren = $cant_metrotren[0];

$itinerario_metrotren = mysqli_query($link, "SELECT COUNT(*) FROM servicios_recorridos WHERE porteador='T.MET-Metrotren' AND dif_minutos<6");
$cant_itinerario_metrotren = $itinerario_metrotren->fetch_row();
$itinerario_total_metrotren = $cant_itinerario_metrotren[0];

$indicador_metrotren = $itinerario_total_metrotren * 100 / $cant_total_metrotren;

if($cant_total_metrotren == 0)
{
	$indicador_metrotren=0;
}else{
	$indicador_metrotren=$itinerario_total_metrotren * 100 / $cant_total_metrotren;
}

//Terrasur
$total_terrasur = mysqli_query($link, "SELECT COUNT(*) FROM servicios_recorridos WHERE porteador='T.REG-Terrasur'");
$cant_terrasur = $total_terrasur->fetch_row();
$cant_total_terrasur = $cant_terrasur[0];

$itinerario_terrasur = mysqli_query($link, "SELECT COUNT(*) FROM servicios_recorridos WHERE porteador='T.REG-Terrasur' AND dif_minutos<20");
$cant_itinerario_terrasur = $itinerario_terrasur->fetch_row();
$itinerario_total_terrasur = $cant_itinerario_terrasur[0];

if($cant_total_terrasur == 0)
{
	$indicador_terrasur=0;
}else{
	$indicador_terrasur=$itinerario_total_terrasur * 100 / $cant_total_terrasur;
}

//Buscarril
$total_buscarril = mysqli_query($link, "SELECT COUNT(*) FROM servicios_recorridos WHERE porteador='T.REG-Buscarril'");
$cant_buscarril = $total_buscarril->fetch_row();
$cant_total_buscarril = $cant_buscarril[0];

$itinerario_buscarril = mysqli_query($link, "SELECT COUNT(*) FROM servicios_recorridos WHERE porteador='T.REG-Buscarril' AND dif_minutos<20");
$cant_itinerario_buscarril = $itinerario_buscarril->fetch_row();
$itinerario_total_buscarril = $cant_itinerario_buscarril[0];

if($cant_total_buscarril == 0)
{
	$indicador_buscarril=0;
}else{
	$indicador_buscarril=$itinerario_total_buscarril * 100 / $cant_total_buscarril;
}


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
<link href="img/favicon.ico" rel="icon">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

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
				<a class="navbar-brand" href="#"><img src="img/logo-tmsa.png"></a>
				<center><h2 style="color:#000"><b>Sistema Integrado de Gestión Operacional</b> - Gerencia de Operaciones</h2></center>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<h3>Guillermo Ramírez</h3>
				<h4>Gerente de Operaciones</h4>
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="resumen.php"><span class="glyphicon glyphicon-dashboard"></span> Resumen</a></li>
			<li><a href="despacho_electrico"><span class="glyphicon glyphicon-folder-open"></span> Despacho Eléctrico</a></li>
			<li><a href="operaciones_servicios"><span class="glyphicon glyphicon-folder-open"></span> Operaciones y Servicios</a></li>
			<li><a href="programacion_optimizacion"><span class="glyphicon glyphicon-folder-open"></span> Programación y Optimización</a></li>
			<li><a href="trafico"><span class="glyphicon glyphicon-folder-open"></span> Tráfico</a></li>
			<li><a href="tripulacion"><span class="glyphicon glyphicon-folder-open"></span> Tripulación</a></li>
			<li><a href="Vigilancia"><span class="glyphicon glyphicon-folder-open"></span> Vigilancia</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Resumen</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Resumen <?php echo $meses[date('n')-1];?> <?php echo date("Y");?></h1>
			</div>
		</div><!--/.row-->
		
		<div class="row col-no-gutter-container">
			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cumplimiento Metrotren</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo round($indicador_metrotren, 0, PHP_ROUND_HALF_UP);?>" ><span class="percent"><?php echo round($indicador_metrotren, 2, PHP_ROUND_HALF_UP);?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cumplimiento Terrasur</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo round($indicador_terrasur, 0, PHP_ROUND_HALF_UP);?>" ><span class="percent"><?php echo round($indicador_terrasur, 2, PHP_ROUND_HALF_UP);?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cumplimiento Expreso Maule</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo round($indicador_terrasur, 0, PHP_ROUND_HALF_UP);?>" ><span class="percent"><?php echo round($indicador_terrasur, 2, PHP_ROUND_HALF_UP);?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cumplimiento Buscarril</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo round($indicador_buscarril, 0, PHP_ROUND_HALF_UP);?>" ><span class="percent"><?php echo round($indicador_buscarril, 2, PHP_ROUND_HALF_UP);?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<img src="img/metrotren.png">
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cant_total_metrotren;?></div>
							<div class="text-muted">Servicios</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<img src="img/terrasur.png">
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cant_total_terrasur;?></div>
							<div class="text-muted">Servicios</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<img src="img/maule.png">
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cant_total_buscarril;?></div>
							<div class="text-muted">Servicios</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<img src="img/buscarril.png">
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">0</div>
							<div class="text-muted">Servicios</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cantidad de Minutos por cada 100.000 Trenes Kilometros - 2015</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Cantidad de Servicios por cada 100.000 Trenes Kilometros - 2015</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Servicios Cargados: 7 | Servicios Atrasados: 2 | Servicios Itinerario: 5</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="servicios_recorridos.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="porteador" data-sortable="true">Porteador</th>
						        <th data-field="tren"  data-sortable="true">Tren</th>
						        <th data-field="tipo_equipo" data-sortable="true">Tipo Equipo</th>
						        <th data-field="num_equipo" data-sortable="true">N° Equipo</th>
						        <th data-field="km_reales" data-sortable="true">Km Reales</th>
						        <th data-field="est_origen_real" data-sortable="true">Estación Origen</th>
						        <th data-field="est_destino_real" data-sortable="true">Estación Destino</th>
						        <th data-field="h_salida_real" data-sortable="true">Hora Salida</th>
						        <th data-field="h_llegada_real" data-sortable="true">Hora Llegada</th>
						        <th data-field="dif_minutos" data-sortable="true">Cumplimiento</th>
						    </tr>
						    </thead>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
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
		var chart2 = document.getElementById("bar-chart").getContext("2d");
		window.myBar = new Chart(chart2).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart5 = document.getElementById("radar-chart").getContext("2d");
		window.myRadarChart = new Chart(chart5).Radar(radarData, {
			responsive : true,
			scaleLineColor: "rgba(255,255,255,.05)",
			angleLineColor : "rgba(255,255,255,.2)"
		});
		
	};
	</script>
</body>

</html>
