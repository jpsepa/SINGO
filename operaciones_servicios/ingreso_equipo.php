<?php

include "fallas.php";

$link = Conectarse();

session_start();

if(!$_SESSION['logeado']==1)
	header("Location: ../login.php");

date_default_timezone_set("America/Santiago");

$equipos = mysqli_query($link, "SELECT id, nombre FROM operaciones_equipos ORDER BY id ASC");

$ingreso = $_GET['ingreso'];

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
<script type="text/javascript">
	function justNumbers(e)
    {
    	var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
             
        return /\d/.test(String.fromCharCode(keynum));
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$("#cboFallas").change(function() {
			var falla = $(this).val();
			
			if(falla > 0)
			{
		        var datos = {
		            id : $(this).val()  
		        };

		        $.post("subcategorias.php", datos, function(subcategorias) {
	        	
				  	var $comboSubcategorias = $("#cbosubcategoria");
	                $comboSubcategorias.empty();
	                $.each(subcategorias, function(index, subcategoria) {
	                	//
	                    $comboSubcategorias.append("<option value='"+ subcategoria.id +"'>" + subcategoria.nombre + "</option>");
	                });
				}, 'json');
			}
			else
			{
				var $comboSubcategorias = $("#cbosubcategoria");
	            $comboSubcategorias.empty();
				$comboSubcategorias.append("<option>SELECCIONE UNA FALLA</option>");
			}
		});
	}); 
</script>

