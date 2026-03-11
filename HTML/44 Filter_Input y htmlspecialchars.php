<!-- 
filter_input() es como tener un guardia de seguridad en la puerta que no solo recibe el paquete (el dato), sino que lo inspecciona y lo limpia antes de dejarlo entrar a tu código.

1. ¿Qué hace exactamente filter_input()?
A diferencia de $_POST['nombre'], que simplemente agarra lo que venga, filter_input() hace tres cosas en una sola línea:

Verifica si existe: Comprueba si la variable fue enviada (como un isset).

Obtiene el valor: Lo recupera del método que le indiques (POST o GET).

Sanea o Valida: Limpia caracteres prohibidos o verifica si el formato es correcto (por ejemplo, si es un email real).

2. ¿Se usa junto con htmlspecialchars()?
Sí, pero en momentos distintos. * filter_input() se usa al recibir el dato (limpieza de entrada).

htmlspecialchars() se usa al mostrar el dato (protección de salida).

Es como lavar una manzana al comprarla (filter_input) y luego pelarla justo antes de comerla (htmlspecialchars).

3. Ejemplo sencillo y combinado
Imagina que recibimos un nombre de usuario y un correo electrónico. Queremos limpiar el nombre de etiquetas HTML y validar que el correo sea un email real. 


Filtros más comunes para filter_input()
Filtro                      Qué hace
FILTER_SANITIZE_STRING*     Elimina etiquetas HTML y caracteres especiales.
FILTER_VALIDATE_EMAIL       Devuelve el email si es correcto o false si no.
FILTER_VALIDATE_INT         Verifica si el dato es un número entero.
FILTER_SANITIZE_NUMBER_INT  Quita todo lo que no sea número (letras, picos, etc).

*Nota: En versiones muy recientes de PHP (8.1+), FILTER_SANITIZE_STRING está quedando en desuso a favor de FILTER_SANITIZE_SPECIAL_CHARS, que es más seguro.

Resumen de la "Combinación Ganadora":
Usa filter_input() para recoger el dato y asegurarte de que es el tipo de dato que esperas (un número, un mail, etc.).

Usa htmlspecialchars() siempre que hagas un echo de ese dato en tu HTML.
-->


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Si enviamos una peticion POST ( que ya sabemos que lo haremos con POST en el formulario HTML)

    // 1. RECIBIR Y SANEAR (Limpiar etiquetas HTML del nombre)
    // FILTER_SANITIZE_SPECIAL_CHARS quita picos y caracteres raros al entrar
    $nombreSucio = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
    $nombreSucio = trim($nombreSucio);     // Eliminamos espacios en blanco al inicio y fin de la cadena 

    // 2. VALIDACIÓN DE FORMATO (Solo letras y espacios)
    // Explicación del patrón:
    // ^ = inicio, [a-zA-ZáéíóúÁÉÍÓÚñÑ ] = letras permitidas, + = una o más, $ = fin
    $patronLetras = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/";
    if (empty($nombreSucio)) {
        echo "El nombre es obligatorio.";
    } elseif (!preg_match($patronLetras, $nombreSucio)) {
        echo "<script>alert('EL NOMBRE SOLO PUEDE CONTENER LETRAS Y ESPACIOS') </script>";
        // echo "Error: El nombre solo puede contener letras y espacios.";
    } else {
        // 3. EL DATO ES VÁLIDO Y ESTÁ LISTO
        // Aquí podrías guardarlo en una Base de Datos

        // 4. SALIDA SEGURA AL NAVEGADOR
        echo "Nombre guardado con éxito: " . htmlspecialchars($nombreSucio);
    }


    // 2. RECIBIR Y VALIDAR (Verificar si es un email válido)
    // Si no es un email válido, devuelve FALSE
    $emailCandidato = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    echo "<h3>Resultados:</h3>";

    // Mostramos el nombre usando htmlspecialchars por seguridad extra al imprimir
    echo "Nombre procesado: " . htmlspecialchars($nombreSucio) . "<br>";

    if ($emailCandidato) {
        echo "Email válido: " . htmlspecialchars($emailCandidato);
    } else {
        echo "El email introducido no es correcto.";
    }
}

?>

<!-- action="" enviara hacia esta misma pagina -->
<!-- El Formulario recibira un Nombre y un email  -->
<form method="POST" action="">
    Nombre: <input type="text" name="nombre"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" value="Enviar">
</form>