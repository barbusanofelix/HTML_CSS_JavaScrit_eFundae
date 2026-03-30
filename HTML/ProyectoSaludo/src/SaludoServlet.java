import java.io.IOException;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class SaludoServlet extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // 1. Recibimos lo que el usuario escribió en el formulario
        String nombre = request.getParameter("nombreUsuario");
        String msj = request.getParameter("mensajeUsuario");

        // 2. Preparamos el mensaje final combinando ambos
        String resultado = "¡Hola " + nombre + "! Tu mensaje fue: " + msj;

        // 3. Lo guardamos en el "request" para que la otra página lo vea
        request.setAttribute("mensajeFinal", resultado);

        // 4. Despachamos (enviamos) el control a saludo.jsp
        RequestDispatcher dispatcher = getServletContext().getRequestDispatcher("/saludo.jsp");
        dispatcher.forward(request, response);
    }
}
