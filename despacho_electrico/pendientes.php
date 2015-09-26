<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$categorias=mysqli_query($link, "SELECT * FROM despacho_categorias ORDER BY nombre_categoria ASC");

$user = $_SESSION["user"];

$turno = mysqli_query($link, "SELECT turno FROM sesiones WHERE id=(SELECT MAX(id) FROM sesiones) AND nombre='$user'");
$rows = mysqli_fetch_array($turno);
$turno2=$rows['turno'];

$ingreso=$_GET['ingreso'];

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
				<h3><?php echo utf8_encode($_SESSION['nombre'])." ".utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
				<h4>Turno: <?php echo $turno2;?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_de_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta <?php echo $turno2;?></a></li>
			<li><a href="libro_de_acta_todos.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="busqueda_avanzada.php"><span class="glyphicon glyphicon-search"></span> Búsqueda Avanzada</a></li>
			<li class="active"><a href="pendientes.php"><span class="glyphicon glyphicon-time"></span> Pendientes</a></li>
			<li><a href="cortadas_canceladas.php"><span class="glyphicon glyphicon-ban-circle"></span> Cortadas Canceladas</a></li>
			<?php if($_SESSION['cargo']=='Jefe DEspacho Eléctrico'){ echo "<li><a href='nuestro_equipo.php'><span class='glyphicon glyphicon-user'></span> Nuestro Equipo</a></li>";}else{echo "<li></li>";}?>
			<?php if($_SESSION['cargo']=='Jefe DEspacho Eléctrico'){ echo "<li><a href='objetivos.php'><span class='glyphicon glyphicon-tasks'></span> Objetivos</a></li>";}else{echo "<li></li>";}?>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-user'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ul class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Eventos Pendientes</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Eventos Pendientes</h2>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Listado de Eventos Pendientes</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="pendientes_array.php" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name">
						    <thead>
						    <tr>
						        <th data-field="fecha_inicio">Fecha y Hora Inicio</th>
						        <th data-field="fecha_termino">Fecha y Hora Término</th>
						        <th data-field="categoria">Categoría</th>
						        <th data-field="km_lugar">Km/Lugar</th>
						        <th data-field="den_des">DEN/DES</th>
						        <th data-field="descripcion">Descripción</th>
						        <th data-field="notificador">Notificador</th>
						        <th data-field="cerrar_pendiente">Cerrar Pendiente</th>
						        <?php
						        	if ($_SESSION['cargo']=="Jefe Despacho Eléctrico") {
						        		echo "
						        		<th data-field='usuario'>Usuario</th>
						        		<th data-field='fecha_hora'>Fecha Sistema</th>
						        		";
						        	}
						        ?>
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
<script type="text/javascript">
		function ocultar(){
		document.getElementById('success').style.display = 'none';}
	</script>
</body>

</html>
