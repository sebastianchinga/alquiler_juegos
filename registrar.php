<?php

use Models\Usuario;

require 'config/app.php';
incluirTemplate('header');

$usuario = new Usuario();
$alertas = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = new Usuario($_POST['usuario']);

    $usuario->hashearPassword($usuario->password);


    $alertas = $usuario->validarRegistro();

    if (empty($alertas)) {
        $resultado = $usuario->guardar();

        if ($resultado) {
            header('Location: /login.php');
        }
    }


}

?>

<main class="body">
    <div class="login">
        <h1 class="texto-centrado">Registro</h1>
        <?php 
            foreach ($alertas as $key => $mensajes) {
                foreach ($mensajes as $mensaje) { ?>
                    <div class="alerta <?php echo $key ?>"><?php echo $mensaje ?></div>
                <?php }
            }
        ?>
        <form method="post" class="formulario-registro">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" name="usuario[nombre]" value="<?php echo $usuario->nombre ?>">
            </div>
            <div class="campo">
                <label for="apellido">Apellido:</label>
                <input type="text" name="usuario[apellido]" value="<?php echo $usuario->apellido ?>">
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" name="usuario[email]" value="<?php echo $usuario->email ?>">
            </div>
            <div class="campo">
                <label for="password">Password:</label>
                <input type="password" name="usuario[password]">
            </div>
            <div class="campo-registro">
                <input type="submit" value="Entrar" class="boton boton-formulario">
            </div>
        </form>
    </div>
</main>
</body>

</html>