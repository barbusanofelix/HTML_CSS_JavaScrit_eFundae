package modelos;

import java.io.Serializable;
import java.util.LinkedHashMap; // <--- ESTO ES VITAL
import java.util.Map; // <--- ESTO ES VITAL

public class Persona implements Serializable {
    private double peso;
    private double altura;
    private double imc;
    private String diagnostico;

    // El mapa donde guardaremos los datos de la gráfica
    private Map<Double, Double> proyeccion = new LinkedHashMap<>();

    public Persona() {
    }

    // Getters y Setters anteriores...
    public double getPeso() {
        return peso;
    }

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

    // EL MÉTODO QUE LE FALTA A TU SERVLET:
    public Map<Double, Double> getProyeccion() {
        return proyeccion;
    }

    public void setProyeccion(Map<Double, Double> proyeccion) {
        this.proyeccion = proyeccion;
    }
}