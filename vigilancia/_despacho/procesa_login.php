<?php

session_start();

include "config.php";

$link = Conectarse();

if(isset($_POST['user'])){

	$user = mysqli_real_escape_string($link,$_POST['user']);

	$pass = mysqli_real_escape_string($link,$_POST['pass']);

	$pass = md5($pass);

	$sel_user = "SELECT * FROM usuarios WHERE user='$user' AND password='$pass'";

	$run_user = mysqli_query($link, $sel_user);

	$check_user = mysqli_num_rows($run_user);

	if($check_user>0){

		$_SESSION['user']=$user;

		$_SESSION['nombre']=$check_user['nombre'];

		header("Location: index.php");

	}

	else {

		echo "<script>alert('Usuario o Contraseña incorrecta, intente otra vez.')</script>";
		header("Location: login.php");

	}

}


?>