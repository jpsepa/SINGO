<?php 
  
session_start();

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
	$despachador=$row['despachador'];
	$estado=$row['estado'];

}

$sql2 = "SELECT * FROM trafico_libro WHERE id_despacho_solicitud=$id";

if(!$result2 = mysqli_query($link, $sql2)) die();

while($row2 = mysqli_fetch_array($result2)) 
{ 
	$id_trafico_libro=$row2['id'];
	$numero_ct=$row2['numero_ct'];
	$nombre_it=$row2['nombre_it'];
}
	
//desconectamos la base de datos
$close = mysqli_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">INGRESE LA CORTADA AL LIBRO DE ACTA</div>
						<div class="panel-body">
							<form role="form" action="ingresa_libro.php" method="post">
								<fieldset>
								<div class="form-group">
									<input type="hidden" name="id_solicitud" value="<?php echo $id;?>">
									<input type="hidden" name="id_trafico_libro" value="<?php echo $id_trafico_libro;?>">
									<br>
									<label class="col-md-3 control-label" for="name">ID Control Tráfico:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#c1c1c1;color:#000;text-transform:uppercase" class="form-control" name="numero_ct" value="<?php echo $numero_ct;?>" readonly>
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Fecha:</label>
									<div class="col-md-9">
									<input data-provide="datepicker" name="fecha" class="form-control" readonly value="<?php echo date("Y-m-d");?>">
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Hora:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;cursor:pointer" id="hora" name="hora" class="hora form-control" readonly value="00:00">
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
									<label class="col-md-3 control-label" for="name">D.E.N/D.E.S:</label>
									<div class="col-md-9">
									<select class="form-control" style="background-color:#fff;color:#000" name="den_des">
										<option value="D.E.N.">D.E.N.</option>
										<option value="D.E.S.">D.E.S.</option>
									</select>
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">N° Cortada:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" class="form-control" name="ncortada">
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Despachador:</label>
									<div class="col-md-9">
									<input type="text" class="form-control" style="background-color:#c1c1c1;color:#000;text-transform:uppercase" name="despachador_solicitud" value="<?php echo utf8_encode($_SESSION['nombre']." ".$_SESSION['apellido_pat']);?>" readonly>
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Cortador:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" class="form-control" name="cortador">
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Inspector Turno:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#c1c1c1;color:#000;text-transform:uppercase" class="form-control" name="it" value="<?php echo $nombre_it;?>" readonly>
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Notificador:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" class="form-control" name="notificador">
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Descripción Trabajos:</label>
									<div class="col-md-9">
									<textarea style="background-color:#c1c1c1;color:#000;text-transform:uppercase" class="form-control" name="descripcion" readonly><?php echo $descripcion;?></textarea>
									</div>
									<br><br><br><br><br>
									<label class="col-md-3 control-label" for="name">Estado:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#c1c1c1;color:#000;text-transform:uppercase" class="form-control" name="estado" value="<?php echo $estado;?>" readonly>
									</div>
									<br><br><br>
									<label class="col-md-3 control-label" for="name">Despachador Solicitud:</label>
									<div class="col-md-9">
									<input type="text" class="form-control" style="background-color:#c1c1c1;color:#000;text-transform:uppercase" name="despachador_solicitud" value="<?php echo $despachador;?>" readonly>
									</div>
									<br><br><br><br>
									<div class="col-md-9">
									<button type="submit" class="btn btn-primary">Ingresar Cortada</button>
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
