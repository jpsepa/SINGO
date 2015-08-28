<?php

include "config.php";

$link = Conectarse();

mysqli_set_charset($link,"utf8");

if(isset($_POST['user'])){

	$user = mysqli_real_escape_string($link,$_POST['user']);

	$pass = mysqli_real_escape_string($link,$_POST['pass']);

	$pass = md5($pass);

	$sel_user = "SELECT * FROM usuarios WHERE user='$user' AND password='$pass'";

	$run_user = mysqli_query($link, $sel_user);

	$check_user = mysqli_num_rows($run_user);

	if($check_user>0){

		$row = mysqli_fetch_array($run_user);

		session_start();

		$_SESSION['id']=$row['id'];

		$_SESSION['user']=$row['user'];

		$_SESSION['nombre']=htmlentities($row['nombre']);

		$_SESSION['apellido_pat']=utf8_decode($row['apellido_pat']);

		$_SESSION['cargo']=$row['cargo'];

		$_SESSION['area']=$row['area'];

		$_SESSION['logeado']=1;

		if ($_SESSION['area']=='Despacho Eléctrico') {

			header("Location: despacho_electrico");

		}elseif ($_SESSION['area']=='Tráfico') {
			
			header("Location: trafico");

		}elseif ($_SESSION['area']=='Vigilancia') {
			
			header("Location: vigilancia");

		}else{

		header("Location: index.php");

		}

	}

	else {

		header("Location: login_error.php");

	}

}


?>