<?php


include "config.php";

$link = Conectarse();

session_start();

$id2=$_SESSION['id'];

$id=$_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id='$id'";
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
}

if ($area!="Despacho Eléctrico")
	header("Location: acceso_denegado.php");

$sql2 = "SELECT * FROM usuarios WHERE id!='$id' AND id!='$id2' AND area='Despacho Eléctrico'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result2 = mysqli_query($link, $sql2)) die();

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
			<li><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Registrar Telegrama</a></li>
			<li class="active"><a href="nuestro_equipo.php"><span class="glyphicon glyphicon-user"></span> Nuestro Equipo</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-th"></span> #</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-th"></span> #</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-th"></span> #</a></li>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-arrow-left'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="nuestro_equipo.php">Nuestro Equipo</a></li>
				<li class="active">Asignar Tarea</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Asignar Tarea a <?php echo $nombre." ".$apellido_pat;?></h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon glyphicon-file"></span> Información de la Tarea</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Título:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" id="name" name="name" type="text" value="" class="form-control">
									</div>
								</div>
							
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Descripción:</label>
									<div class="col-md-9">
									<textarea style="background-color:#fff;color:#000" id="name" name="name" value="" class="form-control"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Fecha Asignación:</label>
									<div class="col-md-9">
									<input name="desde_asignacion" style="background-color:#c9c9c9;color:#000" readonly value="<?php echo date("Y-m-d");?>" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Fecha Límite:</label>
									<div class="col-md-9">
									<input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="desde_fecha" readonly value="<?php echo date("Y-m-d");?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Adjuntar Archivo:</label>
									<div class="col-md-9">
									<input multiple type="file">
									</div>
								</div>
								
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md">Asignar Tarea</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
			
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon glyphicon-user"></span>Asignar Tarea También a:</div>
					<div class="panel-body">
						<div class="checkbox">
							<?php
							while($row2 = mysqli_fetch_array($result2)) 
							{
								$identificador=$row2['id'];
								$nombre2=$row2['nombre'];
								$apellido_pat2=$row2['apellido_pat'];
								echo "
								<label>
									<input type='checkbox' value='$identificador'>$nombre2 $apellido_pat2
								</label><br>";
							}
							?>
						</div>
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
