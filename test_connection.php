<?php

require 'vendor/autoload.php';

use Config\Database;

// Probar conexión
$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "Conexión exitosa a la base de datos.";
}
