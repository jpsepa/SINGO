<?php


include "config.php";

$link = Conectarse();

session_start();

$sql = "SELECT * FROM usuarios WHERE cargo='Gerente de Operaciones'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

while($row = mysqli_fetch_array($result)) 
{
	$nombre=$row['nombre'];
	$apellido_pat=$row['apellido_pat'];
	$apellido_mat=$row['apellido_mat'];
	$cargo=$row['cargo'];
	$email=$row['email'];
	$user=$row['user'];
	$area=$row['area'];
	$foto=$row['foto'];
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
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-plus"></span> Organigrama</a></li>
			<li class="active"><a href="mi_cuenta.php"><span class="glyphicon glyphicon-user"></span> Mi Cuenta</a></li>
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
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="nuestro_equipo.php">Nuestro Equipo</a></li>
				<li class="active">Detalle Usuario</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Mi Cuenta</h1>
				<h2 class="page-header">Editar Usuario</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Datos Personales</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nombre:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="<?php echo $nombre;?>" class="form-control">
									</div>
								</div>
							
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Apellido Paterno:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="<?php echo $apellido_pat;?>" class="form-control">
									</div>
								</div>
								
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Apellido Materno:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="<?php echo $apellido_mat;?>" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Cargo:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="<?php echo $cargo;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">E-mail:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="<?php echo $email;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Usuario:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="<?php echo $user;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Área:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="<?php echo $area;?>" class="form-control">
									</div>
								</div>
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md pull-right">Actualizar</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
			
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon glyphicon-picture"></span>Fotografía</div>
					<div class="panel-body">
						<?php
							echo "<img width='300px' height='400px' src='img/$foto'";
						?>
					</div>
				</div>
								
			</div><!--/.col-->
		</div>

		<div class="row col-no-gutter-container row-margin-top">
			
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
</body>

</html>
