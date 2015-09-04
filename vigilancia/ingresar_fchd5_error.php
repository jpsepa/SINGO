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
			<li><a href="consultar_hecho_delictual.php"><span class="glyphicon glyphicon-question-sign"></span>Consultar Hechos Delictuales</a></li>
			<li><a href="objetivos.php"><span class="glyphicon glyphicon-tasks"></span> Objetivos</a></li>
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
				<span class='glyphicon glyphicon-exclamation-sign'></span> DEBE LLENAR COMO MÍNIMO EL NOMBRE Y CARGO
			</div>
			</center>
				<form role="form" action="procesa_fchd5.php" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">Fiscalía</div>
						<div class="panel-body">
							<input type="hidden" style="background-color:#fff;color:#000;text-transform:uppercase" name="id" class="form-control" value="<?php echo $id;?>">
							<div class="form-group">
								<label>Nombre</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="nombre" type="text" class="form-control" placeholder="Ingrese el nombre del funcionario de Fiscalía">
							</div>								
							<div class="form-group">
								<label>Cargo</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="cargo" type="text" class="form-control" placeholder="Ingrese el cargo del funcionario de Fiscalía">
							</div>
							<div class="form-group">
								<label>Teléfono Oficina</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="telefono" type="text" class="form-control" placeholder="Ingrese el teléfono del funcionario de Fiscalía">
							</div>
							<div class="form-group">
								<label>Celular</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="celular" type="text" class="form-control" placeholder="Ingrese el celular del funcionario de Fiscalía">
							</div>
							<div class="form-group">
								<label>E-mail</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="email" type="text" class="form-control" placeholder="Ingrese el e-mail del funcionario de Fiscalía">
							</div>
							<button type="submit" class="btn btn-default btn-md">Siguiente</button>
						</div>
					</div>
				</form>
			</div>
			<a href="finalizar.php?id=<?php echo $id;?>" style="background-color:#00327a" class="btn btn-default btn-md">Haga Click Aquí Si No Desea Agregar Datos Fiscalía</a>
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
