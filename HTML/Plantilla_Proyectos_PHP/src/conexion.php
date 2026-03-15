<?php
// E:\Python\WorkSpace curso Python_HTML_CSS_JavaScript\...\src\conexion.php


require_once 'config.php';

function obtenerConexion()
{
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // En producción, no mostrar el error real al usuario, solo loguearlo
        error_log($e->getMessage());
        die("Error crítico de conexión.");
    }
}

