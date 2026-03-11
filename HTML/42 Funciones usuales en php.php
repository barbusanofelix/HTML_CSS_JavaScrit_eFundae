<?php

echo "FUNCIONES CON STRINGS O CADENAS DE TEXTO";
echo "<br>";

/*
Estas son el pan de cada día, ya que casi toda la entrada de un usuario es texto.

strlen($texto): 

str_replace($buscar, $reemplazar, $donde): Intercambia partes de un texto.

strtolower() / strtoupper(): Cambian a minúsculas o mayúsculas.

trim(): Elimina espacios en blanco al inicio y al final, pero NO reasigna el strim sin los caracteres en blanco.

*/
echo "<br>";

$mensaje = "   Hola Mundo PHP   ";                      // Mensaje de ejemplo
$mensajeSinEspacios = trim($mensaje);           // Mensaje sin los espacios de inicio y fin 
$lenMensajeSinEspacios = strlen($mensajeSinEspacios);      // Longitud de $mensaje sin los espacios al inicio y fin 
$mensajeMinusculas = strtolower($mensaje);       // Todas en minuscula  
$mensajeMayuscula = strtoupper($mensaje);       // Todas a mayusculas

echo 'Uso de funciones sobre Strings';
echo "<br><br>";
echo "Tenemos el mensaje:\"$mensaje\"";
echo "<br>";
echo "Que tiene una longitud de " . $lenMensajeSinEspacios . " contando 3 espacios vacios al inicio y 3 al final + 14 del Hola Mundo PHP";
echo "<br><br>";
echo "Quitemos los espacios vacios al inicio y final del string con trim(\$mensaje):\"$mensajeSinEspacios\"";
echo "<br>";
echo "Ahora el mensaje es :\"" . $mensajeSinEspacios . "\".Que ahora tiene " . $lenMensajeSinEspacios . " caracteres";
echo "<br>";           // Devuelve la longitud de la cadena:18
echo "<br>";
echo "Remplazo de partes de un string por otro string (cambiemos Mundo por Profe ) ";
echo "<br>";
echo $mensaje;               // Hola Mundo PHP
echo "=> reemplazamos Mundo por Profe :";
echo str_replace("Mundo", "Profe", $mensaje); // "  Hola Profe PHP  "

/*
Manejo de Arrays (Arreglos)
Los arrays en PHP son sumamente potentes y flexibles.

count($array): Cuenta los elementos.

array_push($array, $valor): Agrega un elemento al final.

in_array($busqueda, $array): Verifica si un valor existe en el arreglo (devuelve true/false).

explode($separador, $string): Convierte un string en un array.

implode($conector, $array): Une un array en un solo string.
*/
echo "<br><br>";
echo "MANEJO DE ARRAYS O ARREGLOS";

echo "<br>";
echo "Funcion count(array): Cuenta los elementos en el arreglo";
echo "<br><br>";

$frutas = ["Manzana", "Pera"];
// Hay que usar json_encode para imprimir el array con sus corchetes.
echo "Tenemos el arreglo frutas :" . json_encode($frutas); //Un array es complejo para colocar solo .$frutas
$cantidadElementos = count($frutas);
echo " que tiene " . $cantidadElementos . " elementos";
echo "<br><br>";
echo "Añadimos elementos al arreglo usando array_push(array) y añadiremos un Mango";
echo "<br>";
array_push($frutas, "Mango");  // Aparece un simbolo de & justo antes del $frutas...pero igual añade Mango
echo "Ahora el arreglo frutas :" . json_encode($frutas) . " que tiene " . count($frutas) . " elementos";
echo "<br><br>";
echo "Para saber si hay cierto elemento dentro del arreglo usamos : in_array(\$busqueda, \$array) ";
echo "<br>";
echo "Por ejemplo usamos un if (in_array(\"Pera\", \$frutas)) { echo \"¡Hay pera!\";} ";
echo "<br>";
echo "Y la salida del programa es: ";
if (in_array("Pera", $frutas)) {
    echo "¡Hay pera!";
}
echo "<br><br>";
echo "CONVERTIR UN STRING CON ALGUN SEPARADOR EN UN ARRAY";
echo "<br>";
echo "Por ejemplo tenemos un string : \$lista_csv = \"rojo,verde,azul\" , y podemos aprovechar las comas para separar los elementos, usando explode(\", \", \$lista_csv)";
echo "<br>";
echo "Asignamos el explode a un array, \$colores = explode(\",\", \$lista_csv); ";


$lista_csv = "rojo,verde,azul";
$colores = explode(",", $lista_csv); // ["rojo", "verde", "azul"]
echo "<br>";
echo "\$colores =" . json_encode($colores);

echo "<br><br>";
echo "FUNCIONES NUMERICAS Y MATEMATICAS";
/*

Para cálculos rápidos y validaciones.

is_numeric($var): Comprueba si es un número o un string numérico.

rand($min, $max): Genera un número entero aleatorio.

round($valor, $decimales): Redondea un número.
*/
echo "<br><br>";
echo "Generar un random entre 1 y 100 :";
echo rand(1, 100);       // Un número entre 1 y 100
echo "<br>";
echo "Redondear , por ejemplo a 2 decimales el numero 3,14159 :" . round(3.14159, 2);  // 3.14
echo "<br><br>";
echo "Saber si una variable contiene un numero como numero o como string";
$varNumero = 50.4;
echo "<br>";
echo "La variable \$varNumero contiene : " . $varNumero;
echo "<br><br>";
if (is_string($varNumero) && is_numeric($varNumero)) {
    echo "Es un **string** que contiene un número (Disfrazado).";
} elseif (is_numeric($varNumero)) {
    if (is_int($varNumero)) {
        echo "Es un numero entero";
    } else {
        echo "En un numero con decimales";
    }

} else {
    echo "No es un número de ningún tipo.";
}

echo "<br><br>";

echo "MANEJO DE FECHAS";
/*

PHP usa mucho el formato Unix o strings formateados.

date($formato): Devuelve la fecha actual formateada.

strtotime($string): Convierte una descripción de texto a una fecha (muy útil).
*/
echo "<br><br>";
echo "Mostrar la fecha en formato \"Y-m-d H:i:sde  :";
echo date("Y-m-d H:i:s");      // 2026-03-10 17:57:00
echo "<br><br>";

echo "Fecha actual mas 1 semana :";
echo date("d/m/Y", strtotime("+1 week")); // Fecha de hoy más una semana

echo "<br>";
echo "Fecha actual : ";
echo date("d/m/Y");

?>