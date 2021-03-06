<?php


include "../config.php";

$link = Conectarse();

session_start();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$user = $_SESSION["user"];

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
				<a class="navbar-brand" href="#"><img src="img/logo-tmsa.png"></a>
				<center><h2 style="color:#000"><b>Sistema Integrado de Gestión Operacional</b> - Gerencia de Operaciones</h2></center>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<h3><?php echo utf8_encode($_SESSION['nombre'])." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="ingreso_equipo.php"><span class="glyphicon glyphicon-wrench"></span> Ingresar Equipo</a></li>
			<?php if($_SESSION['cargo']=='Jefe DEspacho Eléctrico'){ echo "<li><a href='nuestro_equipo.php'><span class='glyphicon glyphicon-user'></span> Nuestro Equipo</a></li>";}else{echo "<li></li>";}?>
			<?php if($_SESSION['cargo']=='Jefe DEspacho Eléctrico'){ echo "<li><a href='objetivos.php'><span class='glyphicon glyphicon-tasks'></span> Objetivos</a></li>";}else{echo "<li></li>";}?>
			<?php if($_SESSION['area']=='Operaciones'){ echo "<li><a href='../index.php'><span class='glyphicon glyphicon-user'></span> Regresar</a></li>";}else{ echo "<li></li>";}?>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Inicio</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Operaciones de Servicios</h1>
				<h2 class="page-header">Indicadores</h2>
			</div>
		</div><!--/.row-->

		<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cantidad de Equipos ingresados en Maestranza
					<select onChange="mostrarResultados2(this.value);">
						<?php 
							for($i == 2010;$i<2020;$i++){
								if($i == 2015){
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								}else{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
							}
						?>
					</select>
					</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="grafico" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">
					<div class="panel-heading">Cantidad de Fallas por Tipo
					<select onChange="mostrarResultados2(this.value);">
						<?php 
							for($a == 2010;$a<2020;$a++){
								if($a == 2015){
									echo '<option value="'.$a.'" selected>'.$a.'</option>';
								}else{
									echo '<option value="'.$a.'">'.$a.'</option>';
								}
							}
						?>
					</select>
					</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="graficos" height="200" width="600"></canvas>
						</div>
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
	<script>
		$(document).ready(mostrarResultados(2015));
			function mostrarResultados(ano){
				$.ajax({
					type:'POST',
					url:'equipos_maestranza.php',
					data:'ano='+ano,
					success:function(data){

						var valores = eval(data);

						var e 	= valores[0];
						var f 	= valores[1];
						var m 	= valores[2];
						var a 	= valores[3];
						var ma 	= valores[4];
						var j 	= valores[5];
						var jl 	= valores[6];
						var ag 	= valores[7];
						var s 	= valores[8];
						var o 	= valores[9];
						var n 	= valores[10];
						var d 	= valores[11];

						var Datos = {
								labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
								datasets : [
									{
										fillColor : 'rgba(234,150,7,0.6)', //COLOR DE LAS BARRAS
										strokeColor : 'rgba(250,132,0,0.7)', //COLOR BORDE DE LAS BARRAS
										highlightFill : 'rgba(250,176,0,0.6)',
										highlightStroke : 'rgba(250,129,0,0.7)',
										data : [e, f, m, a, ma, j, jl, ag, s, o, n, d]
									}
								]
							}

						var contexto = document.getElementById('grafico').getContext('2d');
						window.Barra = new Chart(contexto).Bar(Datos, { responsive: true});
					}
				});
				return false;
			}
	</script>
	<script>
		$(document).ready(mostrarResultados2(2015));
			function mostrarResultados2(ano){
				$.ajax({
					type:'POST',
					url:'equipos_fallas.php',
					data:'ano='+ano,
					success:function(data){

						var valores = eval(data);

						var el 	= valores[0];
						var ne 	= valores[1];
						var me 	= valores[2];
						var es 	= valores[3];
						var aa 	= valores[4];

						var Datos = {
								labels : ['Falla Eléctrica', 'Falla Neumátca', 'Falla Mecánica', 'Falla Estructural', 'Falla Aire Acondicionado'],
								datasets : [
									{
										fillColor : 'rgba(234,150,7,0.6)', //COLOR DE LAS BARRAS
										strokeColor : 'rgba(250,132,0,0.7)', //COLOR BORDE DE LAS BARRAS
										highlightFill : 'rgba(250,176,0,0.6)',
										highlightStroke : 'rgba(250,129,0,0.7)',
										data : [el, ne, me, es, aa]
									}
								]
							}

						var contexto = document.getElementById('graficos').getContext('2d');
						window.Barra = new Chart(contexto).Bar(Datos, { responsive: true});
					}
				});
				return false;
			}
	</script>
</body>

</html>
