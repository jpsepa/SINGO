<?php

include "../config.php";

// esta función se va a llamar al cargar el primer combo
function obtenerTodasLasFallas() {
        $fallas = array();
        $sql = "SELECT id, nombre_falla FROM operaciones_fallas ORDER BY nombre_falla ASC"; 

        $link = Conectarse();

        // obtenemos todos los países
        $result = mysqli_query($link, $sql);

        // creamos objetos de la clase país y los agregamos al arreglo
        while($row = $result->fetch_assoc()){
            $row['nombre_falla'] = mb_convert_encoding($row['nombre_falla'], 'UTF-8', mysqli_character_set_name($link));          
            $falla = new falla($row['id'], $row['nombre_falla']);
            array_push($fallas, $falla);
        }

        // devolvemos el arreglo
        return $fallas;
    }

    class falla {
        public $id;
        public $nombre_falla;

        function __construct($id, $nombre_falla) {
            $this->id = $id;
            $this->nombre_falla = $nombre_falla;
        }
    }
?>