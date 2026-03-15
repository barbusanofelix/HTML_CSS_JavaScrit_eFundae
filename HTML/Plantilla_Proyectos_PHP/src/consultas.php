
<?php
require_once 'conexion.php';

// Función automatizada para buscar un registro por ID en cualquier tabla
function buscarPorId($tabla, $columnaId, $id)
{
    $pdo = obtenerConexion();

    // NOTA: Los nombres de tablas/columnas NO se pueden pasar como parámetros :id
    // así que debemos validarlos o escribirlos con cuidado.
    $sql = "SELECT * FROM " . $tabla . " WHERE " . $columnaId . " = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch();
}