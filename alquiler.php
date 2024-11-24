<?php
require 'config/app.php';

use Models\Alquiler;
use Models\Juego;

session_start();
$login = $_SESSION['login'] ?? null;
$usuario_id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];

if ($login === null) {
    header('Location: /login.php');
}

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

$juego = Juego::find($id);

incluirTemplate('header');

$alquiler = new Alquiler();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alquiler = new Alquiler($_POST['alquiler']);
    $alquiler->setDevolucion();

    $resultado = $alquiler->guardar();

    if ($resultado) {
        $juego->cambiarEstado();
        $rspt = $juego->guardar();

        if ($rspt) {
            header('Location: /mensaje.php');
        }
    }
}

?>

<main class="contenedor">
    <h2 class="texto-centrado">Confirmar alquiler</h2>
    <form action="" method="POST">
        <div class="campo">
            <label for="f_alquiler">Fecha de alquiler</label>
            <input type="date" name="alquiler[f_alquiler]" id="f_alquiler" disabled value="<?php echo date('Y-m-d') ?>">
        </div>
        <div class="campo">
            <label for="f_alquiler">Fecha de devolución</label>
            <input type="date" name="alquiler[f_devolucion]" id="f_alquiler" disabled value="<?php echo sumarDias('Y-m-d'); ?>">
        </div>
        <div class="campo">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="" value="<?php echo $nombre ?>" disabled>
        </div>
        <div class="campo">
            <label for="juego">Juego:</label>
            <input type="hidden" name="alquiler[juegos_id]" id="juego" value="<?php echo $juego->id ?>">
            <input type="text" name="juego_name" id="juego" value="<?php echo $juego->titulo ?>" style="margin-bottom: 1rem;" disabled>
            <img src="/imagenes/<?php echo $juego->imagen ?>" alt="Imágen" style="width: 20rem">
        </div>
        <div class="campo">
            <input type="submit" value="Alquilar juego">
        </div>
    </form>

</main>
</body>

</html>