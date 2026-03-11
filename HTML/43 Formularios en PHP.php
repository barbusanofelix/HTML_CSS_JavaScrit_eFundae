<!-- FORMULARIO BASICO QUE ENVIAMOS AL SERVIDOR EN LA MISMA PAGINA ...(ESTE ARCHIVO) -->



<?php
//  Estas lineas son para practicar el $_SERVER[]
// $_SERVER["PHP_SELF"] recupera el nombre del archivo actual.
$archivo = $_SERVER["PHP_SELF"];
echo "" . $archivo . "";  // Imprime el nombre del archivo
echo "<br>";
?>


<!-- AQUI EL FORMULARIO SENCILLO QUE PIDE UN NOMBRE Y BOTON DE ENVIO -->
<!-- action="" hace que el formulario se envie a este mismo archivo -->
<form action="" method="POST">
    <!-- el input se ira al servidor con el "id" nombre. Colocamos required para asegurar una entrada -->
    Nombre: <input type="text" name="nombre" required /><br />
    <input type="submit" value="Enviar" />
</form>

<?php
// Este IF es el "escudo". Solo se ejecuta EL INTENTO DE VER $:post["NOMBRE], si hay un envío real.
// Sin esto da error porque leera todo el formulario y el script pero $_POST["nombre"] es nulo al cargar por 1era vez.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Recogemos el dato  enviado por el FORMULARIO (o "" si no existe) 
    //! ?? "" : Es un operador que en caso de ser nulo el $_POST ( ??) le asigna un valor vacio ""
    $nombreRecibido = $_POST["nombre"] ?? "";

    // 2. Limpiamos espacios y comprobamos si realmente hay texto
    // Evita que se suministren espacios 
    if (trim($nombreRecibido) === "") {
        echo "Error: El nombre es obligatorio (no me engañes con espacios).";
    } else {
        // 3. Sanitizamos para evitar que nos metan código HTML/JS
        $nombreLimpio = htmlspecialchars($nombreRecibido);

        echo "Hola, " . $nombreLimpio;
    }
}

?>

<!-- Resumen de la defensa:
HTML required: Primera línea de defensa (evita errores accidentales del usuario).

PHP ?? "": Evita que el servidor explote si la llave no existe.

PHP trim(): Evita que nos envíen "aire" (espacios).

PHP htmlspecialchars(): Evita que el nombre sea un virus o un script.

htmlspecialchars() no detiene un "virus" de archivo (como un .exe malicioso), sino que detiene un ataque llamado XSS (Cross-Site Scripting) o "Inyección de Scripts".
 -->