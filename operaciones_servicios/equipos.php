<?php

include "../config.php";

// esta función se va a llamar al cargar el primer combo
function obtenerTodosLosEquipos() {
        $equipos = array();
        $sql = "SELECT id, nombre FROM operaciones_equipos ORDER BY nombre ASC"; 

        $link = Conectarse();

        // obtenemos todos los países
        $result = mysqli_query($link, $sql);

        // creamos objetos de la clase país y los agregamos al arreglo
        while($row = $result->fetch_assoc()){
            $row['nombre'] = mb_convert_encoding($row['nombre'], 'UTF-8', mysqli_character_set_name($link));          
            $equipo = new equipo($row['id'], $row['nombre']);
            array_push($equipos, $equipo);
        }

        // devolvemos el arreglo
        return $equipos;
    }

    class equipo {
        public $id;
        public $nombre;

        function __construct($id, $nombre) {
            $this->id = $id;
            $this->nombre = $nombre;
        }
    }
?>