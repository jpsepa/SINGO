<?php

include "../config.php";

$link = Conectarse();

session_start();

//JUNIO
$query = "SELECT COUNT(*) AS total_junio FROM `vigilancia_antecedentes` WHERE `fecha` BETWEEN '2015-06-01' AND '2015-06-31'";

$result = mysqli_query($query);

$data = mysqli_fetch_assoc($result);

$valor_junio = $data['total_junio'];

mysql_close();

?>