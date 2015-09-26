<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$categorias=mysqli_query($link, "SELECT * FROM despacho_categorias ORDER BY nombre_categoria ASC");

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

$user = $_SESSION["user"];

$turno = mysqli_query($link, "SELECT turno FROM sesiones WHERE id=(SELECT MAX(id) FROM sesiones) AND nombre='$user'");
$rows = mysqli_fetch_array($turno);
$turno2=$rows['turno'];

$id = $_GET['id'];

$sql = "SELECT * FROM despacho_libro_acta WHERE id='$id'";

if(!$result = mysqli_query($link, $sql)) die();

while($row = mysqli_fetch_array($result)) 
{ 
	$fecha_inicio = $row["fecha_inicio"];
	$hora_inicio = $row["hora_inicio"];
	$fecha_termino = $row["fecha_termino"];
	$hora_termino = $row["hora_termino"];
	$categoria = $row["categoria"];
	$km_lugar = $row["km_lugar"];
	$den_des = $row["den_des"];
	$descripcion = $row["descripcion"];
	$notificador = $row["notificador"];
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
<script>
function funcionsi(){
	document.modificar.fecha_termino.style.backgroundColor = "#fff";
	document.modificar.fecha_termino.value = "<?php echo date('Y-m-d'); ?>";
	document.modificar.fecha_termino.disabled = false;

	document.modificar.hora_termino.style.backgroundColor = "#fff";
	document.modificar.hora_termino.disabled = false;
}
</script>  
<script>
function funcionno(){
	document.modificar.fecha_termino.style.backgroundColor = "#b9b9ba";
	document.modificar.fecha_termino.value = "<?php echo $fecha_termino; ?>";
	document.modificar.fecha_termino.disabled = true;

	document.modificar.hora_termino.style.backgroundColor = "#b9b9ba";
	document.modificar.hora_termino.value = "<?php echo $hora_termino; ?>";
	document.modificar.hora_termino.disabled = true;
}
</script>  

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
				<h4>Turno: <?php echo $turno2;?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li class="active"><a href="libro_de_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li><a href="libro_de_acta_todos.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta <?php echo $turno2;?></a></li>
			<li><a href="busqueda_avanzada.php"><span class="glyphicon glyphicon-search"></span> Búsqueda Avanzada</a></li>
			<li><a href="pendientes.php"><span class="glyphicon glyphicon-time"></span> Pendientes</a></li>
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
				<li class="active">Libro Acta</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Libro de Acta</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
			<?php
				if($ingreso=="exitoso")
				{
					echo "<div id='success' class='alert bg-success' style='width:100%;text-align:left;background-color:#266916' role='alert'>
					<span class='glyphicon glyphicon-check'></span> EVENTO INGRESADO CON ÉXITO
				<a href='#' onclick='ocultar()' class='pull-right'><span class='glyphicon glyphicon-remove'></span></a></div>";
				}
			?>
				<form role="form" name="modificar" action="actualiza_registro.php" method="post">
					<div class="panel panel-default">
					<input type="hidden" name="id" value="<?php echo $id;?>">
						<div class="panel-heading">Modificar Evento Libro de Acta</div>
						<div class="panel-body">
						<table style="border:0;width:100%">
							<thead>
					    		<tr>
					        		<th><label>Fecha Inicio:</label></th>
					        		<th><input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="fecha" class="form-control" value="<?php echo $fecha_inicio; ?>"></th>
					        		<th><label>&nbsp;&nbsp;&nbsp;Hora de Inicio:</label></th>
					        		<th><input type="text" style="background-color:#fff;color:#000" id="hora_inicio" name="hora_inicio" class="hora-control1 form-control" value="<?php echo $hora_inicio; ?>">
									<script type="text/javascript">
										var clock = $('.hora-control1');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script></th>
									<th><label>&nbsp;&nbsp;&nbsp;Km/Lugar:</label></th>
									<th><input style="background-color:#fff;color:#000;text-transform:uppercase" name="km_lugar" class="form-control" placeholder="Ingrese un Kilómetro o Lugar" value="<?php echo $km_lugar;?>"></th>
					    		</tr>
							</thead> 
							<tbody>
								<tr>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
								</tr>
					    		<tr>
					        		<th><label>Categoría:</label></th>
					        		<th><select class="form-control" style="background-color:#fff;color:#000;cursor:pointer" name="categoria">
 											<?php
 												echo "<option value='".utf8_encode($categoria)."'>".utf8_encode($categoria)."</option>";
													while($row_categorias=mysqli_fetch_array($categorias)){
														if(utf8_encode($categoria)==utf8_encode($row_categorias["nombre_categoria"])){
															echo "";
														}else{
   															echo "<option  value='".utf8_encode($row_categorias["nombre_categoria"])."'>".utf8_encode($row_categorias["nombre_categoria"])."</option>";
   														}
   													} 
											?>
										</select></th>
									<th><label>&nbsp;&nbsp;&nbsp;DEN/DES:</label></th>
									<th><input style="background-color:#fff;color:#000;text-transform:uppercase" name="den_des" class="form-control" placeholder="Ingrese un DEN/DES. Ej: DEN #450" value="<?php echo $den_des;?>"></th>
					    			<th><label>&nbsp;&nbsp;&nbsp;Notificador:</label></th>
					    			<th><input style="background-color:#fff;color:#000;text-transform:uppercase" name="notificador" class="form-control" placeholder="Ingrese el nombre de quien Notifica el hecho" value="<?php echo utf8_encode($notificador);?>"></th>
					    		</tr>
					    		<tr>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
								</tr>
							</tbody>
						</table>
						<table style="width:100%">
							<thead>
								<tr>
									<th style="width:88px"><label>Descripción:</label></th>
									<th><textarea style="background-color:#fff;color:#000;text-transform:uppercase" name="descripcion" class="form-control"><?php echo utf8_encode($descripcion);?></textarea></th>
								</tr>
								<tr>
									<th style="width:88px"><label>¿Cerrar el Evento?</label></th>
									<th><input type="radio" name="cerrar_evento" id="si" value="Si" onclick="funcionsi()"> Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cerrar_evento" id="no" value="No" checked onclick="funcionno()"> No</th>
								</tr>
							</thead>
						</table>
						<table style="width:100%">
							<thead>
								<tr>
									<th style="width:88px">Fecha Término:</th>
									<th><input data-provide="datepicker" style="background-color:#b9b9ba;color:#000;cursor:pointer" name="fecha_termino" class="form-control" disabled="true" value="<?php echo $fecha_termino; ?>"></th>
									<th style="width:88px;text-align:center">Hora Término:</th>
									<th><input type="text" style="background-color:#b9b9ba;color:#000" name="hora_termino" class="hora-control2 form-control" disabled="true"  value="<?php echo $hora_termino; ?>">
									<script type="text/javascript">
										var clock = $('.hora-control2');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script></th>
								</tr>
							</thead> 
						</table>
						<br>
							<button type="submit" class="btn btn-default btn-md" style="background-color:#00438c">Modificar Registro</button>
						</div>
					</div>
				</form>
			</div>
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Registros del Libro de Acta</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="libro_de_acta_array.php" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name">
						    <thead>
						    <tr>
						        <th data-field="fecha_inicio">Fecha y Hora Inicio</th>
						        <th data-field="fecha_termino">Fecha y Hora Término</th>
						        <th data-field="categoria">Categoría</th>
						        <th data-field="km_lugar">Km/Lugar</th>
						        <th data-field="den_des">DEN/DES</th>
						        <th data-field="descripcion">Descripción</th>
						        <th data-field="notificador">Notificador</th>
						        <th data-field="modificar"></th>
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
