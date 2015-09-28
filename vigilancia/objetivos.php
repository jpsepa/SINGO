<?php 

error_reporting(E_ERROR);
  
session_start();

include "../config.php";

$link = Conectarse();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$usuarios=mysqli_query($link, "SELECT * FROM usuarios");
$row_usuarios=mysql_fetch_array($usuarios);


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
				<a class="navbar-brand" href="#"><img src="../img/logo-tmsa.png"></a>
				<center><h2 style="color:#000"><b>Sistema Integrado de Gestión Operacional</b> - Gerencia de Operaciones</h2></center>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<h3><?php echo utf8_encode($_SESSION['nombre'])." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="ingresar_fchd1.php"><span class="glyphicon glyphicon-tags"></span> Registrar Hecho Delictual</a></li>
			<li class="active"><a href="objetivos.php"><span class="glyphicon glyphicon-tasks"></span> Objetivos</a></li>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-user'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ul class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Objetivos</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Vigilancia</h1>
				<h2 class="page-header">Objetivos</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Objetivos Principales</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="objetivos_array.php" >
						    <thead>
						    <tr>
						        <th data-field="descripcion">Descripción</th>
						        <th data-field="responsable">Responsable</th>
						        <th data-field="cumplimiento">Cumplimiento Real</th>
						        <th data-field="cumplimiento_prog">Cumplimiento Programado</th>
						    </tr>
						    </thead>
						</table>
					</div>
				</div>
				<form role="form" action="procesa_objetivos.php" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">Agregar Objetivo Principal</div>
						<div class="panel-body">
							<div class="form-group">
								<label>Descripción</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="descripcion" class="form-control" placeholder="Ingrese una descripción">
							</div>								
							<div class="form-group">
								<label>Responsable</label>
								<select style="background-color:#fff;color:#000" name="responsable" class="form-control">
								<?php
								do {  
								$nombre=utf8_encode($row_usuarios['nombre']." ".$row_usuarios['apellido_pat']);
								$nombre_2=strtoupper($nombre);
								$nombre_may = strtr($nombre_2, "áéíóú", "ÁÉÍÓÚ");	
								?>
          						<option value="<?php echo $nombre_may;?>"><?php echo $nombre_may;?></option>
          						<?php
								} while ($row_usuarios = mysqli_fetch_assoc($usuarios));
								?> 
								</select>
							</div>
							<button type="submit" class="btn btn-default btn-md">Ingresar</button>
						</div>
					</div>
				</form>
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
