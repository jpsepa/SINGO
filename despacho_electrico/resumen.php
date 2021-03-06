<?php

include "config.php";

$link = Conectarse();

session_start();

//TOTAL SOLICITUDES
$total = mysqli_query($link, "SELECT COUNT(*) FROM despacho_solicitud");
$cant_total = $total->fetch_row();
$cantidad_total = $cant_total[0];

//ASSIGNIA
$total_assignia = mysqli_query($link, "SELECT COUNT(*) FROM despacho_solicitud WHERE empresa='ASSIGNIA'");
$cant_total_assignia = $total_assignia->fetch_row();
$cantidad_total_assignia = $cant_total_assignia[0];


if($cantidad_total == 0)
{
	$indicador_assignia=0;
}else{
	$indicador_assignia = $cantidad_total_assignia * 100 / $cantidad_total;
}

//BESALCO
$total_besalco = mysqli_query($link, "SELECT COUNT(*) FROM despacho_solicitud WHERE empresa='BESALCO'");
$cant_total_besalco = $total_besalco->fetch_row();
$cantidad_total_besalco = $cant_total_besalco[0];


if($cantidad_total == 0)
{
	$indicador_besalco=0;
}else{
	$indicador_besalco = $cantidad_total_besalco * 100 / $cantidad_total;
}

//SISTEMAS SEC
$total_ssec = mysqli_query($link, "SELECT COUNT(*) FROM despacho_solicitud WHERE empresa='SSEC'");
$cant_total_ssec = $total_ssec->fetch_row();
$cantidad_total_ssec = $cant_total_ssec[0];


if($cantidad_total == 0)
{
	$indicador_ssec=0;
}else{
	$indicador_ssec = $cantidad_total_ssec * 100 / $cantidad_total;
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
			<li><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Registrar Telegrama</a></li>
			<li><a href="nuestro_equipo.php"><span class="glyphicon glyphicon-user"></span> Nuestro Equipo</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-th"></span> #</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-th"></span> #</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-th"></span> #</a></li>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-user'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ul class="breadcrumb">
				<li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row col-no-gutter-container">

			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Solicitudes Assignia</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo round($indicador_assignia, 0, PHP_ROUND_HALF_UP);?>" ><span class="percent"><?php echo round($indicador_assignia, 2, PHP_ROUND_HALF_UP);?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Solicitudes Besalco</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-teal2" data-percent="<?php echo round($indicador_besalco, 0, PHP_ROUND_HALF_UP);?>" ><span class="percent"><?php echo round($indicador_besalco, 2, PHP_ROUND_HALF_UP);?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Solicitudes SSEC</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo round($indicador_ssec, 0, PHP_ROUND_HALF_UP);?>" ><span class="percent"><?php echo round($indicador_ssec, 2, PHP_ROUND_HALF_UP);?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Solicitudes Otras</div>
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red" data-percent="0" ><span class="percent">0%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding">
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cantidad_total_assignia;?></div>
							<div class="text-muted">Solicitudes</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cantidad_total_besalco;?></div>
							<div class="text-muted">Solicitudes</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cantidad_total_ssec;?></div>
							<div class="text-muted">Solicitudes</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">0</div>
							<div class="text-muted">Solicitudes</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cantidad de Cortadas Solicitadas - 2015</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
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
