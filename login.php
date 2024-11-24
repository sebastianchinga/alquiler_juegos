<?php

use Models\Usuario;

require 'config/app.php';
incluirTemplate('header');

$usuario = new Usuario();
$alertas = Usuario::getAlertas();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($_POST['usuario']);
    $alertas = $usuario->validarLogin();

    if (empty($alertas)) {
        $resultado = Usuario::validarEmail($usuario->email);
        if ($resultado) {
            $auth = $resultado->verificarPassword($usuario->password);
            if ($auth) {
                $resultado->iniciarSesion();
            }
        } else {
            Usuario::setAlertas('danger', 'Email no registrado');
        }
    }
}

$alertas = Usuario::getAlertas();

?>

<main class="body">
    <div class="login">
        <h1 class="texto-centrado">Login</h1>
        <?php
        foreach ($alertas as $key => $mensajes) {
            foreach ($mensajes as $mensaje) { ?>
                <div class="alerta <?php echo $key ?>"><?php echo $mensaje ?></div>
        <?php }
        }
        ?>
        <form action="login.php" method="post" class="formulario-login">
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" name="usuario[email]" value="<?php echo $usuario->email ?>">
            </div>
            <div class="campo">
                <label for="password">Password:</label>
                <input type="password" name="usuario[password]">
            </div>
            <div class="campo">
                <input type="submit" value="Entrar">
            </div>
        </form>
    </div>
</main>
</body>

</html>