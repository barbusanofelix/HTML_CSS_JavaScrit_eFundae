package javaBasico.FuncionCreaClase_04;
// Producto.jva contiene la clase Producto y esta en la misma carpeta FuncionCrearClase

public class Generador {
    public static void main(String[] args) {
        // Llamamos a la función y guardamos lo que nos devuelve
        Producto miNuevoProducto = crearProducto("Laptop", 1200.50); // Mandamos los atributos

        System.out.println("Producto creado: " + miNuevoProducto.nombre);
        System.out.println("Precio: $" + miNuevoProducto.precio);
    }

    // FUNCIÓN QUE DEVUELVE UNA CLASE (OBJETO)
    // Producto esta definido en archivo Producto.java
    public static Producto crearProducto(String nombre, double precio) {
        // Creamos la instancia dentro de la función
        Producto p = new Producto(nombre, precio);

        // La devolvemos al "mundo exterior"
        return p;
    }

}
