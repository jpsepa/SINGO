<?php

error_reporting(E_ERROR);

include "../config.php";

$link = Conectarse();

mysql_query("SET NAMES 'utf8'");

session_start();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

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
				<center><h2 style="color:#000"><b>Sistema Integrado De Gestión Operacional</b> - Gerencia de Operaciones</h2></center>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<h3><?php echo $_SESSION['nombre']." ".utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li class="active"><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_de_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="pendientes.php"><span class="glyphicon glyphicon-time"></span> Pendientes</a></li>
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
			<center>
			<div id='error' class='alert bg-danger' style='width:100%;text-align:left' role='alert'>
				<span class='glyphicon glyphicon-exclamation-sign'></span> Debe llenar todos los campos
				<a href='#' onclick='ocultar()' class='pull-right'><span class='glyphicon glyphicon-remove'></span></a>
			</div>
			</center>
			<a href="cortadas_solicitadas.php" type="submit" style="background:#0065ad" class="btn btn-primary">Revisa Aquí Las Cortadas Solicitadas</a><br><br>
				<div class="panel panel-default">
					<div class="panel-heading">Seleccione archivo con las cortadas del contratista</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form name="importa" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">			
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

									$cn=mysqli_connect('localhost', 'root', 'segundas', 'singo') or die ("Error en la Conexión");

									$objReader=new PHPExcel_Reader_Excel2007();
									$objPHPExcel=$objReader->load("bak_".$archivo);
									$objFecha=new PHPExcel_Shared_Date();

									$objPHPExcel->setActiveSheetIndex(0);

									$i=4;
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

										$fechaA=PHPExcel_Shared_Date::ExcelToPHP($A);
										$dateA=date('Y-m-d',$fechaA);

										$fechaB=PHPExcel_Shared_Date::ExcelToPHP($B);
										$dateB=date('H:i:s',$fechaB);

										$fechaC=PHPExcel_Shared_Date::ExcelToPHP($C);
										$dateC=date('Y-m-d',$fechaC);

										$fechaD=PHPExcel_Shared_Date::ExcelToPHP($D);
										$dateD=date('H:i:s',$fechaD);

										mysqli_query($cn,"INSERT INTO despacho_solicitud_temp (desde_fecha,desde_hora,hasta_fecha,hasta_hora,
												block,tipo,circulacion_trenes,vias,desde_sector,hasta_sector,empresa,encargados,telefonos,descripcion) VALUES ('$dateA','$dateB','$dateC','$dateD','$E',
												'$F','$G','$H','$I','$J','$K','$L','$M','$N')");

										$query2=("delete from despacho_solicitud_temp where block=''");
										mysqli_query($link,$query2);

										if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()==NULL)
										{
											$param=1;
										}

										$i++;

										$contador=$contador+1;
									}

									$totalingresos=$contador-1;
									header("Location: solicitud_cortada_temp.php");

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
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> INGRESE LA SOLICITUD DE LA CORTADA</div>
					<div class="panel-body">
						<form role="form" action="procesa_cortada_individual.php" method="post">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Desde:</label>
									<div class="col-md-9">
									<input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="desde_fecha" class="form-control" readonly value="<?php echo date("Y-m-d");?>">&nbsp;&nbsp;&nbsp;<input type="text" style="background-color:#fff;color:#000;cursor:pointer" id="desde_hora" name="desde_hora" class="hora-control form-control" readonly value="00:00">
									<script type="text/javascript">
										var clock = $('.hora-control');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script>
									</div>
								</div>
								<br><br><br><br><br>
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Hasta:</label>
									<div class="col-md-9">
									<input data-provide="datepicker" name="hasta_fecha" style="background-color:#fff;color:#000;cursor:pointer" class="form-control" readonly value="<?php echo date("Y-m-d");?>">&nbsp;&nbsp;&nbsp;<input type="text" style="background-color:#fff;color:#000;cursor:pointer" id="hasta_hora" name="hasta_hora" class="hora-control2 form-control" readonly value="00:00">
									<script type="text/javascript">
										var clock = $('.hora-control2');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script>
									</div>
								</div>
								<br><br><br><br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Block:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" name="block" class="form-control">
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Tipo:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" name="tipo" class="form-control">
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Circulación de Trenes:</label>
									<div class="col-md-9">
									<select class="form-control" style="background-color:#fff;color:#000" name="circulacion_trenes">
										<option value="CON PASADA DE TRENES">CON PASADA DE TRENES</option>
										<option value="SIN PASADA DE TRENES">SIN PASADA DE TRENES</option>
									</select>
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Vías:</label>
									<div class="col-md-9">
									<select class="form-control" style="background-color:#fff;color:#000" name="vias">
										<option value="SIMPLE VÍA">SIMPLE VÍA</option>
										<option value="DOBLE VÍA">DOBLE VÍA</option>
										<option value="AMBAS VÍAS">AMBAS VÍAS</option>
										<option value="TODAS">TODAS</option>
									</select>
								</div>
								<br><br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Desde Sector:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" name="desde_sector" class="form-control">
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Hasta Sector:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" name="hasta_sector" class="form-control">
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Empresa:</label>
									<div class="col-md-9">
									<select class="form-control" style="background-color:#fff;color:#000" name="empresa">
										<?php
 										while($lista=mysqli_fetch_array($sql))
										 echo "<option  value='".$lista["nombre"]."'>".$lista["nombre"]."</option>"; 
										?>
									</select>
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Encargados:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" name="encargados" class="form-control">
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Teléfonos:</label>
									<div class="col-md-9">
									<input type="text" style="background-color:#fff;color:#000;text-transform:uppercase" name="telefonos" class="form-control">
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Descripción Trabajos:</label>
									<div class="col-md-9">
									<textarea style="background-color:#fff;color:#000;text-transform:uppercase" name="descripcion" class="form-control"></textarea>
									</div>
								</div>
								<br><br><br><br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Aprobación Despacho Eléctrico:</label>
									<div class="col-md-9">
										<label>
											<input type="radio" name="aprobacion" id="si" value="SI" checked> Si
										</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label>
											<input type="radio" name="aprobacion" id="no" value="NO"> No
										</label>
									</div>
								</div>
								<br>
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md">Ingresar Cortada</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		
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
