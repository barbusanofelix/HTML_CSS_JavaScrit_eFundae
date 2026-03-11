
<!-- ESTE ARCHIVO PODRIA SER EL INDEX.HTML PARA HACER LA ENTRADA DEL PROYECTO -->

<!-- VALIDADACION DE NOMBRE, EMAIL Y EDAD EN EL SERVIDOR -->
<!-- 
FLUJO COMPLETO DE LA LOGICA GENERAL.
este es el viaje que debe hacer un dato desde que el usuario lo escribe hasta que se guarda:

Entrada: El usuario envía el formulario.

Saneado (filter_input): Eliminamos basura técnica o etiquetas.

Validación (preg_match / strlen): Comprobamos que cumpla las reglas (solo letras, longitud correcta. ...).

Persistencia: Se guarda en la Base de Datos (usando algo llamado "Sentencias Preparadas", que verás más adelante).

Salida (htmlspecialchars): Se muestra en pantalla de forma segura.
 -->

<!-- Importamos el modulo de funciones -->

<?php require_once 'src/funciones.php'; ?>
<!DOCTYPE html>

<html>
    <head>
        <!-- En head.php se incluye la llamada a UTF-8, viewport y sweetalert2@11 y habria que actualizar el css si se requiere colocar un archivo de estilos-->
        <?php include 'includes/head.php' ?>
        <title>Validacion datos en servidor</title>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 1. RECEPCIÓN Y SANEADO BÁSICO
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
            $nombre = trim($nombre);

            // 2. VALIDACIÓN DE FORMATO (Solo letras y espacios)
            // Explicación del patrón:
            // ^ = inicio, [a-zA-ZáéíóúÁÉÍÓÚñÑ ] = letras permitidas, + = una o más, $ = fin
            $patronLetras = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/";

            if (empty($nombre)) {
                echo "El nombre es obligatorio.";
            } elseif (!preg_match($patronLetras, $nombre)) {
                //echo "Error: El nombre solo puede contener letras y espacios.";
                echo alerta("EL NOMBRE SOLO PUEDE CONTENER LETRAS Y ESPACIOS, no numeros");
            } else {
                // 3. EL DATO ES VÁLIDO Y ESTÁ LISTO
                // Aquí podrías guardarlo en una Base de Datos
        
                // 4. SALIDA SEGURA AL NAVEGADOR
                echo "Nombre guardado con éxito: " . htmlspecialchars($nombre);
            }
        }
        ?>

        <!-- action="" enviara hacia esta misma pagina -->
        <!-- El Formulario recibira un Nombre y un email  -->
        <form method="POST" action="">
            Nombre: <input type="text" name="nombre"><br>
            Email: <input type="text" name="email"><br>
            edad: <input type="number" name="edad"><br>
            <input type="submit" value="Enviar">
        </form>

        <script src="" async defer></script>
    </body>
</html>