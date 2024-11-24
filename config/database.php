<?php 

function conectarDB(): mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'videogamestore');

    if (!$db) {
        echo 'Hubo un error en la conexión';
    }

    return $db;
}