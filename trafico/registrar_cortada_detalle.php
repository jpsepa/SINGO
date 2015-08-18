<?php 
  
session_start();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");


$usuario=$_SESSION['nombre']." ".$_SESSION['apellido_pat'];

include "config.php";

$link = Conectarse();

$id=$_GET['id'];

$sql = "SELECT * FROM despacho_solicitud WHERE id=$id";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['id'];
	$descripcion=$row['descripcion'];
	$estado=$row['estado'];

}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

$hora=date('H:i:s');

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
				<h3><?php echo $_SESSION['nombre']." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li class="active"><a href="registrar_cortada.php"><span class="glyphicon glyphicon-tags"></span> Registrar Cortada</a></li>
			<li><a href="cortadas_registradas.php"><span class="glyphicon glyphicon-book"></span> Libro Acta</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> #</a></li>
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
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Registrar Cortada</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tráfico</h1>
				<h2 class="page-header">Registrar Cortada</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">REGISTRE LA AUTORIZACIÓN DE LA CORTADA</div>
						<div class="panel-body">
							<form role="form" action="ingresa_cortada.php" method="post">
								<fieldset>
								<div class="form-group">
									<input type="hidden" name="id" value="<?php echo $id;?>">
									<label class="col-md-3 control-label" for="name">ID Control Tráfico:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" class="form-control" name="identificador">
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Fecha Autorización:</label>
									<div class="col-md-9">
									<input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="fecha" class="form-control" readonly value="<?php echo date("Y-m-d");?>">
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Hora Autorización:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;cursor:pointer" id="hora" name="hora" class="hora form-control" readonly value="<?php echo $hora?>">
									<script type="text/javascript">
										var clock = $('.hora');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script>
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Inspector de Turno:</label>
									<div class="col-md-9">
									<select class="form-control" style="background-color:#fff;color:#000" name="it">
										<option value="ALFREDO PÉREZ">ALFREDO PÉREZ</option>
										<option value="CARLOS GUERRA">CARLOS GUERRA</option>
										<option value="JOSÉ SOTO">JOSÉ SOTO</option>
										<option value="MARIO MONTOYA">MARIO MONTOYA</option>
									</select>
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Descripción Trabajo:</label>
									<div class="col-md-9">
									<textarea class="form-control" style="background-color:#c1c1c1;color:#000;text-transform:uppercase" name="descripcion" readonly><?php echo $descripcion?></textarea>
									</div>
									<br><br><br><br><br>
									<label class="col-md-3 control-label" for="name">Usuario:</label>
									<div class="col-md-9">
									<input type="text" class="form-control" style="background-color:#c1c1c1;color:#000;text-transform:uppercase" name="usuario" value="<?php echo $usuario;?>" readonly>
									</div>
									<br><br><br>
									<div class="col-md-9">
									<button type="submit" class="btn btn-primary">Registrar Cortada</button>
									</div>
								</div>
							</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->

		<div class="row">
			
		</div><!--/.row-->

	</div>	<!--/.main-->

<script src="js/bootstrap-table.js"></script>
	
</body>

</html>
