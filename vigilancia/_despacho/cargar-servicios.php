<?php

error_reporting(E_ERROR);

include "config.php";

$link = Conectarse();

mysql_query("SET NAMES 'utf8'");

session_start();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tren Central - Sistema Integrado De Gestión Operacional</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="img/favicon.ico" rel="icon">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

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
				<center><h2 style="color:#000"><b>Sistema Integrado De Gestión Operacional</b> - Gerencia de Operaciones</h2></center>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<h3>Guillermo Ramírez</h3>
				<h4>Gerente de Operaciones</h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Resumen</a></li>
			<li class="active"><a href="cargar-servicios.php"><span class="glyphicon glyphicon-th"></span> Cargar Servicios</a></li>
			<li><a href="charts.html"><span class="glyphicon glyphicon-stats"></span> #</a></li>
			<li><a href="tables.html"><span class="glyphicon glyphicon-list-alt"></span> #</a></li>
			<li><a href="forms.html"><span class="glyphicon glyphicon-pencil"></span> #</a></li>
			<li><a href="buttons.html"><span class="glyphicon glyphicon-hand-up"></span> #</a></li>
			<li><a href="panels.html"><span class="glyphicon glyphicon-info-sign"></span> #</a></li>
			<li class="parent ">
				<a href="#">
					<span class="glyphicon glyphicon-list"></span> Administración <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span> 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-share-alt"></span> Sub Item 1
						</a>
					</li>
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-share-alt"></span> Sub Item 2
						</a>
					</li>
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-share-alt"></span> Sub Item 3
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="login.html"><span class="glyphicon glyphicon-user"></span> Desconectarse</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Cargar Servicios</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Cargar Servicios</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Seleccione archivo</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form">			
								<div class="form-group">
									<label>Debe ser archivo .xlsx</label>
									<input type="file" name="excel" /><br>
									<input type="submit" style="color:#000" name="enviar" value="Importar" />
									<input type="hidden" value="upload" name="action" />
									 <p class="help-block"></p>
								</div>
							</form>
							<?php
								$action='';
								extract($_POST);
								if ($action=='upload')
								{
									$archivo=$_FILES['excel']['name'];
									$tipo=$_FILES['excel']['type'];

									$destino="bak_".$archivo;

									if (copy($_FILES['excel']['tmp_name'],$destino))
									{
										echo "Archivo cargado exitosamente. ";
									}else{
										echo "Error al cargar el archivo. ";
									}

									if (file_exists("bak_".$archivo))
									{
										require_once '../Classes/PHPExcel.php';
										require_once '../Classes/PHPExcel/Reader/Excel2007.php';

										$cn=mysqli_connect('localhost', 'root', '', 'tesis') or die ("Error en la Conexión");

										$objReader=new PHPExcel_Reader_Excel2007();
										$objPHPExcel=$objReader->load("bak_".$archivo);
										$objFecha=new PHPExcel_Shared_Date();

										$objPHPExcel->setActiveSheetIndex(0);

										$i=1;
										$param=0;
										$contador=0;
										while($param==0)
										{
											$A=$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
											$B=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
											$C=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
											$D=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
											$E=$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
											$F=$objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
											$G=$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
											$H=$objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
											$I=$objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
											$J=$objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
											$K=$objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
											$L=$objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
											$M=$objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
											$N=$objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();

											$fechaK=PHPExcel_Shared_Date::ExcelToPHP($K);
											$dateK=date('Y-m-d H:i:s',$fechaK);

											$fechaL=PHPExcel_Shared_Date::ExcelToPHP($L);
											$dateL=date('Y-m-d H:i:s',$fechaL);

											$fechaM=PHPExcel_Shared_Date::ExcelToPHP($M);
											$dateM=date('Y-m-d H:i:s',$fechaM);

											$fechaN=PHPExcel_Shared_Date::ExcelToPHP($N);
											$dateN=date('Y-m-d H:i:s',$fechaN);

											$time_difference=strtotime($dateN)-strtotime($dateM);
											$minutes=round($time_difference/60);

											mysqli_query($cn,"INSERT INTO servicios_temporales (porteador,tren,prog_especial,circulacion,
												tipo_equipo,num_equipo,km_prog,km_reales,est_origen_real,est_destino_real,h_salida_prog,
												h_salida_real,h_llegada_prog,h_llegada_real,dif_minutos) VALUES ('$A','$B','$C','$D','$E',
												'$F','$G','$H','$I','$J','$dateK','$dateL','$dateM','$dateN','$minutes')");

											mysqli_query($cn,"DELETE FROM servicios_temporales WHERE porteador=''");

											if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()==NULL)
											{
												$param=1;
											}
											$i++;
											$contador=$contador+1;
										}

										$totalingresos=$contador-1;
										header("Location: index.php");
									}else{
										echo "Debe cargar el archivo";
									}
									unlink($destino);
								}
							?>
						</div>
						<div class="col-md-6">

						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>	
</body>

</html>
