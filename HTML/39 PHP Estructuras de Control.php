<!-- ESTRUCTURAS DE CONTROL -->

<!-- if (condición) {
// Código a ejecutar si la condición es verdadera
} -->

<!-- Ejemplo: -->

<?PHP

// ! SOLO IF
$edad = 20;

if ($edad >= 18) {
    // Para imprimir $edad como texto hay que usar \
    echo "La edad, en variable \$edad es :" . $edad . " asi que eres mayor de edad.";
}
// ! ELSE
echo "<br>";  // añadimos una linea

$edad = 16;
if ($edad >= 18) {
    echo "Eres mayor de edad por tener >= 18 años";# code...
} else {
    echo "Eres menor de edad ( <18 ) por tener " . $edad;
}

// ! ELSE IF
echo "<br>";
$calificacion = 80;

if ($calificacion > 90) {
    echo "Eres excelente al haber sacado >90 con calificacion de " . $calificacion . " puntos";
} elseif ($calificacion > 80) {
    echo "Esta muy bien ( >80 )  al haber obtenido " . $calificacion . " puntos";
} else {
    echo "Debes mejorar al estar <=80 y obtuvistes " . $calificacion . " puntos";
}

// ! BUCLE FOR
echo "<br>";
$ciclos = 5;
for ($i = 1; $i <= $ciclos; $i++) {
    if ($i === $ciclos) {
        echo "" . $i . ""; // No escribir , despues del numero
    } else {
        echo $i . ", ";# code...
    }
}

//! BUCLE WHILE 
// Para ciclos donde desconocemos, usualmente, cuantas veces se hara.
// En este caso lo hice igual que el for pero usualmente podria usarse para un menu, que se repita hasta 
// que la variable de control se convierta en falso.

echo "<br>";

$limiterandom = 20;
$random =  random_int(1, $limiterandom);

$cantidadCiclos = 0;
while ($random <> $limiterandom) {
    $random =random_int(1,$limiterandom);
    echo $random." ";
    $cantidadCiclos++;
}
echo "<br>";
echo "La cantidad de ciclos hasta generar un $limiterandom,  fue :".$cantidadCiclos;


//! BUCLE FOREACH
// ideal para recorrer arrays 

echo "<br>";
$colores=array("Rojo","Verde","Azul","Amarillo","Violeta","Crema") ;

echo "Nos pasearemos por los Colores :";
foreach ($colores as $color) {
    echo $color.", ";
}

?>