<script>
	$(document).ready(function(){
		$("#cbtipoequipo").change(function() {
			var equipo = $(this).val();
				
			if(equipo > 0)
			{
		        var datos = {
		            id : $(this).val()  
		        };

		        $.post("numeros_equipos.php", datos, function(numeros_equipos) {
		        	
				  	var $comboNumerosEquipos = $("#cbnumeroequipo");
	                $comboNumerosEquipos.empty();
	                $.each(numeros_equipos, function(index, numeros_equipos) {
                	//
                    $comboNumerosEquipos.append("<option value='"+ numeros_equipos.id +"'>" + numeros_equipos.numero + "</option>");
	                });
				}, 'json');
			}
			else
			{
				var $comboSubcategorias = $("#cbnumeroequipo");
                $comboSubcategorias.empty();
				$comboSubcategorias.append("<option>SELECCIONE UN NÚMERO DE EQUIPO</option>");
			}
		});
	}); 
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
				<h3><?php echo utf8_encode($_SESSION['nombre'])." ". utf8_encode($_SESSION['apellido_pat']);?></h3>
				<h4><?php echo $_SESSION['cargo'];?></h4>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li class="active"><a href="ingreso_equipo.php"><span class="glyphicon glyphicon-wrench"></span> Ingresar Equipo</a></li>
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
				<li class="active">Ingresar Equipo</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Operaciones de Servicios</h1>
				<h2 class="page-header">Ingresar Equipo a Maestranza</h2>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
			<?php
				if($ingreso=="exitoso")
				{
					echo "<div id='success' class='alert bg-success' style='width:100%;text-align:left;background-color:#266916' role='alert'>
					<span class='glyphicon glyphicon-check'></span> EQUIPO INGRESADO CON ÉXITO
				<a href='#' onclick='ocultar()' class='pull-right'><span class='glyphicon glyphicon-remove'></span></a></div>";
				}elseif($ingreso=="retiro"){
					echo "<div id='success' class='alert bg-success' style='width:100%;text-align:left;background-color:#266916' role='alert'>
					<span class='glyphicon glyphicon-check'></span> EQUIPO RETIRADO CON ÉXITO
				<a href='#' onclick='ocultar()' class='pull-right'><span class='glyphicon glyphicon-remove'></span></a></div>";
				}
			?>
				<form role="form" action="procesa_ingreso_equipo.php" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">Ingrese datos del Equipo</div>
						<div class="panel-body">
						<table style="border:0;width:100%">
							<thead>
					    		<tr>
					        		<th><label>Fecha de Ingreso:</label></th>
					        		<th><input data-provide="datepicker" style="background-color:#fff;color:#000;cursor:pointer" name="fecha_ingreso" class="form-control" value="<?php echo date("Y-m-d"); ?>"></th>
					        		<th><label style="text-align: center">&nbsp;&nbsp;&nbsp;Hora de Ingreso:</label></th>
					        		<th><input type="text" style="background-color:#fff;color:#000" id="hora_inicio" name="hora_ingreso" class="hora-control1 form-control" value="<?php echo date("G:i"); ?>">
									<script type="text/javascript">
										var clock = $('.hora-control1');
										clock.clockpicker({
    									autoclose: true
										});
										// minutes
										clock.clockpicker('show').clockpicker('toggleView', 'minutes');
									</script></th>
									<th><label>&nbsp;&nbsp;&nbsp;Motivo:</label></th>
									<th><select style="background-color:#fff;color:#000;cursor:pointer;text-transform:uppercase" name="motivo_ingreso" id="cboFallas" class="form-control">
											<option value="0">SELECCIONE UNA FALLA</option>
                								<?php
                    								$fallas = obtenerTodasLasFallas();
                    								foreach ($fallas as $falla)
                    								{ 
                        								echo '<option value="'.$falla->id.'">'.$falla->nombre_falla.'</option>';        
                    								}
                								?>
										</select>
									</th>
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
					        		<th><label>Subcategoría:</label></th>
					        		<th><select class="form-control" style="background-color:#fff;color:#000;cursor:pointer;text-transform:uppercase" name="subcategoria" id="cbosubcategoria">
 											<option value="0">SELECCIONE UNA SUBCATEGORÍA</option>
										</select></th>
									<th><label style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lugar:</label></th>
									<th><input style="background-color:#fff;color:#000;text-transform:uppercase" name="lugar" class="form-control" placeholder="Ingrese un Lugar"></th>
					    			<th><label>&nbsp;&nbsp;&nbsp;Descripción&nbsp;&nbsp;&nbsp;Falla:</label></th>
					    			<th><input style="background-color:#fff;color:#000;text-transform:uppercase" name="descripcion_falla" class="form-control" placeholder="Ingrese una Descripción de la Falla"></th>
					    		</tr>
					    		<tr>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
								</tr>
					    		<tr>
					    			<th><label>Tipo de Equipo:</label></th>
					        		<th><select class="form-control" style="background-color:#fff;color:#000;cursor:pointer" name="tipo_equipo" id="cbtipoequipo">
 											<option value="0">SELECCIONE UN TIPO DE EQUIPO</option>
 												<?php
												while($row_equipos=mysqli_fetch_array($equipos))
   													echo "<option value='".$row_equipos["id"]."'>".$row_equipos["nombre"]."</option>"; 
												?>
										</select></th>
									<th><label style="text-align:center">&nbsp;&nbsp;&nbsp;Número Equipo:</label></th>
									<th><select class="form-control" style="background-color:#fff;color:#000;cursor:pointer" name="numero_equipo" id="cbnumeroequipo">
 											<option value="0">SELECCIONE UN NÚMERO DE EQUIPO</option>
										</select></th>
					    			<th><label>&nbsp;&nbsp;&nbsp;Usuario:</label></th>
					    			<th><input style="background-color:#b9b9ba;color:#000;text-transform:uppercase" name="usuario" class="form-control" value='<?php echo utf8_encode($_SESSION["nombre"]." ".$_SESSION["apellido_pat"]);?>' readonly></th>
					    		</tr>
							</tbody>
						</table>
						<br>
							<button type="submit" class="btn btn-default btn-md" style="background-color:#00438c">Registrar</button>
						</div>
					</div>
				</form>
			</div>
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Equipos en Maestranza</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="ingreso_equipo_array.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="fecha_hora_ingreso" data-sortable="true">Fecha y Hora de Ingreso</th>
						    	<th data-field="tipo_equipo" data-sortable="true">Tipo de Equipo</th>
						        <th data-field="numero_equipo" data-sortable="true">Número de Equipo</th>
						        <th data-field="id_falla" data-sortable="true">Motivo Falla</th>
						        <th data-field="id_subcategoria" data-sortable="true">Subcategoría Falla</th>
						        <th data-field="descripcion_falla" data-sortable="true">Descripción Falla</th>
						        <th data-field="lugar" data-sortable="true">Lugar donde Falló</th>
						        <th data-field="cant_dias" data-sortable="true">Cant. Días</th>
						        <th data-field="usuario" data-sortable="true">Usuario</th>
						        <th data-field="modificar" data-sortable="true"></th>
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
