<?php

use Models\Juego;

include __DIR__ . '/../config/app.php';

session_start();

$login = $_SESSION['login'];
$admin = $_SESSION['admin'];

if (!$login || $admin === "0") {
    header('Location: /');
}

$alerta = $_GET['alerta'] ?? null;
$alerta = filter_var($alerta, FILTER_VALIDATE_INT);

$juegos = Juego::all();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $juego = Juego::find($_POST['id']);
    if ($juego) {
        $resultado = $juego->eliminar();
        header('Location: /admin/index.php?alerta=3');
    }
}

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VideoGames Store Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/src/css/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/src/css/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="/src/images/logo.png" type="image/x-icon">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php incluirTemplate('navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php incluirTemplate('sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Videojuegos</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <a href="/admin/juego/crear.php" class="btn btn-success">Agregar juego</a>
                    <?php if($alerta): ?>
                        <?php $mensaje = mostrarAlerta($alerta) ?>
                        <div class="alert alert-success my-2"><?php echo $mensaje ?></div>
                    <?php endif; ?>
                    <table class="table my-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Imágen</th>
                                <th scope="col">Disponible</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($juegos as $juego): ?>
                                <tr>
                                    <th scope="row"><?php echo $juego->titulo ?></th>
                                    <td><img src="/imagenes/<?php echo $juego->imagen ?>" alt="Imágen" style="width: 10rem;"</td>
                                    <td><?php echo $juego->disponible === '1' ? 'Disponible' : 'Alquilado' ?></td>
                                    <td>
                                        <a href="/admin/juego/actualizar.php?id=<?php echo $juego->id ?>" class="btn btn-warning btn-block mb-2">Editar</a>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $juego->id ?>">
                                            <input type="submit" value="Eliminar" class="btn btn-danger btn-block">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php incluirTemplate('footer'); ?>