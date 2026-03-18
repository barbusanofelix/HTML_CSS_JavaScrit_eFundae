<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reto 5 Validacion Formulario</title>
        <link rel="stylesheet" href="estilos46.css">
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
                    <input id="alto" type="number" name="altura" step="0.01" min="1.20" max="2.10">
                </div>
                <div class="form__elementoGrid"">
                    <label for=" peso">Peso (kg) :</label>
                    <input id="peso" type="number" name="peso" step="1" min="30" max="130">
                </div>
            </div>


            <label for="foto">Foto cuerpo entero</label>
            <input id="foto" type="file" name="fotoCuerpoCompleto" accept="image/*" required>
            <hr class="form__lineaSeparador">


            <h3 class="form__titulos">Medidas para Armadura. Circunferencia de:</h3>

            <div class="form__fila  form__fila-tresColumnas">
                <div class="form__elementoGrid"">
                    <label for=" anchoPecho">Pecho (cm):</label>
                    <input id="anchoPecho" name="pecho" type="number" min="60" max="120">
                </div>
                <div class="form__elementoGrid"">
                    <label for=" anchoCintura">Cintura (cm):</label>
                    <input id="anchoCintura" name="cintura" type="number" min="50" max="125">
                </div>
                <div class="form__elementoGrid"">
                    <label for=" anchoCadera">Cadera (cm) :</label>
                    <input id="anchoCadera" name="cadera" type="number" min="60" max="120">
                </div>
            </div>

            <hr class="form__lineaSeparador">

            <h3 class="form__titulos">Direccion de envio</h3>

            <div class="form__fila  form__fila-tresColumnas">
                <div class="form__elementoGrid"">
                <input type=" text" name="calle" placeholder="Via:Avenida/Calle... y número" autocomplete="address-line1">
                </div>
                <div class="form__elementoGrid"">
                <input type=" text" name="ciudad" placeholder="Ciudad" autocomplete="address-level2">
                </div>
                <div class="form__elementoGrid"">
                <input type=" text" name="cp" placeholder="Código Postal" autocomplete="postal-code">
                </div>
            </div>


            <hr class="form__lineaSeparador">

            <h3 class="form__titulos">Comentarios</h3>

            <textarea class="form__comentarios" name="comentarios" rows="4" cols="80" maxlength="250" placeholder="Si cree necesario, añada algún comentario."></textarea>
            <hr class="form__lineaSeparador">
            <h3 class="form__titulos">Metodo de Pago</h3>
            <!-- Radio buttoms. Por defecto: atributo checked -->
            <fieldset>
                <legend>Selecciona un método de pago:</legend>

                <input type="radio" id="tarjeta" name="metodo_pago" value="tarjeta" checked>
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

        // FUNCIÓN DE VALIDACIÓN: Centraliza la lógica. 
        // Si hay error devuelve un mensaje y sino devuelve "" 
        
        function validarNombreApellido($valor, $nombreCampo, $min, $max)
        {
            // La / al inicio y la / final, antes de la u se necesitan en PHP para interpretar el patron y
            // adicional E IMPORTANTE , la u final le dice que interprete bien las vocales acentuadas y las ñ
            $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{{$min},{$max}}$/u";

            if (trim($valor) === "") {
                return "El campo $nombreCampo es obligatorio. ";
            }
            if (!preg_match($patron, $valor)) {
                return "El $nombreCampo debe tener entre $min y $max letras, no contener números y no ser vacio. ";
            }
            return ""; // Sin errores
        }

        function validarCampoNumerico($valor, $nombreCampo, $min, $max)
        {

            if (is_numeric($valor) && $valor >= $min && $valor <= $max) {
                return ""; // Validacion exitosa.
            } else {
                $nombreCampo = htmlspecialchars($nombreCampo);
                return "Error al validar el $nombreCampo, con valor de $valor,  el cual debe estar entre $min y $max";
            }

        }

        function validarDireccion($valor)
        { // En valor llega la direccion 
            // Explicación del patrón:
            // a-zA-ZáéíóúÁÉÍÓÚñÑ -> Letras con acentos
            // 0-9                -> Números
            // \s                 -> Espacios
            // \. , \/ \- # º ª   -> Caracteres especiales permitidos (escapados)
            // 1. Definimos el patrón de lo que SÍ permitimos (tu patrón)
            $permitidos = "a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.,\/\-#ºª";

            // 2. Buscamos CUALQUIER CARÁCTER que NO esté en esa lista
            // El símbolo [^ ] significa "negación"
            $patronProhibidos = "/[^" . $permitidos . "]/u";

            if (preg_match_all($patronProhibidos, $valor, $matches)) {
                // $matches[0] contiene un array con todos los caracteres ilegales encontrados
        
                // Eliminamos duplicados para no repetir el mismo error
                $caracteresEncontrados = array_unique($matches[0]);

                // Los unimos en una cadena para mostrarlos
                $listaProhibida = implode(" ", $caracteresEncontrados);

                echo "Error: La dirección contiene caracteres no permitidos: ** $listaProhibida **";
            } else {
                // Si no encontró nada prohibido, validamos la longitud
                if (mb_strlen($valor) < 5 || mb_strlen($valor) > 100) {
                    echo "Error: La dirección debe tener entre 5 y 100 caracteres.";
                } else {
                    echo "¡Dirección válida!";
                }
            }

        }

        function caracteresNoPermitidos($valor, $patron)
        {


        }

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
        

            $reporteValidacion = '';  // Creamos a reporte vacio porque luego le sumamos strings.
            $reporteValidacionError = '';   // creamos un reporte de las validaciones con error.  
            $reporteValidacionExitoso = '';
            // Si las validaciones salieron bien cada siguiente variable sera vacia ("")
            $resultadoValidarNombre = validarNombreApellido($nombreRecibido, "nombre", 3, 40);
            $resultadoValidarApellido1 = validarNombreApellido($apellido1Recibido, "apellido1", 3, 40);
            $resultadoValidarApellido2 = validarNombreApellido($apellido2Recibido, "apellido2", 3, 40);

            $resultadoValidarPeso = validarCampoNumerico($pesoRecibido, 'peso', 30, 120);  // Valida peso
            $resultadoValidarAltura = validarCampoNumerico($alturaRecibida, 'altura', 1.2, 2.10);  // Valida peso
        
            $resultadoValidarPecho = validarCampoNumerico($pechoRecibido, 'pecho', 60, 120);
            $resultadoCinturaRecibido = validarCampoNumerico($cinturaRecibido, 'cintura', 50, 125);
            $resultadoCaderaaRecibido = validarCampoNumerico($caderaRecibido, 'cadera', 60, 120);




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
                $reporteValidacionExitoso .= "Validacion exitosa de email  : " . $emailRecibido . "";
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= " Error en tipo de email: " . $emailRecibido;
            }

            // VALIDACION NUMERO TELEFONICO. Usamos patron regular ^[6789][0-9]{8}$ colocandolo entre /
            $patronTelefono = "/^[6789][0-9]{8}$/";    // envolver en las / y "
            if (preg_match($patronTelefono, $telefonoRecibido)) {
                $telefonoRecibido = htmlspecialchars($telefonoRecibido);
                $reporteValidacionExitoso .= "<br>";
                $reporteValidacionExitoso .= "Validacion exitosa telefono  : " . $telefonoRecibido;
            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= "Error de Validacion del telefono" . $telefonoRecibido;
            }


            if ($resultadoValidarPeso === "") {
                $reporteValidacionExitoso .= "<br>";
                $pesoRecibido = htmlspecialchars($pesoRecibido);
                $reporteValidacionExitoso .= "Validacion exitosa del peso " . $pesoRecibido;

            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarPeso;
            }

            if ($resultadoValidarAltura === "") {
                $reporteValidacionExitoso .= "<br>";
                $alturaRecibida = htmlspecialchars($alturaRecibida);
                $reporteValidacionExitoso .= "Validacion exitosa de la altura " . $alturaRecibida;

            } else {
                $reporteValidacionError .= "<br>";
                $reporteValidacionError .= $resultadoValidarAltura;
            }

            if ($resultadoValidarPecho === "") {
                $reporteValidacionExitoso .= "<br>";
                $pechoRecibido = htmlspecialchars($pechoRecibido);
                $reporteValidacionExitoso .= "Validacion exitosa del pecho " . $pechoRecibido;

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
                    $reporteValidacionExitoso .= "Imagen subida con exito como " . $nombreLimpio;

                } else {
                    //echo "Error crítico al mover el archivo.";
                    $reporteValidacionError .= "<br>";
                    $reporteValidacionError .= " Error crítico al mover el archivo..";
                    $noHayError = false;  // Activa que hubo un error para que se salga del bloque while
                    continue;

                }

            }

            $reporteValidacion .= "EXITOSO" . "<br>" . $reporteValidacionExitoso;
            $reporteValidacion .= "<br>" . "<br>";
            $reporteValidacion .= "ERRORES" . $reporteValidacionError;
        }
        ?>
        <!-- Para pasar la variable de php a js, hay que definirlas en este archivo porque en un archivo .js  no se reconoce php, pero aqui es php -->
        <script> const mensajeValidacion = '<?php echo $reporteValidacion ?>'</script>

        <script src="46_javaScript.js" async defer></script>
    </body>
</html>