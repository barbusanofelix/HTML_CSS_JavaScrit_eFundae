

public class Operadores {
    public static void main(String[] args) {
        // OPERADORES EN JAVA
        int suma = 7 + 3;           //suma
        int resta = suma - 4; // resta
        int multiplicacion = resta * 2;
        int modulo = 5 % 3;
        // LOGICOS
        boolean mayorQue = (5 > 4); // o sin los parentisis.
        boolean menorIgual = (10 <= 12);

        // AND = &&
        boolean resultadoAND = (5 > 3) && (8 > 6); //true

        // OR o ||
        boolean resultado0R = (5 < 3) || (8 > 6); // true
        // Operador NOT logico
        boolean resultadoNOT = !(5 == 3); // true

        System.out.println("La suma de 7 + 3 es :" + suma);
        System.out.println("La resta de suma-4 :" + resta);
        System.out.println("La multiplicacion de resta *2 es :" + multiplicacion);
        System.out.println("El modulo de 5%3 es :" + modulo);

        System.out.println("5 > 4 " + mayorQue);
        System.out.println("10 es menor o igual a 12 :" + menorIgual);
        System.out.println("(5 > 3) && (8 > 6) :" + resultadoAND);
        System.out.println("(5 < 3) || (8 > 6) :" + resultado0R);
        System.out.println("!(5 == 3) : "+resultadoNOT);
        


    }


}
