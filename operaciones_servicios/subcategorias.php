<?php

include "../config.php";

session_start();

    // si se está enviando por POST el id del país
    // significa que intentamos acceder desde jQuery
    if(isset($_POST['id'])) {
        $subcategorias = array();
        $sql = "SELECT * 
                FROM operaciones_subcategorias
                WHERE id_falla = ".$_POST['id']." ORDER BY nombre ASC"; 

        $link = Conectarse();

        // obtenemos todos los países
        $result = mysqli_query($link, $sql);

        // creamos objetos de la clase ciudad y los agregamos al arreglo
        while($row = $result->fetch_assoc()){
            $row['nombre'] = mb_convert_encoding($row['nombre'], 'UTF-8', mysqli_character_set_name($link));
            $subcategoria = new subcategoria($row['id'], $row['nombre']);
            array_push($subcategorias, $subcategoria);
        }

        // devolvemos el arreglo de ciudades, en formato JSON
        echo json_encode($subcategorias);
    }

    class subcategoria {
        public $id;
        public $nombre;

        function __construct($id, $nombre) {
            $this->id = $id;
            $this->nombre = $nombre;
        }
    }
?>