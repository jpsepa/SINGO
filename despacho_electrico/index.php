<?php


include "../config.php";

$link = Conectarse();

session_start();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$user = $_SESSION["user"];

$turno = mysqli_query($link, "SELECT turno FROM sesiones WHERE id=(SELECT MAX(id) FROM sesiones) AND nombre='$user'");
$rows = mysqli_fetch_array($turno);
$turno2=$rows['turno'];

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
				<h3><?php echo utf8_encode($_SESSION['nombre'])." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
				<h4>Turno: <?php echo $turno2;?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_de_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta <?php echo $turno2;?></a></li>
			<li><a href="libro_de_acta_todos.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="busqueda_avanzada.php"><span class="glyphicon glyphicon-search"></span> Búsqueda Avanzada</a></li>
			<li><a href="pendientes.php"><span class="glyphicon glyphicon-time"></span> Pendientes</a></li>
			<li><a href="cortadas_canceladas.php"><span class="glyphicon glyphicon-ban-circle"></span> Cortadas Canceladas</a></li>
			<?php if($_SESSION['cargo']=='Jefe DEspacho Eléctrico'){ echo "<li><a href='nuestro_equipo.php'><span class='glyphicon glyphicon-user'></span> Nuestro Equipo</a></li>";}else{echo "<li></li>";}?>
			<?php if($_SESSION['cargo']=='Jefe DEspacho Eléctrico'){ echo "<li><a href='objetivos.php'><span class='glyphicon glyphicon-tasks'></span> Objetivos</a></li>";}else{echo "<li></li>";}?>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-user'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Inicio</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Indicadores de Cortadas</h2>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Cortadas Solicitadas: 400</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Cortadas Ejecutadas: 230</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart2" ></canvas>
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

		var chart1 = document.getElementById("pie-chart").getContext("2d");
		window.myPie = new Chart(chart1).Pie(pieData, {
			responsive : true,
			segmentShowStroke : false
		});

		var chart2 = document.getElementById("pie-chart2").getContext("2d");
		window.myPie = new Chart(chart2).Pie(pieData2, {
			responsive : true,
			segmentShowStroke : false
		});

	};
	</script>	
</body>

</html>
