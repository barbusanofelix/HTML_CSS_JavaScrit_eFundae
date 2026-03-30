
// ... imports necesarios ...
import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelos.Usuario;

public class BeanServlet extends HttpServlet {
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // 1. Recogemos datos
        String nombre = request.getParameter("nombreUsuario");
        String msj = request.getParameter("mensajeUsuario");

        // 2. CREAMOS EL BEAN
        Usuario miUsuario = new Usuario();
        miUsuario.setNombre(nombre);
        miUsuario.setMensaje(msj);

        // 3. GUARDAMOS EL OBJETO COMPLETO
        request.setAttribute("usuarioObjeto", miUsuario);

        // 4. Despachamos a una NUEVA página
        request.getRequestDispatcher("/saludoBean.jsp").forward(request, response);
    }
}
