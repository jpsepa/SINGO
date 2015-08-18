<?php

include "config.php";

$link = Conectarse();

session_start();

if($_SESSION['logeado']!=1)
	header("Location: login.php");

$fecha=strtotime(date("Y-m-d H:i:s"));
$ano1=date("Y", $fecha);
$mes1=date("m", $fecha);
$dia1=date("d", $fecha);

$mesanterior=$mes1 - 1;

if ($mes1=="01") {
	$mes1="Enero";
}elseif ($mes1=="02") {
	$mes1="Febrero";
}elseif ($mes1=="03") {
	$mes1="Marzo";
}elseif ($mes1=="04") {
	$mes1="Abril";
}elseif ($mes1=="05") {
	$mes1="Mayo";
}elseif ($mes1=="06") {
	$mes1="Junio";
}elseif ($mes1=="07") {
	$mes1="Julio";
}elseif ($mes1=="08") {
	$mes1="Agosto";
}elseif ($mes1=="09") {
	$mes1="Septiembre";
}elseif ($mes1=="10") {
	$mes1="Octubre";
}elseif ($mes1=="11") {
	$mes1="Noviembre";
}elseif ($mes1=="12") {
	$mes1="Diciembre";
}

if ($mesanterior=="1") {
	$mesanterior="Enero";
}elseif ($mesanterior=="2") {
	$mesanterior="Febrero";
}elseif ($mesanterior=="3") {
	$mesanterior="Marzo";
}elseif ($mesanterior=="4") {
	$mesanterior="Abril";
}elseif ($mesanterior=="5") {
	$mesanterior="Mayo";
}elseif ($mesanterior=="6") {
	$mesanterior="Junio";
}elseif ($mesanterior=="7") {
	$mesanterior="Julio";
}elseif ($mesanterior=="8") {
	$mesanterior="Agosto";
}elseif ($mesanterior=="9") {
	$mesanterior="Septiembre";
}elseif ($mesanterior=="10") {
	$mesanterior="Octubre";
}elseif ($mesanterior=="11") {
	$mesanterior="Noviembre";
}elseif ($mesanterior=="12") {
	$mesanterior="Diciembre";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
				<h3><?php echo $_SESSION['nombre']." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-plus"></span> Organigrama</a></li>
			<li><a href="mi_cuenta.php"><span class="glyphicon glyphicon-user"></span> Mi Cuenta</a></li>
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
			<ul class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Inicio</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Inicio</h1>
				<h2 class="page-header">Indicadores SEP</h2>
			</div>
		</div><!--/.row-->

		<div class="opciones">
			<center>
			<h3><?php echo $dia1." de ".$mes1." del ".$ano1;?></h3><br>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Puntualidad</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-green" data-percent="90" ><span class="percent">90%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Confiabilidad</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-green2" data-percent="98" ><span class="percent">98%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Seguridad</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-yellow" data-percent="50" ><span class="percent">50%</span>
						</div>
					</div>
				</div>
			</div>
			</center>
		</div>
		
		<div class="opciones">
			<center>
			<h3><?php echo $mes1." del ".$ano1;?></h3><br>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Puntualidad</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-yellow2" data-percent="85" ><span class="percent">85%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Confiabilidad</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-green3" data-percent="92" ><span class="percent">92%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Seguridad</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red" data-percent="30" ><span class="percent">30%</span>
						</div>
					</div>
				</div>
			</div>
			</center>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Objetivos</h2>
			</div>
		</div><!--/.row-->

		<div class="opciones">
			<center>
			<h3>Mensual (<?php echo $mesanterior." ".$ano1;?>)</h3><br>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 1</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-yellow3" data-percent="85" ><span class="percent">85%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 2</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-green4" data-percent="92" ><span class="percent">92%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 3</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red2" data-percent="30" ><span class="percent">30%</span>
						</div>
					</div>
				</div>
			</div>
			</center>
		</div><!--/.row-->

		<div class="row">
				<center>
				<h2>Resumen año móvil</h2>
				</center>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 1</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="indicador1-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 2</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="indicador2-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 3</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="indicador3-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Riesgos</h2>
			</div>
		</div><!--/.row-->

		<div class="opciones">
			<center>
			<h3>Riesgos Materializados <?php echo $mesanterior." ".$ano1;?></h3><br>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 1</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-yellow4" data-percent="85" ><span class="percent">85%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 2</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-green5" data-percent="92" ><span class="percent">92%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="opcion">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 3</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red3" data-percent="30" ><span class="percent">30%</span>
						</div>
					</div>
				</div>
			</div>
			</center>
		</div><!--/.row-->

		<div class="row">
				<center>
				<h2>Resumen año móvil</h2>
				</center>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 1</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="indicador4-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 2</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="indicador5-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Indicador 3</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="indicador6-chart" height="200" width="600"></canvas>
						</div>
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
	<script>
	window.onload = function(){

		var chart1 = document.getElementById("indicador1-chart").getContext("2d");
		window.myBar = new Chart(chart1).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart2 = document.getElementById("indicador2-chart").getContext("2d");
		window.myBar = new Chart(chart2).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart3 = document.getElementById("indicador3-chart").getContext("2d");
		window.myBar = new Chart(chart3).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart4 = document.getElementById("indicador4-chart").getContext("2d");
		window.myBar = new Chart(chart4).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart5 = document.getElementById("indicador5-chart").getContext("2d");
		window.myBar = new Chart(chart5).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart6 = document.getElementById("indicador6-chart").getContext("2d");
		window.myBar = new Chart(chart6).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});

	};
	</script>	
</body>

</html>
