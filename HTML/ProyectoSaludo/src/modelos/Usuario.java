package modelos; // Es buena práctica poner los beans en un paquete

import java.io.Serializable;

public class Usuario implements Serializable {
    private String nombre;
    private String mensaje;

    // Regla 1: Constructor vacío
    public Usuario() {
    }

    // Regla 2 y 3: Getters y Setters
    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getMensaje() {
        return mensaje;
    }

    public void setMensaje(String mensaje) {
        this.mensaje = mensaje;
    }
}
