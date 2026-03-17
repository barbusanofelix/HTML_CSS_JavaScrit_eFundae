<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reto 5 Validacion Formulario</title>
    </head>

    <!-- FORMULARIO : ESTA VALIDADO EN EL FRONT (html) Y VALIDADO EN EL SERVIDOR-->
    <!-- Enviamos el formulario a esta pagina colocando action="Nombre de esta misma pagina" -->
    <!--  Como se logra ir a esta misma pagina? -> simple es colocar action="" y con toda seguridad seria que entre las " " coloquemos el nombre de nuestra pagina que se logra con la variable magica $_SERVER['PHP_SELF], pero necesitamos "imprimir el nombre y entonces se usa el echo y como es instruccion de php hay que colocar la llamada y cierre a php -->
    <!-- Usamos POST porque manejaremos informacion sensible en este formulario. method="post" -->
    <!--Validacion de nombre y Apellido: Inclui que sean required. El minlength y maxlength lo recoge el pattern ( letras Minusculas, Mayuscula , vocales acentuadas, Ñ y espacios) al final donde coloco {3,40}    -->
    <body>
        <!-- Para poder procesar imagenes ( archivo) hay que colocar el atributo enctype="multipart/form-data" al form -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Nombre - email y Telefono</h3>
            <label for="inputNombre">Nombre :</label>
            <input type="text" name="nombre" id="inputNombre" required pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$" placeholder="Solo letras y espacio" title="El nombre debe tener entre 3 y 40 letras placeholder=" Solo letras y espacio">
            <br>
            <label for="primerApellido">Primer Apellido :</label>
            <input id="primerApellido" type="text" name="apellido1" required pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$" placeholder="Solo letras y espacio" title="El Apellido debe tener entre 3 y 40 letras (sin números).">
            <label for="segundoApellido">Segundo apellido :</label>
            <input id="segundoApellido" type="text" name="apellido2" required pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$" placeholder="Solo letras y espacio" title="El Apellido debe tener entre 3 y 40 letras (sin números).">
            <br>
            <label for="email">email :</label>
            <input id="email" type="text" name="email">
            <label for="telefono">Telefono</label>
            <input id="telefono" name="telefono" type="tel" pattern="[0-9]{9}" placeholder="9 dígitos">
            <br><br>
            <h3>Datos del Cuerpo</h3>
            <br>
            <label for="alto">Altura (m) :</label>
            <input id="alto" type="number" step="0.01" min="1.20" max="2.10">
            <label for="peso">Peso (kg) :</label>
            <input id="peso" type="number" name="peso" step="1" min="30" max="130">
            <br><br>
            <label for="foto">Foto cuerpo entero</label>
            <input id="foto" type="file" name="fotoCuerpoCompleto" accept="image/*" required>
            <br>
            <h4>Medidas para Armadura. Circunferencia de:</h4>
            <br>
            <label for="anchoPecho">Pecho (cm):</label>
            <input id="anchoPecho" type="number" min="60" max="120">
            <label for="anchoCintura">Cintura (cm):</label>
            <input id="anchoCintura" type="number" min="50" max="125">
            <label for="anchoCadera">Cadera (cm) :</label>
            <input id="anchoCadera" type="number" min="60" max="120">
            <h3>Direccion de envio</h3>

            <input type="text" name="calle" placeholder="Calle y número" autocomplete="address-line1">
            <input type="text" name="ciudad" placeholder="Ciudad" autocomplete="address-level2">
            <input type="text" name="cp" placeholder="Código Postal" autocomplete="postal-code">

            <!-- dirección de envío, comentarios (que es un campo de texto libre) y método de pago, con varias opciones: PayPal, transferencia bancaria, contra reembolso. -->
            <br>
            <h3>Metodo de Pago</h3>
            <fieldset>
                <legend>Selecciona un método de pago:</legend>

                <input type="radio" id="paypal" name="metodo_pago" value="paypal" checked>
                <label for="paypal">PayPal</label><br>

                <input type="radio" id="transferencia" name="metodo_pago" value="transferencia">
                <label for="transferencia">Transferencia bancaria</label><br>

                <input type="radio" id="reembolso" name="metodo_pago" value="reembolso">
                <label for="reembolso">Contra reembolso</label>
            </fieldset>
            <input type="submit"></input>
        </form>

        <!-- Aparece debajo del formulario y exito o error al colocar el nombre -->
        <!-- Se usa para mostrar los campos introducidos o su hubo un error -->
        <p id="reporte"></p>

        <?php
        // FUNCIÓN DE VALIDACIÓN: Centraliza la lógica. 
        // Si hay error devuelve un mensaje y sino devuelve ""
        function validarCampo($valor, $nombreCampo, $min, $max)
        {
            $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{{$min},{$max}}$/u";

            if (trim($valor) === "") {
                return "El campo $nombreCampo es obligatorio. ";
            }
            if (!preg_match($patron, $valor)) {
                return "El $nombreCampo debe tener entre $min y $max letras, no contener números y no ser vacio. ";
            }
            return ""; // Sin errores
        }

        // Este IF es el "escudo". Solo se ejecuta EL INTENTO DE VER $_POST["nombre"], si hay un envío real.
        // Sin esto da error porque leera todo el formulario y el script pero $_POST["nombre"] es nulo al cargar por 1era vez.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 1. Recogemos el dato  enviado por el FORMULARIO (o "" si no existe) 
            //! ?? "" : Es un operador que en caso de ser nulo el $_POST ( ??) le asigna un valor vacio ""
            $nombreRecibido = $_POST["nombre"] ?? "";
            $apellido1Recibido = $_POST["apellido1"] ?? "";
            $apellido2Recibido = $_POST["apellido2"] ?? "";
            $emailRecibido = $_POST["email"] ?? "";
            $telefonoRecibido = $_POST["telefono"] ?? "";
            $reporteValidacion = '';  // Creamos a reporte vacio porque luego le sumamos strings.
            // Si las validaciones salieron bien cada siguiente variable sera vacia ("")
            $resultadoValidarNombre = validarCampo($nombreRecibido, "Nombre", 3, 40);
            $resultadoValidarApellido1 = validarCampo($apellido1Recibido, "Apellido1", 3, 40);
            $resultadoValidarApellido2 = validarCampo($apellido2Recibido, "Apellido2", 3, 40);

            if ($resultadoValidarNombre === "") {
                $nombreRecibido = htmlspecialchars($nombreRecibido);
            } else {
                $reporteValidacion .= $resultadoValidarNombre . " ";
            }

            if ($resultadoValidarApellido1 === "") {
                $apellido1Recibido = htmlspecialchars($apellido1Recibido);
            } else {
                $reporteValidacion .= $resultadoValidarApellido1 . " ";

            }
            if ($resultadoValidarApellido2 === "") {
                $apellido2Recibido = htmlspecialchars($apellido2Recibido);
            } else {
                $reporteValidacion .= $reporteValidarApellido2 . " ";

            }
            if ($reporteValidacion === "") {  // Si la validacion de nombre y apellidos esta ok el reporteValidacion es vacio
                $reporteValidacion = "Validacion exitosa de nombre y apellido : " . $nombreRecibido . " " . $apellido1Recibido . " " . $apellido2Recibido . "";
            }

            if (filter_var($emailRecibido, FILTER_VALIDATE_EMAIL)) {
                $reporteValidacion .= "<br>"; // 
                $reporteValidacion .= "Validacion exitosa de email  : " . $emailRecibido . "";
            } else {
                $reporteValidacion .= "<br>";
                $reporteValidacion .= " Error en tipo de email: " . $emailRecibido;
            }

            // VALIDACION Y GUARDAR FOTO
            // 1. Verificar si hubo errores en la subida inicial.
            // LAS FOTOS LLEGAN POR LA VIA $_FILES 
            if (!isset($_FILES["fotoCuerpoCompleto"]) || $_FILES["fotoCuerpoCompleto"]["error"] !== UPLOAD_ERR_OK) {
                die("Error al subir el archivo.");
            }

            $archivo = $_FILES["fotoCuerpoCompleto"];


            // Validar el TIPO de imagen (MIME Type)
            // No confíes en la extensión .jpg, mejor verifica el contenido real
            $tiposPermitidos = ["image/jpeg", "image/png", "image/jpg"];
            $infoArchivo = getimagesize($archivo["tmp_name"]); // Verifica si es una imagen real
        
            if (!$infoArchivo || !in_array($infoArchivo["mime"], $tiposPermitidos)) {
                die("Error: Solo se permiten archivos JPG o PNG reales.");
            }

            // 3. Validar el tamaño (ejemplo: máximo 2MB)
            $maxSize = 2 * 1024 * 1024; // 2 Megabytes en bytes
            if ($archivo["size"] > $maxSize) {
                die("Error: El archivo es demasiado grande (máx 2MB).");
            }

            // 4. Mover el archivo a tu carpeta final
            $carpetaDestino = "uploads/";

            // Creamos la carpeta si no existe
            if (!is_dir($carpetaDestino)) {
                mkdir($carpetaDestino, 0777, true);
            }

            // Generamos un nombre único para evitar sobrescribir archivos con el mismo nombre
            $nombreLimpio = bin2hex(random_bytes(10)) . "." . pathinfo($archivo["name"], PATHINFO_EXTENSION);
            $rutaFinal = $carpetaDestino . $nombreLimpio;

            if (move_uploaded_file($archivo["tmp_name"], $rutaFinal)) {
                echo "¡Imagen subida con éxito! Guardada como: " . $nombreLimpio;
            } else {
                echo "Error crítico al mover el archivo.";
            }
        }
        ?>
        <!-- Para pasar la variable de php a js, hay que definirlas en este archivo porque en un archivo .js  no se reconoce php, pero aqui es php -->
        <script> const mensajeValidacion = '<?php echo $reporteValidacion ?>'</script>

        <script src="46_javaScript.js" async defer></script>
    </body>
</html>