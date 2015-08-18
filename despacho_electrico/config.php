<?php

function Conectarse(){

	if (!($link = mysqli_connect('localhost', 'root', 'segundas', 'singo'))){
		echo "Error al conectarse a la Base de Datos. ";
		exit();
	}

	return $link;
}

$link = Conectarse();
mysqli_close($link);

?>