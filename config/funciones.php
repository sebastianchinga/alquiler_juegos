<?php

define('FILE_IMG', __DIR__ . "/../imagenes/");

function incluirTemplate(string $template):void {
    include __DIR__ . "/templates/$template.php";
}

function debuguear($codigo) {
    echo '<pre>';
    var_dump($codigo);
    echo '</pre>';
}

function sumarDias($fecha_alquiler) {
    $fecha_alquiler = new DateTime();
    $fecha_devolucion = $fecha_alquiler->modify('+30 days');
    return $fecha_devolucion->format('Y-m-d');
}

function mostrarAlerta($alerta) {
    $mensaje = '';
    switch ($alerta) {
        case 1:
            $mensaje = 'Agregado correctamente';
            break;
        
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        
        default:
            $mensaje = null;
            break;
    }

    return $mensaje;
}