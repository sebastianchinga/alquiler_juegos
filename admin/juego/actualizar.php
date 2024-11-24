<?php

require __DIR__ . '/../../config/app.php';

use Models\Juego;
use Intervention\Image\ImageManagerStatic as Image;
use Models\Genero;

session_start();

$login = $_SESSION['login'];
$admin = $_SESSION['admin'];

if (!$login || $admin === "0") {
    header('Location: /');
}

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

$juego = Juego::find($id);
$generos = Genero::all();
$alertas = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $juego->sincronizar($_POST['juego']);
    // debuguear($juego);

    $nombreImagen = '';

    if (!is_dir(FILE_IMG)) {
        mkdir(FILE_IMG);
    }

    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

    if ($_FILES['juego']['tmp_name']['imagen']) {
        $img = Image::make($_FILES['juego']['tmp_name']['imagen']);
        $juego->setImagen($nombreImagen);
    }


    $alertas = $juego->validar();

    if (empty($alertas)) {

        if ($_FILES['juego']['tmp_name']['imagen']) {
            $img->save(FILE_IMG . $nombreImagen);
        }

        $resultado = $juego->guardar();

        if ($resultado) {
            header('Location: /admin/index.php?alerta=2');
        }
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
                            <h1 class="m-0">Editar juego</h1>
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
                    <a href="/admin/" class="btn btn-danger mb-2">Volver</a>
                    <?php
                    foreach ($alertas as $key => $mensajes) {
                        foreach ($mensajes as $mensaje) { ?>
                            <div class="alert alert-<?php echo $key ?>"><?php echo $mensaje ?></div>
                    <?php }
                    }
                    ?>
                    <form action="" method="POST" class="my-3" enctype="multipart/form-data">
                        <?php include __DIR__ . '/formulario.php' ?>
                        <div class="form-group">
                            <input type="submit" value="Actualizar videojuego" class="btn btn-primary btn-block">
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php incluirTemplate('footer'); ?>