<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

mysqli_set_charset($link, "utf8"); //formato de datos utf8

session_start();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$desde_fecha = $_POST['fecha_desde'];
$hasta_fecha = $_POST['fecha_hasta'];

$sql = mysqli_query($link, "SELECT * FROM despacho_solicitud WHERE desde_fecha BETWEEN '$desde_fecha' AND '$hasta_fecha'");

//Aplicar Formato a Fecha Desde

$fecha1=strtotime($desde_fecha);

$ano1=date("Y", $fecha1);
$mes1=date("m", $fecha1);
$dia1=date("d", $fecha1);

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

//Aplicar Formato a Fecha Hasta

$fecha2=strtotime($hasta_fecha);

$ano2=date("Y", $fecha2);
$mes2=date("m", $fecha2);
$dia2=date("d", $fecha2);

if ($mes2=="01") {
	$mes2="Enero";
}elseif ($mes2=="02") {
	$mes2="Febrero";
}elseif ($mes2=="03") {
	$mes2="Marzo";
}elseif ($mes2=="04") {
	$mes2="Abril";
}elseif ($mes2=="05") {
	$mes2="Mayo";
}elseif ($mes2=="06") {
	$mes2="Junio";
}elseif ($mes2=="07") {
	$mes2="Julio";
}elseif ($mes2=="08") {
	$mes2="Agosto";
}elseif ($mes2=="09") {
	$mes2="Septiembre";
}elseif ($mes2=="10") {
	$mes2="Octubre";
}elseif ($mes2=="11") {
	$mes2="Noviembre";
}elseif ($mes2=="12") {
	$mes2="Diciembre";
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
<link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.min.css">
<!--[if lt IE 9]>
<link href="css/rgba-fallback.css" rel="stylesheet">
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<script type='text/javascript' src='http://code.jquery.com/jquery-1.11.0.js'></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/clockpicker.js"></script>

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
				<h3><?php echo $_SESSION['nombre']." ".utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li class="active"><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Registrar Telegrama</a></li>
			<li><a href="nuestro_equipo.php"><span class="glyphicon glyphicon-user"></span> Nuestro Equipo</a></li>
			<li><a href="objetivos.php"><span class="glyphicon glyphicon-tasks"></span> Objetivos</a></li>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-user'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ul class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Cortadas Solicitadas</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Búsqueda de Cortadas</h2>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Cortadas Solicitadas</div>
					<div class="panel-body">
						<table data-toggle="table">
						    <thead>
						    Usted está buscando cortadas solicitadas entre:&nbsp; <?php echo $dia1." de ".$mes1." del ".$ano1." - ".$dia2." de ".$mes2." del ".$ano2; ?><br><br>
						    <tr>
						        <th>Desde</th>
						        <th>Hasta</th>
						        <th>Block</th>
						        <th>Circulación Trenes</th>
						        <th>Empresa</th>
						        <th>Descripción Trabajos</th>
						        <th>Aprobación Despacho Eléctrico</th>
						        <th>Despachador</th>
						        <th></th>
						    </tr>
						    </thead>
						    <?php
						    while ($row_cortadas = mysqli_fetch_array($sql)) {
						    	$id=$row_cortadas['id'];
						    	echo "<tr>
						    	<td>".$row_cortadas['desde_fecha']." ".$row_cortadas['desde_hora']."</td>
						    	<td>".$row_cortadas['hasta_fecha']." ".$row_cortadas['hasta_hora']."</td>
						    	<td>".$row_cortadas['block']."</td>
						    	<td>".$row_cortadas['circulacion_trenes']."</td>
						    	<td>".$row_cortadas['empresa']."</td>
						    	<td>".$row_cortadas['descripcion']."</td>
						    	<td>".$row_cortadas['aprobacion']."</td>
						    	<td>".$row_cortadas['despachador']."</td>
						    	<td><a href='detalle_cortada.php?id=$id' target='_blank'><span class='glyphicon glyphicon-search'></span></a></td>
						    	</tr>
						    	";
						    }
						    ?>
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
	
</body>

</html>
