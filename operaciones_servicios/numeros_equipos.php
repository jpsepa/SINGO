<?php

include "../config.php";

session_start();

    // si se está enviando por POST el id del país
    // significa que intentamos acceder desde jQuery
    if(isset($_POST['id'])) {
        $numeros_equipos = array();
        $sql = "SELECT * 
                FROM operaciones_numero_equipo
                WHERE id_equipo = ".$_POST['id']." ORDER BY numero ASC"; 

        $link = Conectarse();

        // obtenemos todos los países
        $result = mysqli_query($link, $sql);

        // creamos objetos de la clase ciudad y los agregamos al arreglo
        while($row = $result->fetch_assoc()){
            $row['numero'] = mb_convert_encoding($row['numero'], 'UTF-8', mysqli_character_set_name($link));
            $numero_equipo = new numero_equipo($row['id'], $row['numero']);
            array_push($numeros_equipos, $numero_equipo);
        }

        // devolvemos el arreglo de ciudades, en formato JSON
        echo json_encode($numeros_equipos);
    }

    class numero_equipo {
        public $id;
        public $numero;

        function __construct($id, $numero) {
            $this->id = $id;
            $this->numero = $numero;
        }
    }
?>