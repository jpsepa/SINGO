<?php


function Conectarse(){

	if (!($link = mysqli_connect('localhost', 'root', 'segundas', 'singo'))){
		echo "Error al conectarse a la Base de Datos. ";
		exit();
	}

	mysqli_query("SET NAMES utf8");
	return $link;
}

$link = Conectarse();

mysqli_close($link);

?>