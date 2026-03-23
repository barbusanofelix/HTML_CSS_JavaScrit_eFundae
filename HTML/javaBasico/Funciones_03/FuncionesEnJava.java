public class FuncionesEnJava {

    public static void main(String[] args) {
        double precio = 100;
        double precioConIva = calcularIva(precio);

        System.out.println("El total del precio: " + precio + " con IVA es " + precioConIva);

        int resultadoSuma = sumar(3, 5); // Sumar se llama directamente porque es static
        System.out.println("La suma de 3 + 5 es " + resultadoSuma);

        // Para usar el metodo saludar() , que no es static, necesitamos crear primero
        // instancia
        FuncionesEnJava MiFuncion = new FuncionesEnJava();

        MiFuncion.saludar();

    } // FIN MAIN

    // 1. Definición del método o funcion calcularIva
    // ! Fijate que la funcion ó metodo calcularIva va dentro de la clase pero fuera
    // del método main
    public static double calcularIva(double precioBase) { // static significa que puede llamarse sin crear un objeto. Es
                                                          // metodo de la Clase.
        double impuesto = precioBase * 0.21;
        return precioBase + impuesto; // 2. Devuelve el resultado
    } // fin calcularIva

    // Método PUBLIC y STATIC
    public static int sumar(int a, int b) {
        return a + b;
    }

    // Método PUBLIC pero NO STATIC (de instancia)
    public void saludar() {
        System.out.println("Hola, soy una calculadora");
    }

}
