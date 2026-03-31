import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelos.Persona;

public class ServletImc extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // 1. EXTRAER: Datos del formulario
        String pesoStr = request.getParameter("peso");
        String alturaStr = request.getParameter("altura");

        // 2. CONVERTIR: A números
        double peso = Double.parseDouble(pesoStr);
        double altura = Double.parseDouble(alturaStr);

        // 3. CALCULAR: IMC actual
        double imc = peso / (altura * altura);
        imc = Math.round(imc * 100.0) / 100.0;

        // 4. CLASIFICAR
        String resultado;
        if (imc < 18.5) {
            resultado = "Bajo peso";
        } else if (imc < 25) {
            resultado = "Normal";
        } else if (imc < 30) {
            resultado = "Sobrepeso";
        } else {
            resultado = "Obesidad";
        }

        // 5. EMPAQUETAR Y GENERAR PROYECCIÓN
        Persona p = new Persona();
        p.setPeso(peso);
        p.setAltura(altura);
        p.setImc(imc);
        p.setDiagnostico(resultado);

        // Llenamos el mapa de proyección (+/- 10kg)
        p.getProyeccion().clear();
        for (int i = -10; i <= 10; i++) {
            double pesoVar = peso + i;
            double imcVar = pesoVar / (altura * altura);
            imcVar = Math.round(imcVar * 100.0) / 100.0;
            p.getProyeccion().put(pesoVar, imcVar);
        }

        // === PREPARAR DATOS PARA EL GRAFICO (Simplifica el trabajo al JSP) ===
        // Convertimos el Mapa en Listas para que JavaScript las lea más fácil
        java.util.List<Double> pesos = new java.util.ArrayList<>(p.getProyeccion().keySet());
        java.util.List<Double> imcs = new java.util.ArrayList<>(p.getProyeccion().values());

        // Guardamos todo en Sesión (la mochila que sobrevive a los clics)
        request.getSession().setAttribute("pesosGrafico", pesos);
        request.getSession().setAttribute("imcsGrafico", imcs);
        request.getSession().setAttribute("datosPersona", p);

        // 6. ENVIAR A LA VISTA
        request.getRequestDispatcher("resultado.jsp").forward(request, response);
    }
}