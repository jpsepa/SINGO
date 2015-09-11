<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$id = $_GET["id"];

$evento=mysqli_query($link, "SELECT * FROM despacho_libro_acta ORDER BY fecha_hora DESC");

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
				<h3><?php echo $_SESSION['nombre']." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li class="active"><a href="libro_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
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
				<li class="active">Libro Acta</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Libro de Acta</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class='alert bg-success' style='width:100%;text-align:left;background-color:#266916' role='alert'>
					<span class='glyphicon glyphicon-check'></span> EVENTO INGRESADO CON ÉXITO
				</div>
				<div class="panel panel-default">
				<div class="panel-heading">Resumen</div>
					<div class="panel-body">
						<table data-toggle="table">
						    <thead>
						    <tr>
						        <th>Fecha Inicio</th>
						        <th>Hora Inicio</th>
						        <th>Categoría</th>
						        <th>Km/Lugar</th>
						        <th>DEN/DES</th>
						        <th>Descripción</th>
						        <th>Notificador</th>
						    </tr>
						    </thead>
						    <?php
						    while ($row_evento = mysqli_fetch_array($evento)) {
						    	echo "<tr>
						    	<td>".$row_evento['fecha']."</td>
						    	<td>".$row_evento['hora_inicio']."</td>
						    	<td>".utf8_encode($row_evento['categoria'])."</td>
						    	<td>".utf8_encode($row_evento['km_lugar'])."</td>
						    	<td>".utf8_encode($row_evento['den_des'])."</td>
						    	<td>".utf8_encode($row_evento['descripcion'])."</td>
						    	<td>".utf8_encode($row_evento['notificador'])."</td>
						    	</tr>
						    	";
						    }
						    ?>
						</table>
					</div>
				</div>
				<a href="libro_de_acta.php" class="btn btn-default btn-md" style="background-color:#00438c">Regresar</a>
			</div>
		</div><!-- /.row -->

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
	
</body>

</html>
