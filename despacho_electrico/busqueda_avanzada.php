<?php 
  
session_start();

include "../config.php";

$link = Conectarse();

date_default_timezone_set("America/Santiago");

$categorias=mysqli_query($link, "SELECT * FROM despacho_categorias ORDER BY nombre_categoria ASC");

$evento=mysqli_query($link, "SELECT * FROM despacho_libro_acta ORDER BY fecha_hora DESC LIMIT 10");

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
function funcion(){
    if(document.criterios.habilita_criterios.checked == false){
        document.criterios.fecha_inicio.disabled = true;
        document.criterios.fecha_inicio.style.backgroundColor = "#b9b9ba";
        document.criterios.fecha_inicio.value = "";

        document.criterios.categorias.disabled = true;
        document.criterios.categorias.style.backgroundColor = "#b9b9ba";
        document.criterios.categorias.value = "";

        document.criterios.km_lugar.disabled = true;
        document.criterios.km_lugar.style.backgroundColor = "#b9b9ba";
        document.criterios.km_lugar.value = "";

        document.criterios.den_des.disabled = true;
        document.criterios.den_des.style.backgroundColor = "#b9b9ba";
        document.criterios.den_des.value = "";

		document.criterios.descripcion.disabled = true;
        document.criterios.descripcion.style.backgroundColor = "#b9b9ba";
        document.criterios.descripcion.value = "";     

        document.criterios.notificador.disabled = true;
        document.criterios.notificador.style.backgroundColor = "#b9b9ba";
        document.criterios.notificador.value = "";

        document.criterios.buscar_criterios.disabled = true;        

    }
    else{
        document.criterios.fecha_inicio.disabled = false;
        document.criterios.fecha_inicio.style.backgroundColor = "#fff";

        document.criterios.categorias.disabled = false;
        document.criterios.categorias.style.backgroundColor = "#fff";

        document.criterios.km_lugar.disabled = false;
        document.criterios.km_lugar.style.backgroundColor = "#fff";

        document.criterios.den_des.disabled = false;
        document.criterios.den_des.style.backgroundColor = "#fff";

		document.criterios.descripcion.disabled = false;
        document.criterios.descripcion.style.backgroundColor = "#fff";    

        document.criterios.notificador.disabled = false;
        document.criterios.notificador.style.backgroundColor = "#fff";

        document.criterios.buscar_criterios.disabled = false;  

        document.intervalo.habilita_intervalo.checked = false;

        document.intervalo.fecha_desde.disabled = true;
    	document.intervalo.fecha_desde.style.backgroundColor = "#b9b9ba";

    	document.intervalo.fecha_hasta.disabled = true;
    	document.intervalo.fecha_hasta.style.backgroundColor = "#b9b9ba";

    	document.intervalo.buscar_intervalo.disabled = true;
 
    }
}
</script> 

