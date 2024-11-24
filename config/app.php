<?php

use Models\ActiveRecord;

require __DIR__ . '/database.php';
require __DIR__ . '/funciones.php';
require __DIR__ . '/../vendor/autoload.php';

$db = conectarDB();
ActiveRecord::setDB($db);