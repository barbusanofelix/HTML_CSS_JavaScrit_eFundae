<!--  Importamos para usar constantes de Patrones de validacion -->
<?php require_once 'config.php'; ?>

<!-- Importamos para usar funcion de Validar Campo Texto -->
<?php require_once 'funciones.php'; ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reto 5 Validacion Formulario</title>
        <link rel="stylesheet" href="estilos46.css">
        <!-- Activa el uso de funcion alerta elegante -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <!-- FORMULARIO : ESTA VALIDADO EN EL FRONT (html) Y VALIDADO EN EL SERVIDOR-->
    <!-- Enviamos el formulario a esta pagina colocando action="Nombre de esta misma pagina" -->
    <!--  Como se logra ir a esta misma pagina? -> simple es colocar action="" y con toda seguridad seria que entre las " " coloquemos el nombre de nuestra pagina que se logra con la variable magica $_SERVER['PHP_SELF], pero necesitamos "imprimir el nombre y entonces se usa el echo y como es instruccion de php hay que colocar la llamada y cierre a php -->
    <!-- Usamos POST porque manejaremos informacion sensible en este formulario. method="post" -->
    <!--Validacion de nombre y Apellido: Inclui que sean required. El minlength y maxlength lo recoge el pattern ( letras Minusculas, Mayuscula , vocales acentuadas, Ñ y espacios) al final donde coloco {3,40}    -->
    <body>
        <!-- Para poder procesar imagenes ( archivo) hay que colocar el atributo enctype="multipart/form-data" al form -->
        <form class="body__form-grid" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3 class="form__titulos">Datos básicos</h3>
            <div class="form__fila form__fila-unaColumna">
                <div class="form__elementoGrid">
                    <label for="inputNombre">Nombre(s) :</label>
                    <input type="text" name="nombre" id="inputNombre" required pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$" placeholder="Solo letras y espacio" title="El nombre debe tener entre 3 y 40 letras placeholder=" Solo letras y espacio">
                </div>
            </div>
            <div class="form__fila form__fila-dosColumnas">
                <div class="form__elementoGrid"">
                    <label for=" primerApellido">Primer Apellido :</label>
                    <input id="primerApellido" type="text" name="apellido1" required pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$" placeholder="Solo letras y espacio" title="El Apellido debe tener entre 3 y 40 letras (sin números).">
                </div>
                <div class="form__elementoGrid"">
                    <label for=" segundoApellido">Segundo apellido :</label>
                    <input id="segundoApellido" type="text" name="apellido2" required pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$" placeholder="Solo letras y espacio" title="El Apellido debe tener entre 3 y 40 letras (sin números).">
                </div>
            </div>
            <div class="form__fila form__fila-dosColumnas">
                <div class="form__elementoGrid"">
                    <label for=" email">email :</label>
                    <input id="email" type="text" name="email">
                </div>
                <div class="form__elementoGrid"">
                    <label for=" telefono">Telefono</label>
                    <!-- Numeros españoles empiezan en 6,7,8 ´9 y resto 8 digitos ^[6789][0-9]{8}$ -->
                    <input id="telefono" name="telefono" type="tel" pattern="^[6789][0-9]{8}$" placeholder="9 dígitos">
                </div>
            </div>
            <hr class="form__lineaSeparador"><!-- Una linea horizontal -->


            <h3 class="form__titulos">Datos del Cuerpo</h3>

            <div class="form__fila  form__fila-dosColumnas">
                <div class="form__elementoGrid"">
                    <label for=" alto">Altura (m) :</label>
                    <input id="alto" type="number" name="altura" step="0.01" min="1.20" max="2.10" required>
                </div>
                <div class="form__elementoGrid"">
                    <label for=" peso">Peso (kg) :</label>
                    <input id="peso" type="number" name="peso" step="1" min="30" max="130" required>
                </div>
            </div>


            <label for="foto">Foto cuerpo entero</label>
            <input id="foto" type="file" name="fotoCuerpoCompleto" accept="image/*" required>
            <hr class="form__lineaSeparador">


            <h3 class="form__titulos">Medidas para Armadura. Circunferencia de:</h3>

            <div class="form__fila  form__fila-tresColumnas">
                <div class="form__elementoGrid"">
                    <label for=" anchoPecho">Pecho (cm):</label>
                    <input id="anchoPecho" name="pecho" type="number" min="60" max="120" required>
                </div>
                <div class="form__elementoGrid"">
                    <label for=" anchoCintura">Cintura (cm):</label>
                    <input id="anchoCintura" name="cintura" type="number" min="50" max="125" required>
                </div>
                <div class="form__elementoGrid"">
                    <label for=" anchoCadera">Cadera (cm) :</label>
                    <input id="anchoCadera" name="cadera" type="number" min="60" max="120" required>
                </div>
            </div>

            <hr class="form__lineaSeparador">

            <h3 class="form__titulos">Direccion de envio</h3>

            <div class="form__fila  form__fila-tresColumnas">
                <div class="form__elementoGrid"">

                <input type=" text" name="calle" placeholder="Via:Avenida/Calle... y número" autocomplete="address-line1" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.,\/\-#ºª]{5,100}" title="Solo letras, números y símbolos como . , / - # º ª">
                </div>
                <div class="form__elementoGrid"">
                <input type=" text" name="ciudad" placeholder="Ciudad" autocomplete="address-level2" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\'-]{2,50}" title="Nombre de la Ciudad. Permitido letras, - y '">
                </div>
                <div class="form__elementoGrid"">
                <input type=" text" name="cp" placeholder="Código Postal" autocomplete="postal-code" pattern="[0-9]{5}" title="Codigo postal, solo digitos">
                </div>
            </div>


            <hr class="form__lineaSeparador">

            <h3 class="form__titulos">Comentarios</h3>

            <textarea class="form__comentarios" name="comentarios" rows="4" cols="80" maxlength="250" placeholder="Si cree necesario, añada algún comentario." pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.,\/\-#ºª]{5,100}"></textarea>
            <hr class="form__lineaSeparador">
            <h3 class="form__titulos">Metodo de Pago</h3>
            <!-- Radio buttoms. Por defecto: atributo checked -->
            <fieldset>
                <legend>Selecciona un método de pago:</legend>

                <!--Al colocar un ratio como required es como ponerle a todos  -->
                <input type="radio" id="tarjeta" name="metodo_pago" value="tarjeta" checked required>
                <label for="reembolso">Tarjeta debito o credito</label><br>

                <input type="radio" id="paypal" name="metodo_pago" value="paypal">
                <label for="paypal">PayPal</label><br>

                <input type="radio" id="transferencia" name="metodo_pago" value="transferencia">
                <label for="transferencia">Transferencia bancaria</label><br>

                <input type="radio" id="reembolso" name="metodo_pago" value="reembolso">
                <label for="reembolso">Contra reembolso</label>


            </fieldset>

            <div class="form__fila  form__elementoGrid">
                <input class="form__boton" type="submit">
            </div>
        </form>

        <!-- Aparece debajo del formulario y exito o error al colocar el nombre -->
        <!-- Se usa para mostrar los campos introducidos o su hubo un error -->
        <p id="reporte"></p>

        <?php

        // Este IF es el "escudo". Solo se ejecuta EL INTENTO DE VER $_POST["nombre"], si hay un envío real.
        // Sin esto da error porque leera todo el formulario y el script pero $_POST["nombre"] es nulo al cargar por 1era vez.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 1. Recogemos el dato  enviado por el FORMULARIO (o "" si no existe) 
            //! ?? "" : Es un operador que en caso de ser nulo el $_POST ( ??) le asigna un valor vacio ""
        
            $nombreRecibido = trim($_POST["nombre"] ?? "");             // nombre. String
            $apellido1Recibido = trim($_POST["apellido1"] ?? "");             // apellido, string
            $apellido2Recibido = trim($_POST["apellido2"] ?? "");             // apellido, string
        
            $emailRecibido = trim($_POST["email"] ?? "");             // email, email
            $telefonoRecibido = trim($_POST["telefono"] ?? "");             // telefono, pattern integers
        
            $alturaRecibida = trim($_POST["altura"] ?? "");             // number, 2 digitos de 1,20 a 2,10 m
            $pesoRecibido = trim($_POST["peso"] ?? "");             // number, integer de 60 a 120 
        
            $pechoRecibido = trim($_POST["pecho"] ?? "");             // number, integer de 60 a 120 cm
            $cinturaRecibido = trim($_POST["cintura"] ?? "");             // number, integer de 50 a 125 cm
            $caderaRecibido = trim($_POST["cadera"] ?? "");             // number, integer de 60 a 120 cm
        
            $viaRecibida = trim($_POST["calle"] ?? "");                 // Via recibida
            $ciudadRecibida = trim($_POST["ciudad"] ?? "");
            $cpRecibido = trim($_POST["cp"] ?? "");

            $comentariosRecibidos = trim($_POST["comentarios"] ?? "");

            $metodoPagoRecibido = trim($_POST["metodo_pago"] ?? "");


            $reporteValidacion = '';  // Creamos a reporte vacio porque luego le sumamos strings.
            $reporteValidacionError = '';   // creamos un reporte de las validaciones con error.  
            $reporteValidacionExitoso = '';
            // Si las validaciones salieron bien cada siguiente variable sera vacia ("")
            $resultadoValidarNombre = validarCampoTexto($nombreRecibido, ALLOWED_NAME, 3, 40, 'nombre');
            $resultadoValidarApellido1 = validarCampoTexto($apellido1Recibido, ALLOWED_NAME, 3, 40, 'apellido1');
            $resultadoValidarApellido2 = validarCampoTexto($apellido2Recibido, ALLOWED_NAME, 3, 40, 'apellido2');

            $resultadoValidarPeso = validarNumero($pesoRecibido, 30, 120, 'peso'); // Valida peso
            $resultadoValidarAltura = validarNumero($alturaRecibida, 1.2, 2.10, 'altura'); // Validar altura
        
            $resultadoValidarPecho = validarNumero($pechoRecibido, 60, 120, 'pecho');
            $resultadoValidarCintura = validarNumero($cinturaRecibido, 50, 125, 'cintura');
            $resultadoValidarCadera = validarNumero($pechoRecibido, 60, 120, 'cadera');

            // calle es realmente la direccion
            $resultadoValidarCalle = validarCampoTexto($viaRecibida, ALLOWED_DIR, 5, 100, 'calle');
            $resultadoValidarCiudad = validarCampoTexto($ciudadRecibida, ALLOWED_CITY, 2, 50, 'ciudad');
            $resultadoValidarCp = validarCampoTexto($cpRecibido, ALLOWED_NUMERIC, 5, 5, 'cp');

            $resultadoValidarComentarios = validarCampoTexto($comentariosRecibidos, ALLOWED_COMMENTS, 5, 100, 'comentarios');

            $resultadoValidarMetodoPago = validarLista($metodoPagoRecibido, OPCIONES_PAGO, 'metodo_pago');


            if ($resultadoValidarNombre === "") {
                $nombreRecibido = htmlspecialchars($nombreRecibido);
            } else {
                $reporteValidacionError .= $resultadoValidarNombre;
            }

            if ($resultadoValidarApellido1 === "") {
                $apellido1Recibido = htmlspecialchars($apellido1Recibido);
            } else {
                $reporteValidacionError .= $resultadoValidarApellido1;

            }
            if ($resultadoValidarApellido2 === "") {
                $apellido2Recibido = htmlspecialchars($apellido2Recibido);
            } else {
                $reporteValidacionError .= $reporteValidarApellido2;

            }
            if ($reporteValidacion === "") {  // Si la validacion de nombre y apellidos esta ok el reporteValidacion es vacio
                $reporteValidacionExitoso = "Validacion exitosa de nombre y apellido : " . $nombreRecibido . " " . $apellido1Recibido . " " . $apellido2Recibido . " ";
            }

            if (filter_var($emailRecibido, FILTER_VALIDATE_EMAIL)) {
                $reporteValidacionExitoso .= "<br>"; // 
                $reporteValidacionExitoso .= "Validacion exitosa de email  : " . htmlspecialchars($emailRecibido) . "";
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= " Error en tipo de email: " . htmlspecialchars($emailRecibido);
            }

            // VALIDACION NUMERO TELEFONICO. Usamos patron regular ^[6789][0-9]{8}$ colocandolo entre /
            $patronTelefono = "/^[6789][0-9]{8}$/";    // envolver en las / y "
            if (preg_match($patronTelefono, $telefonoRecibido)) {
                $telefonoRecibido = htmlspecialchars($telefonoRecibido);
                $reporteValidacionExitoso .= "<br>";
                $reporteValidacionExitoso .= "Validacion exitosa telefono  : " . htmlspecialchars($telefonoRecibido);
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= "Error de Validacion del telefono" . htmlspecialchars($telefonoRecibido);
            }


            if ($resultadoValidarPeso === "") {
                $reporteValidacionExitoso .= "<br>";
                $pesoRecibido = htmlspecialchars($pesoRecibido);
                $reporteValidacionExitoso .= "Validacion exitosa del peso " . htmlspecialchars($pesoRecibido);

            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarPeso;
            }

            if ($resultadoValidarAltura === "") {
                $reporteValidacionExitoso .= "<br>";
                $alturaRecibida = htmlspecialchars($alturaRecibida);
                $reporteValidacionExitoso .= "Validacion exitosa de la altura " . htmlspecialchars($alturaRecibida);

            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarAltura;
            }

            if ($resultadoValidarPecho === "") {
                $reporteValidacionExitoso .= "<br>";
                $pechoRecibido = htmlspecialchars($pechoRecibido);
                $reporteValidacionExitoso .= "Validacion exitosa del pecho " . htmlspecialchars($pechoRecibido);

            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarPecho;
            }

            //VALIDACION Y GUARDAR FOTO
            //1. Verificar si hubo errores en la subida inicial.
            // LAS FOTOS LLEGAN POR LA VIA $_FILES 
            $noHayError = true;
            while ($noHayError) {
                # code...
        
                if (!isset($_FILES["fotoCuerpoCompleto"]) || $_FILES["fotoCuerpoCompleto"]["error"] !== UPLOAD_ERR_OK) {
                    //die("Error al subir el archivo.");
                    $reporteValidacionError .= "<br>";
                    $reporteValidacionError .= "Error al subir la foto";
                    $noHayError = false;  // Activa que hubo un error para que se salga del bloque while
                    continue;
                }

                $archivo = $_FILES["fotoCuerpoCompleto"];


                // Validar el TIPO de imagen (MIME Type)
                // No confíes en la extensión .jpg, mejor verifica el contenido real
                $tiposPermitidos = ["image/jpeg", "image/png", "image/jpg"];
                $infoArchivo = getimagesize($archivo["tmp_name"]); // Verifica si es una imagen real
        
                $nombreArchivo = $_FILES['fotoCuerpoCompleto']['name']; // Ejemplo: "paisaje.png"
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);  // Indica la extension del archivo elegido
        


                if (!$infoArchivo || !in_array($infoArchivo["mime"], $tiposPermitidos)) {
                    //die("Error: Solo se permiten archivos JPG o PNG reales.");
                    $reporteValidacionError .= "<br>";
                    $reporteValidacionError .= " Error: Solo se permiten archivos JPG, JPEG o PNG reales y suministraste archivo." . $extension;
                    $noHayError = false;  // Activa que hubo un error para que se salga del bloque while
                    continue;
                }

                // 3. Validar el tamaño (ejemplo: máximo 2MB)
                $maxSize = 2 * 1024 * 1024; // 2 Megabytes en bytes
                if ($archivo["size"] > $maxSize) {
                    //die("Error: El archivo es demasiado grande (máx 2MB).");
                    $reporteValidacionError .= "<br>";
                    $reporteValidacionError .= " Error: El archivo es demasiado grande (máx 2MB).";
                    $noHayError = false;  // Activa que hubo un error para que se salga del bloque while
                    continue;
                }

                // 4. Mover el archivo a tu carpeta final, que se encuentra en el mismo directorio de esta aplicacion.
                $carpetaDestino = "46fotosDescargadas/";

                // Creamos la carpeta si no existe
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }

                // Generamos un nombre único para evitar sobrescribir archivos con el mismo nombre
                $nombreLimpio = bin2hex(random_bytes(10)) . "." . pathinfo($archivo["name"], PATHINFO_EXTENSION);
                $rutaFinal = $carpetaDestino . $nombreLimpio;

                if (move_uploaded_file($archivo["tmp_name"], $rutaFinal)) {
                    // echo "¡Imagen subida con éxito! Guardada como: " . $nombreLimpio;
                    $reporteValidacionExitoso .= "<br>";
                    $reporteValidacionExitoso .= "Imagen subida con exito como " . htmlspecialchars($nombreLimpio);

                } else {
                    //echo "Error crítico al mover el archivo.";
                    $reporteValidacionError .= "<br>";
                    $reporteValidacionError .= " Error crítico al mover el archivo..";
                    $noHayError = false;  // Activa que hubo un error para que se salga del bloque while
                    continue;

                }
            } // Fin del while de fotos
            if ($resultadoValidarCalle === "") {
                $reporteValidacionExitoso .= "<br>";
                $reporteValidacionExitoso .= "Via :" . htmlspecialchars($viaRecibida);
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarCalle;
            }

            if ($resultadoValidarCiudad === "") {
                $reporteValidacionExitoso .= "<br>";
                $reporteValidacionExitoso .= "Ciudad :" . htmlspecialchars($ciudadRecibida);
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarCiudad;
            }

            if ($resultadoValidarCp === "") {
                $reporteValidacionExitoso .= "<br>";
                $reporteValidacionExitoso .= "Codigo Postal :" . htmlspecialchars($cpRecibido);
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarCp;
            }

            if ($resultadoValidarMetodoPago === "") {
                $reporteValidacionExitoso .= "<br>";
                $reporteValidacionExitoso .= "Metodo de pago :" . htmlspecialchars($metodoPagoRecibido);
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarMetodoPago;
            }

            if ($resultadoValidarComentarios === "") {
                $reporteValidacionExitoso .= "<br>";
                $reporteValidacionExitoso .= "Comentarios :" . htmlspecialchars($comentariosRecibidos);
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarComentarios;
            }



            $reporteValidacion .= "EXITOSO" . "<br>" . $reporteValidacionExitoso;
            $reporteValidacion .= "<br>" . "<br>";
            $reporteValidacion .= "ERRORES" . $reporteValidacionError;
            str_replace("<br>", " ", $reporteValidacionError);
            echo alerta($reporteValidacionError);
        }
        ?>
        <!-- Para pasar la variable de php a js, hay que definirlas en este archivo porque en un archivo .js  no se reconoce php, pero aqui es php -->
        <script> const mensajeValidacion = '<?php echo $reporteValidacion ?>'</script>

        <script src="46_javaScript.js" async defer></script>
    </body>
</html>