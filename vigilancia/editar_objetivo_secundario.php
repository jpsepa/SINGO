<?php 

error_reporting(E_ERROR);
  
session_start();

mysqli_set_charset($link, "utf8"); //formato de datos utf8

include "../config.php";

$link = Conectarse();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$id=$_GET['id'];

$usuarios=mysqli_query($link, "SELECT * FROM usuarios");
$row_usuarios=mysql_fetch_array($usuarios); 

$result3=mysqli_query($link, "SELECT * FROM objetivos_secundarios WHERE id_objetivos='$id'");

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
				<form role="form" action="procesa_editar_objetivos_secundarios.php" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">Editar Objetivo Secundario</div>
						<div class="panel-body">
							<div class="form-group">
								<input type="hidden" name="id" class="form-control" value="<?php echo $id;?>">
							</div>
							<?php
						    while ($row3 = mysqli_fetch_array($result3)) {
						    ?>
						    <div class="form-group">
								<label>Descripción</label>
								<input style="background-color:#fff;color:#000;text-transform:uppercase" name="descripcion" class="form-control" placeholder="Ingrese una descripción" value="<?php echo utf8_encode($row3['descripcion']); ?>">
							</div>

							<div class="form-group">
								<label>Responsable</label>
								<select style="background-color:#fff;color:#000;text-transform:uppercase" name="responsable" class="form-control">
          						<option value="<?php echo $row3['responsable']; ?>"><?php echo $row3['responsable']; ?></option>
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
								<input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="plazo" class="form-control" readonly value="<?php echo $row3['plazo']; ?>">
							</div>

							<div class="form-group">
								<label>Cumplimiento Real</label>
								<select style="background-color:#fff;color:#000" name="cumpl_real" class="form-control">
								<option value="<?php echo $row3['cumpl_real']; ?>"><?php echo $row3['cumpl_real']; ?> %</option>
								<?php
								if ($row3['cumpl_real']=="0"){
									echo "";
								}else{
									echo "<option value='0'>0 %</option>";
								}
								if ($row3['cumpl_real']=="10"){
									echo "";
								}else{
									echo "<option value='10'>10 %</option>";
								}
								if ($row3['cumpl_real']=="20"){
									echo "";
								}else{
									echo "<option value='20'>20 %</option>";
								}
								if ($row3['cumpl_real']=="30"){
									echo "";
								}else{
									echo "<option value='30'>30 %</option>";
								}
								if ($row3['cumpl_real']=="40"){
									echo "";
								}else{
									echo "<option value='40'>40 %</option>";
								}
								if ($row3['cumpl_real']=="50"){
									echo "";
								}else{
									echo "<option value='50'>50 %</option>";
								}
								if ($row3['cumpl_real']=="60"){
									echo "";
								}else{
									echo "<option value='60'>60 %</option>";
								}
								if ($row3['cumpl_real']=="70"){
									echo "";
								}else{
									echo "<option value='70'>70 %</option>";
								}
								if ($row3['cumpl_real']=="80"){
									echo "";
								}else{
									echo "<option value='80'>80 %</option>";
								}
								if ($row3['cumpl_real']=="90"){
									echo "";
								}else{
									echo "<option value='90'>90 %</option>";
								}
								if ($row3['cumpl_real']=="100"){
									echo "";
								}else{
									echo "<option value='100'>100 %</option>";
								}
								?>
								</select>
							</div>
							<div class="form-group">
								<label>Cumplimiento Programado</label>
								<select style="background-color:#fff;color:#000" name="cumpl_prog" class="form-control">
								<option value="<?php echo $row3['cumpl_prog']; ?>"><?php echo $row3['cumpl_prog']; ?> %</option>
								<?php
								if ($row3['cumpl_prog']=="0"){
									echo "";
								}else{
									echo "<option value='0'>0 %</option>";
								}
								if ($row3['cumpl_prog']=="10"){
									echo "";
								}else{
									echo "<option value='10'>10 %</option>";
								}
								if ($row3['cumpl_prog']=="20"){
									echo "";
								}else{
									echo "<option value='20'>20 %</option>";
								}
								if ($row3['cumpl_prog']=="30"){
									echo "";
								}else{
									echo "<option value='30'>30 %</option>";
								}
								if ($row3['cumpl_prog']=="40"){
									echo "";
								}else{
									echo "<option value='40'>40 %</option>";
								}
								if ($row3['cumpl_prog']=="50"){
									echo "";
								}else{
									echo "<option value='50'>50 %</option>";
								}
								if ($row3['cumpl_prog']=="60"){
									echo "";
								}else{
									echo "<option value='60'>60 %</option>";
								}
								if ($row3['cumpl_prog']=="70"){
									echo "";
								}else{
									echo "<option value='70'>70 %</option>";
								}
								if ($row3['cumpl_prog']=="80"){
									echo "";
								}else{
									echo "<option value='80'>80 %</option>";
								}
								if ($row3['cumpl_prog']=="90"){
									echo "";
								}else{
									echo "<option value='90'>90 %</option>";
								}
								if ($row3['cumpl_prog']=="100"){
									echo "";
								}else{
									echo "<option value='100'>100 %</option>";
								}
								?>
								</select>
							</div>

						    <?php
						    }
						    ?>								
							<button type="submit" class="btn btn-default btn-md">Modificar</button>
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
