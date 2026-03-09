<h1>OPERADOR TERNARIO</h1>
<h2>Es un if else muy resumido.</h2>

<h2>Usa el simbolo ? como si te haces una pregunta</h2>

<pre>
$edad = 17;

$mensaje=$edad <18? "Eres Menor de edad pues tienes $edad":"Eres mayor de edad por tener $edad";

echo $mensaje." ";

Interesante: Se crea y se hace asignacion directa a la variable $mensaje y a su vez se decide que guardar.


</pre>

<?php

$edad = 17;

$mensaje = $edad < 18 ? "Eres Menor de edad pues tienes $edad" : "Eres mayor de edad por tener $edad";

echo $mensaje . " ";

?>