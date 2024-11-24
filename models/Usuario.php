<?php

namespace Models;

class Usuario extends ActiveRecord
{
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'admin'];
    protected static $tabla = 'usuarios';
    protected static $alertas = [];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $admin;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = '0';
    }


    public function validarRegistro()
    {
        if (!$this->nombre) {
            self::$alertas['danger'][] = 'Agrega tu nombre';
        }

        if (!$this->apellido) {
            self::$alertas['danger'][] = 'Agrega tu apellido';
        }

        if (!$this->email) {
            self::$alertas['danger'][] = 'Agrega tu email';
        }

        if (!$this->password) {
            self::$alertas['danger'][] = 'Agrega tu password';
        }

        return self::$alertas;
    }

    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['danger'][] = 'Agrega un email';
        }

        if (!$this->password) {
            self::$alertas['danger'][] = 'Agrega un password';
        }

        return self::$alertas;
    }

    public function hashearPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public static function validarEmail($email) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE email='" . $email . "'";
        $resultado = self::consultarQuery($query);
        return array_shift($resultado);
    }

    public function verificarPassword($password) {
        $resultado = password_verify($password, $this->password);
        if (!$resultado) {
            self::$alertas['danger'][] = 'Password incorrecto';
        }
        return $resultado;
    }

    public function iniciarSesion() {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['id'] = $this->id;
        $_SESSION['email'] = $this->email;
        $_SESSION['nombre'] = $this->nombre;
        $_SESSION['admin'] = $this->admin;

        if ($_SESSION['admin'] === "1") {
            header('Location: /admin');
        } else {
            header('Location: /');
        }
    }

}
