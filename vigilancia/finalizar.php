<?php

include "../config.php";

$link = Conectarse();

session_start();

date_default_timezone_set("America/Santiago");

$id = $_GET["id"];

$nombre_informe = $_SESSION["nombre"]." ".$_SESSION["apellido_pat"];
$nombre_informe2 = strtoupper($nombre_informe);

$cargo = $_SESSION["cargo"];
$cargo2 = strtoupper($cargo);

$sql_denunciante = "SELECT * FROM vigilancia_denunciante WHERE id='$id'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result_denunciante = mysqli_query($link, $sql_denunciante)) die();

while($row_denunciante = mysqli_fetch_array($result_denunciante)) 
{
	$fecha_hora = $row_denunciante["fecha_hora"];
	$nombre = $row_denunciante["nombre"];
	$cedula_identidad = $row_denunciante["cedula_identidad"];
	$domicilio = $row_denunciante["domicilio"];
	$telefono = $row_denunciante["telefono"];
}

$sql_antecedentes = "SELECT * FROM vigilancia_antecedentes WHERE id_denunciante='$id'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result_antecedentes = mysqli_query($link, $sql_antecedentes)) die();

while($row_antecedentes = mysqli_fetch_array($result_antecedentes)) 
{
	$region = $row_antecedentes["region"];
	$comuna_sector = $row_antecedentes["comuna_sector"];
	$pk = $row_antecedentes["pk"];
	$fecha = strtotime($row_antecedentes["fecha"]);
	$ano=date("Y", $fecha);
	$mes=date("m", $fecha);
	$dia=date("d", $fecha);
	if ($mes=="01") {
		$mes="ENERO";
	}elseif ($mes=="02") {
		$mes="FEBRERO";
	}elseif ($mes=="03") {
		$mes="MARZO";
	}elseif ($mes=="04") {
		$mes="ABRIL";
	}elseif ($mes=="05") {
		$mes="MAYO";
	}elseif ($mes=="06") {
		$mes="JUNIO";
	}elseif ($mes=="07") {
		$mes="JULIO";
	}elseif ($mes=="08") {
		$mes="AGOSTO";
	}elseif ($mes=="09") {
		$mes="SEPTIEMBRE";
	}elseif ($mes=="10") {
		$mes="OCTUBRE";
	}elseif ($mes=="11") {
		$mes="NOVIEMBRE";
	}elseif ($mes=="12") {
		$mes="DICIEMBRE";
	}
	$hora = $row_antecedentes["hora"];
	$numero_parte = $row_antecedentes["numero_parte"];
	$unidad_policial = $row_antecedentes["unidad_policial"];
	$fiscalia_mp = $row_antecedentes["fiscalia_mp"];
	$tribunal = $row_antecedentes["tribunal"];
	$ruc = $row_antecedentes["ruc"];
	$rit = $row_antecedentes["rit"];
}

$sql_hechos = "SELECT * FROM vigilancia_hechos WHERE id_denunciante='$id'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result_hechos = mysqli_query($link, $sql_hechos)) die();

while($row_hechos = mysqli_fetch_array($result_hechos)) 
{
	$circunstancias = $row_hechos["circunstancias"];
	$testigos = $row_hechos["testigos"];
	$avaluo_especies = $row_hechos["avaluo_especies"];
}

$sql_fiscalia = "SELECT * FROM vigilancia_fiscalia WHERE id_denunciante='$id'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result_fiscalia = mysqli_query($link, $sql_fiscalia)) die();

while($row_fiscalia = mysqli_fetch_array($result_fiscalia)) 
{
	$nombre_fiscalia = $row_fiscalia["nombre"];
	$cargo_fiscalia = $row_fiscalia["cargo"];
	$telefono_fiscalia = $row_fiscalia["telefono"];
	$celular_fiscalia = $row_fiscalia["celular"];
	$email_fiscalia = $row_fiscalia["email"];
}

