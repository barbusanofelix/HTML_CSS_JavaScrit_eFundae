<!-- DEFINE CONSTANTES DE CONFIGURACION.  -->

<!-- Cambiamos las constantes aqui para no cambiar en otros archivos y poder adaptar a 
      otras bases de datos  -->

<?php
//! src/config.php
//? CONSTANTES PARA BASES DE DATOS

define('DB_HOST', 'localhost');     // host
define('DB_NAME', 'productos_db');  // Nombre base de datos
define('DB_USER', 'root');          // usuario
define('DB_PASS', '');              // pass word de usuario 
define('DB_CHARSET', 'utf8mb4');    // tipoe caracteres a usar.

// Puedes añadir más configuraciones aquí
//? CONSTANTES PARA MONEDA A USAR
define('CURRENCY', '€');

//? CONSTANTES PARA PATRONES PERMITIDOS DE VALIDACION.
//! Patron para una direccion ( sin incluir ciudad y codigo postal)

// Explicacion del Patron Permitido ( Allowed) para el nombre de una ciudad
// Letras y acentos: Obvio para el español (Sevilla, Málaga).
// a-z : Todas las minusculas.
// A-Z : Todas las mayusculas
// áéíóúÁÉÍÓÚñÑ  : Permite las vocales acentudas y la ñ ( Minuscula y mayuscula) 
// 0-9 : Permite los digitos del 0 al 9 
// Para que PHP tome algunos simbolos o comando como el simbolo se usa la \ antes de colocarlo en el patron.
// \s : Permite espacios 
// \., : Permite el punto y la coma
// \/ : Permite la barra / 
// \-#ºª  : Permite -#ºª

define('ALLOWED_DIR', "a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.,\/\-#ºª");


// ? PATRON PARA  NOMBRE DE UNA CIUDAD
// Explicacion del Patron Permitido ( Allowed) para el nombre de una ciudad
// Letras y acentos: Obvio para el español (Sevilla, Málaga).
// a-z : Todas las minusculas.
// A-Z : Todas las mayusculas
// áéíóúÁÉÍÓÚñÑ  : Permite las vocales acentudas y la ñ ( Minuscula y mayuscula) 
// 0-9 : Permite los digitos del 0 al 9 
// Para que PHP tome algunos simbolos o comando como el simbolo se usa la \ antes de colocarlo en el patron.
// \s : Permite espacios 
// \' : permte '
// \- : Permite -
define('ALLOWED_CITY', "a-zA-ZáéíóúÁÉÍÓÚñÑ\s\'\-");

//? PATRON PARA UN CAMPO DE COMENTARIO
define('ALLOWED_COMMENTS', "a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.,\/\-#ºª");

//? PATRON PARA CAMPO NUMERICO SIMPLE
define('ALLOWED_NUMERIC',"0-9");

//? PATRON PARA ALFANUMERICOS: LETRAS Y NUMEROS.
define("ALLOWED_ALPHANUM", "a-zA-Z0-9");

//? PATRONES ALFANUMERICO LETRAS Y NUMERICO.
define("ALLOWED_NAME","a-zA-ZáéíóúÁÉÍÓÚñÑ\s");

// Valores permitidos para el radio button "metodo_pago"
define('OPCIONES_PAGO', ['tarjeta', 'paypal', 'transferencia', 'reembolso']);



