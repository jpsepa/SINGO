<?php

include "../config.php";

$link = Conectarse();

session_start();

date_default_timezone_set("America/Santiago");

$id = $_GET["id"];

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
			<li class="active"><a href="ingresar_fchd1.php"><span class="glyphicon glyphicon-tags"></span> Registrar Hecho Delictual</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-book"></span> #</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> #</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-th"></span> #</a></li>
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
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Inicio</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Vigilancia</h1>
				<h2 class="page-header">Formulario de Comunicación de Hechos Delictuales</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row col-no-gutter-container">

			<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
			<center>
			<div id='error' class='alert bg-danger' style='width:100%;text-align:left' role='alert'>
				<span class='glyphicon glyphicon-exclamation-sign'></span> DEBE LLENAR COMO MÍNIMO LA REGIÓN, COMUNA/SECTOR, P.K, FECHA Y HORA, N° PARTE/DELITO, UNIDAD POLICIAL, FISCALÍA M.P.
			</div>
			</center>
				<form role="form" action="procesa_fchd2.php" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">Antecedentes Generales</div>
						<div class="panel-body">
							<div class="form-group">
								<input type="hidden" style="background-color:#fff;color:#000;text-transform:uppercase" name="id" class="form-control" value="<?php echo $id;?>">
							</div>
							<div class="form-group">
								<label>Región</label><br>
								<select class="form-control" style="background-color:#fff;color:#000" name="region">
									<option value="ARICA Y PARINACOTA">ARICA Y PARINACOTA</option>
									<option value="TARAPACÁ">TARAPACÁ</option>
									<option value="ANTOFAGASTA">ANTOFAGASTA</option>
									<option value="ATACAMA">ATACAMA</option>
									<option value="COQUIMBO">COQUIMBO</option>
									<option value="VALPARAÍSO">VALPARAÍSO</option>
									<option value="O'HIGGINS">O'HIGGINS</option>
									<option value="MAULE">MAULE</option>
									<option value="BÍO BÍO">BÍO BÍO</option>
									<option value="ARAUCANÍA">ARAUCANÍA</option>
									<option value="LOS RÍOS">LOS RÍOS</option>
									<option value="LOS LAGOS">LOS LAGOS</option>
									<option value="AYSÉN">AYSÉN</option>
									<option value="MAGALLANES">MAGALLANES</option>
									<option value="METROPOLITANA DE SANTIAGO">METROPOLITANA DE SANTIAGO</option>
								</select>
							</div>							
							<div class="form-group">
								<label>Comuna/Sector</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="comuna_sector" class="form-control" placeholder="Ingrese una Comuna o un Sector">
							</div>
							<div class="form-group">
								<label>P.K.</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="pk" class="form-control" placeholder="Ingrese un PK Ej: 19 (CINCO PINOS)">
							</div>
							<div class="form-group">
								<label>Fecha</label>
								<input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="fecha" class="form-control" readonly value="<?php echo date("Y-m-d");?>">
							</div>
							<div class="form-group">
								<label>Hora</label>
								<input type="text" style="background-color:#fff;color:#000;cursor:pointer" id="desde_hora" name="hora" class="hora-control form-control" readonly value="00:00">
									<script type="text/javascript">
										var clock = $('.hora-control');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script>
							</div>
							<div class="form-group">
								<label>N° Parte/Delito</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="numero_parte" class="form-control" placeholder="Ingrese un Número de Parte Ej: 6370">
							</div>
							<div class="form-group">
								<label>Unidad Policial</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="unidad_policial" class="form-control" placeholder="Ingrese una Unidad Policial">
							</div>
							<div class="form-group">
								<label>Fiscalía Ministerio Público</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="fiscalia_mp" class="form-control" placeholder="Ingrese una Fiscalía">
							</div>
							<div class="form-group">
								<label>Tribunal</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="tribunal" class="form-control" placeholder="Ingrese un Tribunal">
							</div>
							<div class="form-group">
								<label>RUC</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="ruc" class="form-control" placeholder="Ingrese un número de RUC">
							</div>
							<div class="form-group">
								<label>RIT</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="rit" class="form-control" placeholder="Ingrese un número de RIT">
							</div>
							<button type="submit" class="btn btn-default btn-md">Siguiente</button>
						</div>
					</div>
				</form>
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
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap-table.js"></script>
	
</body>

</html>
