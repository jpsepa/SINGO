<?php


include "../config.php";

$link = Conectarse();

session_start();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

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
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Bienvenido <?php echo $_SESSION['nombre']." ". utf8_encode($_SESSION['apellido_pat']);?></h2>
			</div>
		</div><!--/.row-->

		<div class="row">
			<form role="form" action="procesa_turno.php" method="post">
				<div class="panel panel-default">
					<div class="panel-heading">POR FAVOR SELECCIONA TURNO ASIGNADO:&nbsp;&nbsp;&nbsp;&nbsp;	<select style="background-color:#fff;color:#000;cursor:pointer;font-size:18px" name="turno">
 						<option value="DEN">D.E.N.</option>
 						<option value="DES">D.E.S.</option>
					</select></div>
					<div class="panel-body">
						<button type="submit" class="btn btn-default btn-md" style="background-color:#00438c">Seleccionar</button>
					</div>
				</div>
			</form>
			
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
