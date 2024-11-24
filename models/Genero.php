<?php

namespace Models;

class Genero extends ActiveRecord {

    protected static $columnasDB = ['id', 'nombre'];
    protected static $tabla = 'generos';

    public $id;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }
}