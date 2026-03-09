<?php
/*
¿Qué hace esta simulacion?
for: Establece el contexto de prioridad (repite todo 3 veces).

foreach: Entra a mirar cada tarea individualmente.

if / else if: Aquí usamos el continue. Si la tarea es "Spam", el foreach salta directamente a la siguiente tarea sin ejecutar el switch ni los otros bucles internos.

while: Simula una acción que depende de una condición (en este caso, un solo intento de procesado).

switch: Clasifica la tarea. Nota que cada case lleva su break para no ejecutar los de abajo.

do-while: Garantiza que, pase lo que pase, se escriba al menos una línea de "Log" por cada tarea procesada.
*/

//! ENVOLVEMOS TODO EL SCRIPT ENTRE echo "<pre>"; Y AL FINAL echo "</pre>";
// ? El echo "<pre>"; hace que el HTML muestre la salida en varias lineas al incluir los -\n en los echos que estan en el codigo.
echo "<pre>";
// Definimos 2 arreglos, $prioridades y $tareas
$prioridades = ["Alta", "Media", "Baja"];

// Array asociativo. Cada registro tiene [clave, valor] y el total [[clave,valor], [clave, valor]....]
$tareas = [
    ["nombre" => "Arreglar Bug", "estado" => "pendiente"],
    ["nombre" => "Reunión", "estado" => "en_progreso"],
    ["nombre" => "Spam", "estado" => "ignorar"],
    ["nombre" => "Enviar reporte", "estado" => "completado"]
];

// 1. FOR: Recorremos las prioridades por índice e imprimimos en pantalla la prioridad y luego las tareas
for ($i = 0; $i < count($prioridades); $i++) {  //Count=3 y los valores son 0,1 y 2
    echo "--- Prioridad: " . $prioridades[$i] . " ---\n";

    // 2. FOREACH: Recorremos el array de tareas
    foreach ($tareas as $tarea) {

        // IF / ELSE IF: Filtro lógico
        if ($tarea['estado'] == "ignorar") {
            continue; // Saltamos esta tarea y seguimos con la siguiente del foreach
        } else if ($prioridades[$i] == "Baja" && $tarea['estado'] == "pendiente") {
            echo "Aviso: Tarea pendiente pero de baja prioridad.\n";
        }

        // 3. WHILE: Simulamos un intento de conexión para procesar la tarea
        $intentos = 0;
        while ($intentos < 1) {
            echo "Procesando: " . $tarea['nombre'] . "... ";

            // SWITCH: Decidimos qué hacer según el estado
            // Se le coloca los simbolos [], [>], [V] según el status.
            switch ($tarea['estado']) {
                case "pendiente":
                    echo "Status: [ ]\n";
                    break;
                case "en_progreso":
                    echo "Status: [>]\n";
                    break;
                case "completado":
                    echo "Status: [V]\n";
                    break;
                default:
                    echo "Status: Desconocido\n";
                    break;
            }
            $intentos++;
        }

        // 4. DO-WHILE: Una verificación final obligatoria
        // Para el ejemplo siempre se procesara el do-while 1 vez , asi que todas las tareas saldran con el mensaje "Log: Tarea registrada con éxito.
        $verificado = false;
        do {
            // Este código se ejecuta al menos una vez
            $verificado = true;
            echo "Log: Tarea registrada con éxito.\n";
        } while ($verificado == false);

        echo "\n";
    }
}

"</pre>";

?>