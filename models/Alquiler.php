<?php

namespace Models;

class Alquiler extends ActiveRecord {

    protected static $columnasDB = ['id', 'f_alquiler', 'f_devolucion', 'usuarios_id', 'juegos_id'];
    protected static $tabla = 'alquileres';

    public $id;
    public $f_alquiler;
    public $f_devolucion;
    public $usuarios_id;
    public $juegos_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->f_alquiler = $args['f_alquiler'] ?? date('Y-m-d');
        $this->f_devolucion = $args['f_devolucion'] ?? '';
        $this->usuarios_id = $_SESSION['id'];
        $this->juegos_id = $args['juegos_id'] ?? '';
    }

    public function setDevolucion() {
        $this->f_devolucion = sumarDias($this->f_alquiler);
    }
}