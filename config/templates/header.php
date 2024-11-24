<?php 
session_start();

$login = $_SESSION['login'] ?? null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoGames Store</title>
    <link rel="stylesheet" href="/src/css/index.css">
    <link rel="shortcut icon" href="/src/images/logo.png" type="image/x-icon">
</head>

<body>
    <header class="contenedor">
        <div class="header">
            <a href="/">
                <img src="/src/images/logo.png" alt="logotipo" class="header__img">
            </a>
            <nav class="nav">
                <?php if($login): ?>
                    <a href="/cerrar.php" class="nav__link">Cerrar Sesión</a>
                <?php elseif($login == null): ?>
                    <a href="/login.php" class="nav__link">Iniciar Sesión</a>
                    <a href="/registrar.php" class="nav__link">Regístrate</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>