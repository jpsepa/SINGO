<?php 
  
session_start();

include "config.php";

$link = Conectarse();

$dat = "SELECT * FROM despacho_empresas";
$sql = mysqli_query($link, $dat);


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
			<li class="active"><a href="solicitud_cortada.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Registrar Telegrama</a></li>
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
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Solicitud Cortada</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Solicitud de Cortada</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">INGRESE LA SOLICITUD DE LA CORTADA</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" action="ingresa_cortadas.php" method="post">
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Desde:</label>
									<div class="col-md-9">
									<input data-provide="datepicker" name="desde_fecha" readonly value="<?php echo date("Y-m-d");?>">&nbsp;&nbsp;&nbsp;<input type="text" id="desde_hora" name="desde_hora" class="hora-control" readonly value="00:00">
									<script type="text/javascript">
										var clock = $('.hora-control');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script>
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Hasta:</label>
									<div class="col-md-9">
									<input data-provide="datepicker" name="hasta_fecha" readonly value="<?php echo date("Y-m-d");?>">&nbsp;&nbsp;&nbsp;<input type="text" id="hasta_hora" name="hasta_hora" class="hora-control2" readonly value="00:00">
									<script type="text/javascript">
										var clock = $('.hora-control2');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script>
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Block:</label>
									<div class="col-md-9">
									<input type="text" style="width:46.7%;text-transform:uppercase" name="block">
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Tipo:</label>
									<div class="col-md-9">
									<input type="text" style="width:46.7%;text-transform:uppercase" name="tipo">
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Circulación de Trenes:</label>
									<div class="col-md-9">
									<select style="width:46.7%" name="circulacion_trenes">
										<option value="CON PASADA DE TRENES">CON PASADA DE TRENES</option>
										<option value="SIN PASADA DE TRENES">SIN PASADA DE TRENES</option>
									</select>
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Vías:</label>
									<div class="col-md-9">
									<select style="width:46.7%" name="vias">
										<option value="SIMPLE VÍA">SIMPLE VÍA</option>
										<option value="DOBLE VÍA">DOBLE VÍA</option>
										<option value="AMBAS VÍAS">AMBAS VÍAS</option>
										<option value="TODAS">TODAS</option>
									</select>
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Empresa:</label>
									<div class="col-md-9">
									<select style="width:46.7%" name="empresa">
										<?php
 										while($lista=mysqli_fetch_array($sql))
										 echo "<option  value='".$lista["nombre"]."'>".$lista["nombre"]."</option>"; 
										?>
									</select>
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Encargados:</label>
									<div class="col-md-9">
									<input type="text" style="width:46.7%;text-transform:uppercase" name="encargados">
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Teléfonos:</label>
									<div class="col-md-9">
									<input type="text" style="width:46.7%;text-transform:uppercase" name="telefonos">
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Descripción Trabajos:</label>
									<div class="col-md-9">
									<input type="text" style="width:46.7%;text-transform:uppercase" name="descripcion">
									</div>
									<br><br>
									<label class="col-md-3 control-label" for="name">Aprobación Despacho Eléctrico:</label>
									<div class="col-md-9">
										<label>
											<input type="radio" name="aprobacion" id="si" value="Si" checked> Si
										</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label>
											<input type="radio" name="aprobacion" id="no" value="No"> No
										</label>
									</div>
									<br><br><br>
									<div class="col-md-9">
									<button type="submit" class="btn btn-primary">Ingresar Cortada</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Cortadas Solicitadas</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="cortadas_registradas.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="desde_fecha" data-sortable="true">Desde</th>
						        <th data-field="hasta_fecha" data-sortable="true">Hasta</th>
						        <th data-field="block" data-sortable="true">Block</th>
						        <th data-field="tipo" data-sortable="true">Tipo</th>
						        <th data-field="circulacion_trenes" data-sortable="true">Circulación Trenes</th>
						        <th data-field="vias" data-sortable="true">Vías</th>
						        <th data-field="empresa" data-sortable="true">Empresa</th>
						        <th data-field="encargados" data-sortable="true">Encargado</th>
						        <th data-field="descripcion" data-sortable="true">Descripción Trabajos</th>
						        <th data-field="aprobacion" data-sortable="true">Aprobación Despacho Eléctrico</th>
						    </tr>
						    </thead>
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
