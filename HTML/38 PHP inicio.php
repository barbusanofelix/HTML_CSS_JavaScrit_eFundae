<!DOCTYPE html>
<html>
    <head>
        <title>Mi Primera Página PHP</title>
    </head>
    <body>
        <h1>Bienvenido a mi página con 1era instruccion PHP</h1>
        <p>Hay que tener la extension de PHP Server instalada en VS</p>
        <p>La funcion es date ( en ejemplo colocaron dato )</p>
        <p>Las comillas deben ser las verticalas doble " o la sencilla '. Comillas oblicuas no sirve</p>
        <p>Para correr en PHP : Boton derecho : PHP Server: Serve Project </p>
        <p>La fecha y hora actual es: <?php echo date("Y-m-d:i:s"); ?></p>
        <?php echo '¡Hola, mundo!, usando echo'; ?>
        <?php print 'Bienvenido a PHP, usando print'; ?>
        <ul>
            <!-- Usar : al final del for -->
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <li>Elemento <?php echo $i; ?></li>
            <?php endfor; ?>
        </ul>

        <?php

        $frutas = array("Manzana", 9.99, "Naranja", "Plátano", 100, true);
        var_dump($frutas);

        ?>
        <br>
        <!--ARREGLOS ASOCIATIVOS  -->
        <?php

        // Creamos el array con etiquetas personalizadas
        $casa = [
            "color" => "roja",
            "tamaño" => "grande",
            "pisos" => 2
        ];

        // Acceder a un dato específico es súper intuitivo:
        echo "El color de la casa es: " . $casa["color"] . "<br>" . "<br>"; // OJO: Para concatenar se usa .
        
        // casa contiene 
        echo "<pre>"; // Usar pre para que respete salida que enviaria el servidor que incluye un salto de linea al usar PHP_EOL  
        echo "La variable casa contiene:" . PHP_EOL; // PHP_EOL : End of Line ( equivale al <br>) pero en servidor
        var_dump($casa);
        echo "</pre>"

            ?>

        <p> Informacion de php , usar funcion phpinfo() <?php phpinfo(); ?></p>
    </body>
</html>