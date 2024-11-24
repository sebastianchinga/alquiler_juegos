<?php

use Models\Juego;

require 'config/app.php';
incluirTemplate('header');

$juegos = Juego::all();

?>

<main class="contenedor">
    <h1 class="texto-centrado">Selecciona un juego</h1>
    <div class="contenedor-juegos">
        <?php foreach ($juegos as $juego): ?>
            <div class="juego">
                <div class="juego__imagen">
                    <img src="/imagenes/<?php echo $juego->imagen ?>" alt="Imágen del juego">
                </div>
                <div class="juego__contenido">
                    <h2 class="juego__titulo"><?php echo $juego->titulo ?></h2>
                    <?php if($juego->disponible === "1"): ?>
                        <a href="/alquiler.php?id=<?php echo $juego->id ?>" class="juego__boton">Alquilar videojuego</a>
                    <?php else: ?>
                        <a href="#" class="juego__boton">Juego alquilado</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>

</html>