package modelos; // Define la carpeta donde vive este archivo

import java.io.Serializable;

/**
 * Un JavaBean debe ser Serializable (para viajar por red),
 * tener un constructor vacío y atributos privados con Getters/Setters.
 */
public class Persona implements Serializable {
    // Atributos privados: nadie los toca desde fuera directamente (Encapsulación)
    private double peso;
    private double altura;
    private double imc;
    private String diagnostico;

    // Constructor vacío: Permite que el servidor cree el objeto antes de llenarlo
    public Persona() {
    }

    // GETTER: Permite leer el valor (Sacar datos del Bean)
    public double getPeso() {
        return peso;
    }

    // SETTER: Permite asignar el valor (Meter datos al Bean)
    public void setPeso(double peso) {
        this.peso = peso;
    }

    public double getAltura() {
        return altura;
    }

    public void setAltura(double altura) {
        this.altura = altura;
    }

    public double getImc() {
        return imc;
    }

    public void setImc(double imc) {
        this.imc = imc;
    }

    public String getDiagnostico() {
        return diagnostico;
    }

    public void setDiagnostico(String diagnostico) {
        this.diagnostico = diagnostico;
    }
}