<script>
function funcion2(){
    if(document.intervalo.habilita_intervalo.checked == false){
            
    	document.intervalo.fecha_desde.disabled = true;
    	document.intervalo.fecha_desde.style.backgroundColor = "#b9b9ba";

    	document.intervalo.fecha_hasta.disabled = true;
    	document.intervalo.fecha_hasta.style.backgroundColor = "#b9b9ba";

    	document.intervalo.buscar_intervalo.disabled = true;


    }
    else{
        
        document.intervalo.fecha_desde.disabled = false;
    	document.intervalo.fecha_desde.style.backgroundColor = "#fff";

    	document.intervalo.fecha_hasta.disabled = false;
    	document.intervalo.fecha_hasta.style.backgroundColor = "#fff";

    	document.intervalo.buscar_intervalo.disabled = false;

    	document.criterios.habilita_criterios.checked = false;

    	document.criterios.fecha_inicio.disabled = true;
        document.criterios.fecha_inicio.style.backgroundColor = "#b9b9ba";
        document.criterios.fecha_inicio.value = "";

        document.criterios.categorias.disabled = true;
        document.criterios.categorias.style.backgroundColor = "#b9b9ba";
        document.criterios.categorias.value = "";

        document.criterios.km_lugar.disabled = true;
        document.criterios.km_lugar.style.backgroundColor = "#b9b9ba";
        document.criterios.km_lugar.value = "";

        document.criterios.den_des.disabled = true;
        document.criterios.den_des.style.backgroundColor = "#b9b9ba";
        document.criterios.den_des.value = "";

		document.criterios.descripcion.disabled = true;
        document.criterios.descripcion.style.backgroundColor = "#b9b9ba";
        document.criterios.descripcion.value = "";     

        document.criterios.notificador.disabled = true;
        document.criterios.notificador.style.backgroundColor = "#b9b9ba";
        document.criterios.notificador.value = "";

        document.criterios.buscar_criterios.disabled = true;   
 
    }
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
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li><a href="cargar_solicitud.php"><span class="glyphicon glyphicon-tags"></span> Solicitud Cortada</a></li>
			<li><a href="libro_de_acta.php"><span class="glyphicon glyphicon-book"></span> Libro de Acta</a></li>
			<li class="active"><a href="busqueda_avanzada.php"><span class="glyphicon glyphicon-search"></span> Búsqueda Avanzada</a></li>
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
				<li class="active">Libro Acta</li>
			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Despacho Eléctrico</h1>
				<h2 class="page-header">Buscar Libro de Acta</h2>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
			<div class="panel panel-default">
			<form name="criterios" action="procesa_busqueda_criterios.php" method="post">
				<div class="panel-heading"><input type="checkbox" name="habilita_criterios" onclick="funcion()" checked="checked">&nbsp;&nbsp; Buscar por criterios</div>
					<div class="panel-body">
						<table style="border:0;width:100%">
							<thead>
					    		<tr>
					        		<th><label class="btn btn-primary" style="background-color:#00438c;cursor:default;width:100%">Fecha Inicio:</label></th>
					        		<th><input name="fecha_inicio" data-provide="datepicker" type="text" style="text-transform:uppercase;cursor:pointer;background-color:#fff;color:#000;width:100%" class="form-control" placeholder="Ingrese una fecha"></th>
					        		<th><label class="btn btn-primary" style="background-color:#00438c;cursor:default;width:100%">Categoría:</label></th>
					        		<th><select name="categorias" class="form-control" style="background-color:#fff;color:#000;cursor:pointer;width:100%" name="categoria">
										<option value=""></option>
 										<?php
											while($row_categorias=mysqli_fetch_array($categorias))
   											echo "<option  value='".utf8_encode($row_categorias["nombre_categoria"])."'>".utf8_encode($row_categorias["nombre_categoria"])."</option>"; 
										?>
										</select></th>
									<th><label class="btn btn-primary" style="background-color:#00438c;cursor:default;width:100%">Km/Lugar:</label></th>
					    			<th><input name="km_lugar" type="text" style="text-transform:uppercase;background-color:#fff;color:#000" class="form-control" placeholder="Ingrese un km o lugar"></th>
					    		</tr>
							</thead> 
							<tbody>
								<tr>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
									<td style="visibility:hidden">AAA</td>
								</tr>
					    		<tr>
					        		<td><label class="btn btn-primary" style="background-color:#00438c;cursor:default;width:100%">DEN/DES:</label></td>
					    			<td><input name="den_des" type="text" style="text-transform:uppercase;background-color:#fff;color:#000;width:100%" class="form-control" placeholder="Ingrese un D.E.N. o D.E.S."></td>
					    			<td><label class="btn btn-primary" style="background-color:#00438c;cursor:default;width:100%">Descripción:</label></td>
					    			<td><input name="descripcion" type="text" style="text-transform:uppercase;background-color:#fff;color:#000;width:100%" class="form-control" placeholder="Ingrese una descripción"></td>
					    			<td><label class="btn btn-primary" style="background-color:#00438c;cursor:default;width:100%">Notificador:</label></td>
					    			<td><input name="notificador" type="text" style="text-transform:uppercase;background-color:#fff;color:#000;width:100%" class="form-control" placeholder="Ingrese un notificador"></td>
					    		</tr>
							</tbody>
						</table>
						<br>
						<button name="buscar_criterios" type="submit" class="btn btn-default btn-md" style="background-color:#fa8400">Buscar</button>
					</div>
				</form>
				</div>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-lg-12">
			<div class="panel panel-default">
			<form name="intervalo">
				<div class="panel-heading"><input type="checkbox" name="habilita_intervalo" onclick="funcion2()">&nbsp;&nbsp; Buscar por rango de fechas</div>
					<div class="panel-body">
						<table style="border:0;width:100%">
							<thead>
					    		<tr>
					        		<th><label>Desde: </label></th>
					        		<th><input name="fecha_desde" data-provide="datepicker" type="text" style="text-transform:uppercase;cursor:pointer;background-color:#b9b9ba;color:#000;width:100%" class="form-control" placeholder="Ingrese una fecha"></th>
					        		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Hasta: </label></th>
					    			<th><input name="fecha_hasta" data-provide="datepicker" type="text" style="text-transform:uppercase;cursor:pointer;background-color:#b9b9ba;color:#000;width:100%" class="form-control" placeholder="Ingrese una fecha"></th>
					    		</tr>
							</thead> 
						</table>
						<br>
						<button name="buscar_intervalo" type="submit" disabled="true" class="btn btn-default btn-md" style="background-color:#fa8400">Buscar</button>
					</div>
				</form>
				</div>
			</div>
		</div>
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
