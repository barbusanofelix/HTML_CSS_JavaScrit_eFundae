import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelos.Persona; // Importamos el molde que creamos arriba

public class ServletImc extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // 1. EXTRAER: Los datos del formulario llegan siempre como Texto (String)
        String pesoStr = request.getParameter("peso");
        String alturaStr = request.getParameter("altura");

        // 2. CONVERTIR: Transformamos el texto a números (double) para poder operar
        // Double.parseDouble lanza error si el texto no es un número válido
        double peso = Double.parseDouble(pesoStr);
        double altura = Double.parseDouble(alturaStr);

        // 3. CALCULAR: Aplicamos la fórmula matemática
        double imc = peso / (altura * altura);

        // Redondeo matemático: multiplica por 100, redondea al entero y divide por 100
        // (2 decimales)
        imc = Math.round(imc * 100.0) / 100.0;

        // 4. CLASIFICAR: Lógica de negocio basada en los rangos de salud
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

        // 5. EMPAQUETAR: Creamos el objeto Persona y guardamos todo dentro
        Persona p = new Persona();
        p.setPeso(peso);
        p.setAltura(altura);
        p.setImc(imc);
        p.setDiagnostico(resultado);

        // 6. ENVIAR: Guardamos el objeto en el 'request' con una etiqueta
        // ("datosPersona")
        // para que el JSP pueda encontrarlo después.
        request.setAttribute("datosPersona", p);

        // Reenviamos el control al JSP de resultados
        request.getRequestDispatcher("resultado.jsp").forward(request, response);
    }
}