$sql_imputados = "SELECT * FROM vigilancia_imputados WHERE id_denunciante='$id'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result_imputados = mysqli_query($link, $sql_imputados)) die();


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
			<li class="active"><a href="ingresar_fchd1.php"><span class="glyphicon glyphicon-tags"></span> Registrar Hecho Delictual</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-book"></span> #</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> #</a></li>
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
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Inicio</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Vigilancia</h1>
				<h2 class="page-header">Resumen Hecho Delictual Número <?php echo $id; ?></h2>
			</div>
		</div><!--/.row-->
		
		<div class="row col-no-gutter-container">

			<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<form role="form" action="procesa_fchd4.php" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">Denunciante</div>
						<div class="panel-body">
						<table>
							<tr>
  								<td>Fecha y Hora de Ingreso al Sistema:&nbsp;&nbsp;&nbsp;</td>
  								<td><?php echo $fecha_hora;?></td>
							</tr>
							<tr>
								<td>Nombre: </td>
								<td><?php echo $nombre;?></td>
							</tr>
							<tr>
								<td>Cédula de Identidad: </td>
								<td><?php echo $cedula_identidad;?></td>
							</tr>
							<tr>
								<td>Domicilio: </td>
								<td><?php echo $domicilio;?></td>
							</tr>
							<tr>
								<td>Teléfono:</td>
								<td><?php echo $telefono;?></td>
							</tr>
						</table>
						</div>
						<br>
						<div class="panel-heading">Antecedentes Generales</div>
						<div class="panel-body">
						<table>
							<tr>
  								<td style="width:227px">Región:</td>
  								<td><?php echo $region;?></td>
							</tr>
							<tr>
  								<td>Comuna/Sector:</td>
  								<td><?php echo $comuna_sector;?></td>
							</tr>
							<tr>
  								<td>PK:</td>
  								<td><?php echo $pk;?></td>
							</tr>
							<tr>
  								<td>Fecha y Hora:</td>
  								<td><?php echo $dia." DE ".$mes." DEL ".$ano." A LAS ".$hora;?></td>
							</tr>
							<tr>
  								<td>Número de Parte:</td>
  								<td><?php echo $numero_parte;?></td>
							</tr>
							<tr>
  								<td>Unidad Policial:</td>
  								<td><?php echo $unidad_policial;?></td>
							</tr>
							<tr>
  								<td>Fiscalía Ministerio Público:</td>
  								<td><?php echo $fiscalia_mp;?></td>
							</tr>
							<tr>
  								<td>Tribunal:</td>
  								<td><?php echo $tribunal;?></td>
							</tr>
							<tr>
  								<td>RUC:</td>
  								<td><?php echo $ruc;?></td>
							</tr>
							<tr>
  								<td>RIT:</td>
  								<td><?php echo $rit;?></td>
							</tr>
						</table>
						</div>
						<br>
						<div class="panel-heading">Hechos</div>
						<div class="panel-body">
						<table>
							<tr>
  								<td style="width:227px">Circunstancias:</td>
  								<td><?php echo $circunstancias;?></td>
							</tr>
							<tr>
  								<td>Testigos:</td>
  								<td><?php echo $testigos;?></td>
							</tr>
							<tr>
  								<td>Avalúo Especies:</td>
  								<td><?php echo $avaluo_especies;?></td>
							</tr>
						</table>
						</div>
						<br>
						<div class="panel-heading">Imputados</div>
						<div class="panel-body">
							<?php 
							while($row_imputados = mysqli_fetch_array($result_imputados)) 
							{
								echo "<table>
									<tr>
										<td style='width:227px'>Nombre: </td>
										<td>".$row_imputados["nombre"]."</td>
									</tr>
									<tr>
										<td>Cédula de Identidad: </td>
										<td>".$row_imputados["cedula_identidad"]."</td>
									</tr>
									<tr>
										<td>Ocupación: </td>
										<td>".$row_imputados["ocupacion"]."</td>
									</tr>
										<td>Domicilio: </td>
										<td>".$row_imputados["domicilio"]."</td>
									</tr>
										</table><hr>";
							}
							?>

						</div>
						<br>
						<div class="panel-heading">Fiscalía</div>
						<div class="panel-body">
						<table>
							<tr>
  								<td style="width:227px">Nombre:</td>
  								<td><?php echo $nombre_fiscalia;?></td>
							</tr>
							<tr>
  								<td>Cargo:</td>
  								<td><?php echo $cargo_fiscalia;?></td>
							</tr>
							<tr>
  								<td>Teléfono:</td>
  								<td><?php echo $telefono_fiscalia;?></td>
							</tr>
							<tr>
  								<td>Celular:</td>
  								<td><?php echo $celular_fiscalia;?></td>
							</tr>
							<tr>
  								<td>E-mail:</td>
  								<td><?php echo $email_fiscalia;?></td>
							</tr>
						</table>
						</div>
						<br>
						<div class="panel-heading">Generador del Informe</div>
						<div class="panel-body">
						<table>
							<tr>
  								<td style="width:227px">Nombre:</td>
  								<td><?php echo $nombre_informe2;?></td>
							</tr>
							<tr>
  								<td>Cargo:</td>
  								<td><?php echo $cargo2;?></td>
							</tr>
							<tr>
  								<td>Email:</td>
  								<td><?php echo $_SESSION["email"];?></td>
							</tr>
						</table>
						</div>
					</div>
				</form>
			</div>

		</div><!--/.row-->

		</div>
		
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
