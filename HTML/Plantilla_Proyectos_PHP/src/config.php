<!-- DEFINE CONSTANTES DE CONFIGURACION.  -->

<!-- Cambiamos las constantes aqui para no cambiar en otros archivos y poder adaptar a 
      otras bases de datos  -->

<?php
// src/config.php

define('DB_HOST', 'localhost');     // host
define('DB_NAME', 'productos_db');  // Nombre base de datos
define('DB_USER', 'root');          // usuario
define('DB_PASS', '');              // pass word de usuario 
define('DB_CHARSET', 'utf8mb4');    // tipoe caracteres a usar.

// Puedes añadir más configuraciones aquí
define('CURRENCY', '€');