<?php
// funciones.php
//* Tenemos funcion alerta() y funcion validarCamposTexto
// Modulo para funciones a reusar
/*
 En el archivo php que las queremos usar , iniciando el script de php colocamos:
        // Importar el módulo
        require_once 'funciones.php';

 */

/* Para asegurar que la funcion no se ejecute hasta cargar todo se usa:
document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({Aqui la parte interna del script})

Abajo podemos ver la aplicacion en la funcion alerta() y mas abajo, comentado la version 
original de la funcion sin document.addEventListener('DOMContentLoaded', function() {}

OJO: La funcion alerta debe usarse cargando en el head del html la linea:
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
*/

function alerta($mensajeMostrar)
{
    // Usamos stripslashes o htmlspecialchars para evitar que comillas en el mensaje rompan el JS
    $mensajeLimpio = addslashes($mensajeMostrar);

    return "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '¡Aviso!',
                    text: '$mensajeLimpio',
                    icon: 'info',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                console.error('SweetAlert2 no está cargado. Usando alert normal:');
                alert('$mensajeLimpio');
            }
        });
    </script>";
}


//  ESTA ES LA FORMA TRADICIONAL QUE RETORNA EL SCRIPT PARA LA ALERTA     
// function alerta($mensajeMostrar)
// {
//     return "
//     <script>
//         Swal.fire({
//             title: '¡Aviso!',
//             text: '$mensajeMostrar',
//             icon: 'info',
//             confirmButtonText: 'Aceptar'
//         });
//     </script>";

// }
//  -->


// FUNCION PARA VALIDAR CAMPOS DE FORMULARIOS RECIBIDOS EN PHP
// $valor : El valor que se recupera con $_POST['NombreCampo']
// $listaPermitidos : Pasamos la constante de patron regular que hemos definido en el archivo config.php
// $min y $max es la minima y maxima longitud del campo
// $nombreCampo: Pues el nombre del campo que estamos validando.

function validarCampoTexto($valor, $listaPermitidos, $min, $max, $nombreCampo)
{
    // Nos aseguramos de que $valor sea string y sin espacios extra
    // El operador ?? '' evita el error de trim(null) en PHP 8
    $valorLimpio = trim((string) ($valor ?? ''));

    // 1. Validar longitud primero (es más rápido)
    $longitud = mb_strlen($valorLimpio);
    if ($longitud < $min || $longitud > $max) {
        return "Error en $nombreCampo: Debe tener entre $min y $max caracteres.";
    }

    // 2. Detectar caracteres prohibidos
    $patronProhibidos = "/[^" . $listaPermitidos . "]/u";
    if (preg_match_all($patronProhibidos, $valorLimpio, $matches)) {
        $ilegales = implode(" ", array_unique($matches[0]));
        return "Error en $nombreCampo: Caracteres no permitidos: " . htmlspecialchars($ilegales);
    }

    return ''; // Todo perfecto
}


// VALIDAR NUMERO DE UN CAMPO DE UN FORMULARIO ( Aunque el campo realmente es un string) 
// $valor= es el valor recibido por $_POST['campo']
// $ min y $max : Los valores minimos y maximos que se espera del numero.
// $nombreCampo : El nombre del campo que tiene la identificacion name en el formulario.
// No se necesita constante porque se pregunta directamente si es numerico.
function validarNumero($valor, $min, $max, $nombreCampo)
{
    $valorLimpio = trim((string) ($valor ?? ''));

    // 1. ¿Es un número? (is_numeric acepta "10" o 10)
    if (!is_numeric($valorLimpio)) {
        return "Error en $nombreCampo: Debe ser un valor numérico.";
    }

    // 2. ¿Está en el rango?
    if ($valorLimpio < $min || $valorLimpio > $max) {
        return "Error en $nombreCampo: El valor debe estar entre $min y $max.";
    }

    return '';
}

/*
 * Valida que el valor recibido esté dentro de un array de opciones permitidas.
 * * @param string $valor El valor enviado por el formulario
 * @param array $listaOpciones El array con las opciones válidas (constante)
 * @param string $nombreCampo Nombre para el mensaje de error
 * @return string Mensaje de error o vacío si es correcto
 */
function validarLista($valor, $listaOpciones, $nombreCampo)
{
    $valorLimpio = trim((string) ($valor ?? ''));

    if (!in_array($valorLimpio, $listaOpciones)) {
        return "Error en $nombreCampo: La opción seleccionada no es válida.";
    }

    return ''; // Todo OK
}


?>