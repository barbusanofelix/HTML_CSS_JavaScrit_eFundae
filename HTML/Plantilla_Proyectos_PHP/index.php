<?php
require_once 'src/consultas.php';
require_once 'src/config.php'; // Para la constante CURRENCY

// Buscamos en la tabla 'precios', donde la columna es 'codigo' y el valor es 1
$producto = buscarPorId('precios', 'codigo', 1);

if ($producto) {
    echo "<h1>" . htmlspecialchars($producto['nombre_producto']) . "</h1>";
    echo "Precio: " . $producto['precio'] . CURRENCY;
}