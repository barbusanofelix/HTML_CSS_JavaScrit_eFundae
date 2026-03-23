
import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.Set;

public class EstructurasControl {

    public static void main(String[] args) { // static : Que la clase no se hereda. void : No regresa un resultado
        // if-else
        int temperatura = 27;

        if (temperatura > 28) {
            System.out.println("La temperatura " + temperatura + " es calida");
        } else if (temperatura == 28) {
            System.out.println("Con una temperatura de " + temperatura + " estamos en el punto de equilibrio");
        } else if (temperatura < 28) {
            System.out.println("Con una temperatura de " + temperatura + " estamos en zona fresca ( Temperatura <28)");
        }

        // SENTENCIA SWITCH
        int mes = 3;

        String estacion = switch (mes) {
            case 1, 2, 3 -> "Inviernos";
            case 4, 5, 6 -> "Primavera";
            case 7, 8, 9 -> "Verano";
            case 10, 11, 12 -> "Otoño";
            default -> " Mes no valido";

        }; // Fin bucle asignacion con un switch ( OJO: Por ser instruccion de asignacion
           // termina con ;)
        System.out.println("La estacion es " + estacion);

        int dia = 4;

        switch (dia) {
            case 1:
                System.out.println("Lunes");
                break;
            case 2:
                System.out.println("Martes");
                break;
            case 3:
                System.out.println("Miercoles");
                break;
            // Puedes agregar más casos aquí
            default:
                System.out.println("Otro dia de la semana");

        } // Fin switch

        // Bucle for
        for (int i = 0; i < 5; i++) {

            System.out.println("Iteracion numero " + i);

        } // Fin bucle for

        // BUBLE DO-WHILE
        System.out.println("DO-WHILE con break en i=3");
        int i = 0;

        do {
            System.out.println("Iteracion numero " + i);

            i++;
            if (i==3) {
                break;
            }

        } while (i < 5); // fin bucle do-whilw

        // BUCLE WHILE
        System.out.println("Bucle While");
        int contador = 1; // 1. Inicialización

        // 2. Condición: Mientras el contador sea <= 5, el bucle sigue
        while (contador <= 5) {
            System.out.println("Ciclo número: " + contador);

            // 3. Actualización: Sumamos 1 al contador en cada vuelta
            contador++;
        } // Fin de bucle while

        // FOREACH EN UN ARRAY

        String[] frutas = { "Pera", "Mango", "Aguacate", "Fresa", "Lechosa" }; // Un array

        for (String elementoDe : frutas) { // elementoDe es un nombre arbitrario para recorrer frutas
            System.out.println(elementoDe);
        } // FIN foreach

        // foreach en LIST

        // Definamos un LIST de lenguajes.
        // Hay que hacer import java.util.ArrayList; y import java.util.List;
        List<String> lenguajes = new ArrayList<>();

        // Añadimos elementos al List lenguajes
        lenguajes.add("java");
        lenguajes.add("Python");
        lenguajes.add("php");
        lenguajes.add("JavaScript");

        for (String lenguajeProgramacion : lenguajes) {
            System.out.println(lenguajeProgramacion);
        }

        // CONJUNTOS O SETS
        // Los Set no tienen un orden indexado (no puedes hacer get(0)), asi que se recorren con foreach
        // Importar: import java.util.HashSet; y import java.util.Set;
        Set<Integer> numeros = new HashSet<>();
       
        // Adicionamos elementos a numeros
        numeros.add(30);
        numeros.add(10);
        numeros.add(100);
        numeros.add(30);   // Los Set ignoran duplicados

        for ( Integer n : numeros) {
            System.out.println("numeros no duplicados "+n);
        } // Fin foreach

        // MAP
        // Un Map guarda parejas de Clave-Valor. Para usar for-each aquí, lo más común es recorrer el "Set de entradas" (entrySet).
        // Importar Import java.util.HashMap;  y Import java.util.Map;
        // Veamos ejemplos de Pais - Capital

        Map<String, String> capitales = new HashMap<>();  // Creamos un Map : Clave-valor
        // Añadimos elementos al MAP
        capitales.put("Venezuela", "Caracas");
        capitales.put("Colombia", "Bogota");

        for (Map.Entry<String, String> entrada : capitales.entrySet()) {
            System.out.println("País: " + entrada.getKey() + " -> Capital: " + entrada.getValue());
        } // FIN foreach


        // El método .forEach() 
        //Desde Java 8, las colecciones tienen un método llamado .forEach() que acepta expresiones lambda.

        lenguajes.forEach(l -> System.out.println("Lenguajes con lambda " + l));


        // Ejemplo de precios con lambda
        List<Integer> precios = List.of(100, 200, 300);

        // Queremos aplicar un impuesto del 15% y mostrarlo
        precios.forEach(p -> {
            double total = p * 1.15;
            System.out.println("Precio con IVA: " + total);
        });
        
        // El siguiente nivel: Referencia de Métodos Si tu lambda solo toma un elemento y lo pasa tal cual a otro método (como System.out.println), puedes usar los dos puntos dobles (::). Es la forma más corta posible en Java:
        lenguajes.forEach(System.out::println);



    } // CIERRE MAIN

} // CIERRE CLASE
