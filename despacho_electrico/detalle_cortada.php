<?php


include "../config.php";

$link = Conectarse();

session_start();

$id=$_GET['id'];

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$sql = "SELECT * FROM despacho_solicitud WHERE id='$id'";
mysqli_set_charset($link, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($link, $sql)) die();

while($row = mysqli_fetch_array($result)) 
{
	$desde_fecha=$row['desde_fecha'];
	$desde_hora=$row['desde_hora'];
	$hasta_fecha=$row['hasta_fecha'];
	$hasta_hora=$row['hasta_hora'];
	$block=$row['block'];
	$tipo=$row['tipo'];
	$circulacion_trenes=$row['circulacion_trenes'];
	$vias=$row['vias'];
	$desde_sector=$row['desde_sector'];
	$hasta_sector=$row['hasta_sector'];
	$empresa=$row['empresa'];
	$encargados=$row['encargados'];
	$telefonos=$row['telefonos'];
	$descripcion=$row['descripcion'];
	$aprobacion=$row['aprobacion'];
	$fecha_ingreso=$row['fecha_ingreso'];
	$despachador=$row['despachador'];
	$estado=$row['estado'];
}
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
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Datos Cortada Solicitada</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Desde:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $desde_fecha." ".$desde_hora;?>" class="form-control">
									</div>
								</div>
							
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Hasta:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $hasta_fecha." ".$hasta_hora;?>" class="form-control">
									</div>
								</div>
								
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Block:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $block;?>" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Tipo:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $tipo;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Circulación Trenes:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $circulacion_trenes;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Vías:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $vias;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Sector Desde:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $desde_sector;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Sector Hasta:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $hasta_sector;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Empresa:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $empresa;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Encargados:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $encargados;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Teléfonos:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $telefonos;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Descripción:</label>
									<div class="col-md-9">
									<textarea style="background-color:#fff;color:#000" readonly="true" type="text" class="form-control"><?php echo $descripcion;?>
									</textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Aprueba D.E:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $aprobacion;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Fecha Ingreso Sistema:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $fecha_ingreso;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Despachador:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $despachador;?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Estado:</label>
									<div class="col-md-9">
									<input style="background-color:#fff;color:#000" readonly="true" type="text" value="<?php echo $estado;?>" class="form-control">
									</div>
								</div>

								<!-- Form actions -->
								
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			
		</div>

		<div class="row col-no-gutter-container row-margin-top">
			
		</div><!--/.row-->
		
		<div class="row col-no-gutter-container row-margin-top">
			
		</div><!--/.row-->

		<div class="row">
			
		</div><!--/.row-->

		<div class="row">
			
		</div><!--/.row-->	
	</div>	<!--/.main-->

</body>

</html>
