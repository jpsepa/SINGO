<?php 

error_reporting(E_ERROR);
  
session_start();

mysqli_set_charset($link, "utf8"); //formato de datos utf8

include "../config.php";

$link = Conectarse();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$id=$_GET['id'];

$result2=mysqli_query($link, "SELECT descripcion, responsable FROM objetivos WHERE id='$id'");
$row2=mysqli_fetch_array($result2);


$result3=mysqli_query($link, "SELECT * FROM objetivos_secundarios WHERE id_objetivos='$id'");

$suma_obj_secund=mysqli_query($link, "SELECT COUNT(*) FROM objetivos_secundarios WHERE id_objetivos='$id'");
$row_obj_secund=mysqli_fetch_array($suma_obj_secund);
$total_obj_secund=$row_obj_secund[0];

$suma_cumpl_real=mysqli_query($link, "SELECT SUM(cumpl_real) as cumplimiento_real FROM objetivos_secundarios WHERE id_objetivos='$id'");
$row_cumpl_real=mysqli_fetch_array($suma_cumpl_real);

$suma_cumpl_prog=mysqli_query($link, "SELECT SUM(cumpl_prog) as cumplimiento_prog FROM objetivos_secundarios WHERE id_objetivos='$id'");
$row_cumpl_prog=mysqli_fetch_array($suma_cumpl_prog);

$usuarios=mysqli_query($link, "SELECT * FROM usuarios");
$row_usuarios=mysql_fetch_array($usuarios); 

$prom_real=$row_cumpl_real['cumplimiento_real'] / $total_obj_secund;

$prom_prog=$row_cumpl_prog['cumplimiento_prog'] / $total_obj_secund;

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
				<h3><?php echo $_SESSION['nombre']." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
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
					<div class="panel-heading"><?php echo utf8_encode($row2['descripcion'])." ".utf8_encode($row2['responsable']);?></div>
					<div class="panel-body">
						<table data-toggle="table">
						    <thead>
						    OBJETIVOS SECUNDARIOS:<br><br>
						    <tr>
						        <th>Descripción</th>
						        <th>Responsable</th>
						        <th>Plazo</th>
						        <th>Cumplimiento Real</th>
						        <th>Cumplimiento Programado</th>
						        <th></th>
						    </tr>
						    </thead>
						    <?php
						    while ($row3 = mysqli_fetch_array($result3)) {
						    	echo "<tr>
						    	<td>".utf8_encode($row3['descripcion'])."</td>
						    	<td>".utf8_encode($row3['responsable'])."</td>
						    	<td>".$row3['plazo']."</td>
						    	<td>".$row3['cumpl_real']." %</td>
						    	<td>".$row3['cumpl_prog']." %</td>
						    	<td><a href='editar_objetivo_secundario.php?id=$id'>&#x270E;</a></td>
						    	</tr>
						    	";
						    }
						    ?>
							<tr>
							<td>TOTAL</td>
							<td></td>
							<td></td>
							<td><?php echo round($prom_real, 0)." %"; ?></td>
							<td><?php echo round($prom_prog, 0)." %";?></td>
						    </tr>
						</table>
					</div>
				</div>
				<form role="form" action="procesa_objetivos_secundarios.php" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">Agregar Objetivo Secundario</div>
						<div class="panel-body">
							<div class="form-group">
								<input type="hidden" name="id" class="form-control" value="<?php echo $id;?>">
							</div>	
							<div class="form-group">
								<label>Descripción</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="descripcion" class="form-control" placeholder="Ingrese una descripción">
							</div>								
							<div class="form-group">
								<label>Responsable</label>
								<select style="background-color:#fff;color:#000;text-transform:uppercase" name="responsable" class="form-control">
								<?php
								do {  	
								?>
          						<option value="<?php echo utf8_encode($row_usuarios['nombre'])." ".utf8_encode($row_usuarios['apellido_pat']);?>"><?php echo utf8_encode($row_usuarios['nombre'])." ".utf8_encode($row_usuarios['apellido_pat']);?></option>
          						<?php
								} while ($row_usuarios = mysqli_fetch_assoc($usuarios));
								?> 
								</select>
							</div>
							<div class="form-group">
								<label>Plazo</label>
								<input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="plazo" class="form-control" readonly value="">
							</div>
							<div class="form-group">
								<label>Cumplimiento Real</label>
								<select style="background-color:#fff;color:#000" name="cumpl_real" class="form-control">
								<option value="0">0 %</option>
								<option value="10">10 %</option>
								<option value="20">20 %</option>
								<option value="30">30 %</option>
								<option value="40">40 %</option>
								<option value="50">50 %</option>
								<option value="60">60 %</option>
								<option value="70">70 %</option>
								<option value="80">80 %</option>
								<option value="90">90 %</option>
								<option value="100">100 %</option>
								</select>
							</div>
							<div class="form-group">
								<label>Cumplimiento Programado</label>
								<select style="background-color:#fff;color:#000" name="cumpl_prog" class="form-control">
								<option value="0">0 %</option>
								<option value="10">10 %</option>
								<option value="20">20 %</option>
								<option value="30">30 %</option>
								<option value="40">40 %</option>
								<option value="50">50 %</option>
								<option value="60">60 %</option>
								<option value="70">70 %</option>
								<option value="80">80 %</option>
								<option value="90">90 %</option>
								<option value="100">100 %</option>
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
