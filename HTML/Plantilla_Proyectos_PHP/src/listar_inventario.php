<?php
// E:\...\src\listar_inventario.php

$rutaBaseDatos = __DIR__ . '/../data/productos.db'; // Ruta de la base de datos

try {
    //  Conectar (Esto crea el archivo productos.db si no existe)
    $pdo = new PDO("sqlite:" . $rutaBaseDatos);
    // Configurar errores
    /*
    $pdo->setAttribute(...): Es un método del objeto PDO que sirve para cambiar la configuración de la conexión.

    PDO::ATTR_ERRMODE: Es el nombre del "ajuste" que queremos tocar. En este caso, el Modo de Reporte de Errores.

    PDO::ERRMODE_EXCEPTION: Es el valor que le asignamos a ese ajuste. Le estamos diciendo: "Si algo sale mal, lanza una Excepción".
    */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Preparamos y ejecutamos la consulta
    $stmt = $pdo->query("SELECT * FROM inventario");
    // $stmt->fetchAll(): A diferencia de fetch() (que solo trae una fila), esta instrucción trae todos los registros de golpe y los guarda en un arreglo (array) multidimensional llamado $productos.
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. Empezamos a pintar la tabla HTML
    echo "<h1>Inventario de Productos</h1>";
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse; text-align: left;'>";
    echo "<thead style='background-color: #f2f2f2;'>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // 3. Recorremos los productos con un bucle
    // foreach ($productos as $item): Es un bucle que dice: "Por cada elemento que haya dentro de $productos, llámalo $item y repite lo que hay dentro de las llaves".
    foreach ($productos as $item) {
        echo "<tr>";
        // htmlspecialchars(): ¡Importante! Siempre que imprimas texto que viene de una base de datos, úsalo. Evita que si alguien escribió código malicioso en la descripción del producto, este se ejecute en tu navegador.
        echo "<td>" . htmlspecialchars($item['id']) . "</td>";
        echo "<td>" . htmlspecialchars($item['descripcion']) . "</td>";
        //number_format($item['precio'], 2): Formatea el número para que siempre tenga 2 decimales, haciendo que el precio se vea profesional (ej: 359.99).
        echo "<td>" . number_format($item['precio'], 2) . " €</td>";
        echo "<td>" . $item['cantidad'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<p>Total de productos: " . count($productos) . "</p>";

} catch (PDOException $e) {
    echo "❌ Error al leer la base de datos: " . $e->getMessage();
}