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
        <!-- Para poder procesar imagenes ( archivo) hay que colocar el atributo enctype="multipart/form-data" al formulario -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Nombre - email y Telefono</h3>
            <label for="nombre">Nombre :</label>
            <input id="nombre" type="text" name="nombre" id="inputNombre" required pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$" placeholder="Solo letras y espacio" title="El nombre debe tener entre 3 y 40 letras placeholder=" Solo letras y espacio">
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
            <h3>DATOS DEL CUERPO</h3>
            <br>
            <label for="alto">Altura (cm) :</label>
            <input id="alto" type="number">
            <label for="peso">Peso (kg) :</label>
            <input id="peso" type="number" name="peso">
            <label for="foto">Foto cuerpo entero</label>
            <input id="foto" type="file" name="fotoCuerpoCompleto" accept="image/jpg, image/png, image7jpeg">
            <br>
            <h4>Medidas para Armadura. Circunferencia de:</h4>
            <br>
            <label for="anchoPecho">Pecho :</label>
            <input id="anchoPecho" type="number">
            <label for="anchoCintura">Cintura :</label>
            <input id="anchoCintura" type="number">
            <label for="anchoCadera">Cadera :</label>
            <input id="anchoCadera" type="number">

            dirección de envío, comentarios (que es un campo de texto libre) y método de pago, con varias opciones: PayPal, transferencia bancaria, contra reembolso.
            <br>
            <button type="submit">Enviar</button>
        </form>

        <!-- Aparece debajo del formulario y exito o error al colocar el nombre -->
        <!-- Se usa para mostrar los campos introducidos o su hubo un error -->
        <p id='reporte'></p>

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

        }
        ?>
        <!-- Para pasar la variable de php a js, hay que definirlas en este archivo porque en un archivo .js  no se reconoce php, pero aqui es php -->
        <script> const mensajeValidacion = '<?php echo $reporteValidacion ?>'</script>

        <script src="46_javaScript.js" async defer></script>
    </body>
</html>