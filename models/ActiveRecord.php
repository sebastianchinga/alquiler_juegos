<?php

namespace Models;

class ActiveRecord
{

    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $alertas = [];
    protected static $db;


    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setAlertas($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    public static function getAlertas(): array
    {
        return static::$alertas;
    }

    public function setImagen($image)
    {
        if (!is_null($this->id)) {
            $this->eliminarImagen();
        }
        $this->imagen = $image;
    }

    public function eliminarImagen()
    {
        $file = file_exists(FILE_IMG . $this->imagen);
        if ($file) {
            unlink(FILE_IMG . $this->imagen);
        }
    }

    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarQuery($query);
        return $resultado;
    }

    public function guardar()
    {
        $resultado = '';
        if (is_null($this->id)) {
            $resultado = $this->crear();
        } else {
            $resultado = $this->actualizar();
        }
        return $resultado;
    }

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizado()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function crear()
    {
        $atributos = $this->sanitizado();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function actualizar()
    {
        $atributos = $this->sanitizado();
        $formato = [];

        foreach ($atributos as $key => $value) {
            $formato[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla;
        $query .= " SET ";
        $query .= join(", ", array_values($formato));
        $query .= " WHERE id=" . $this->id;

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id=" . $id;
        $resultado = self::consultarQuery($query);
        return array_shift($resultado);
    }

    public static function consultarQuery($query)
    {
        $resultado = self::$db->query($query);

        $registros = [];
        while ($datos = mysqli_fetch_assoc($resultado)) {
            $registros[] = static::crearObjeto($datos);
        }

        $resultado->free();

        return $registros;
    }

    public static function crearObjeto($registros)
    {
        $objeto = new static;

        foreach ($registros as $key => $value) {
            $objeto->$key = $value;
        }

        return $objeto;
    }

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function eliminar()
    {
        $query = " DELETE FROM " . static::$tabla . " WHERE id =" . $this->id;
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->eliminarImagen();
        }
        return $resultado;
    }

    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna='" . "$valor'";
        $resultado = static::consultarQuery($query);
        return $resultado;
    }
}
