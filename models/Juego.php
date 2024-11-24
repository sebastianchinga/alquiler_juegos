<?php

namespace Models;

class Juego extends ActiveRecord
{

    protected static $columnasDB = ['id', 'titulo', 'imagen', 'plataforma', 'disponible', 'generos_id'];
    protected static $tabla = 'juegos';

    public $id;
    public $titulo;
    public $imagen;
    public $plataforma;
    public $disponible;
    public $generos_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->plataforma = $args['plataforma'] ?? '';
        $this->disponible = $args['disponible'] ?? '';
        $this->generos_id = $args['generos_id'] ?? '';
    }

    public function validar(): array
    {
        if (!$this->titulo) {
            self::$alertas['danger'][] = 'Agrega un título';
        }
        if (!$this->imagen) {
            self::$alertas['danger'][] = 'Agrega un imágen';
        }
        if (!$this->plataforma) {
            self::$alertas['danger'][] = 'Agrega un plataforma';
        }
        if (!$this->generos_id) {
            self::$alertas['danger'][] = 'Selecciona un género';
        }

        return self::$alertas;
    }

    public function cambiarEstado() {
        $this->disponible = '0';
    }
}
