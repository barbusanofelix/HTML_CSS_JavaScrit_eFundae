<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%-- 
    Importamos la clase Persona para que el JSP sepa cómo manejar el objeto 
    y poder usar sus métodos (como getDiagnostico) dentro del código Java.
--%>
<%@ page import="modelos.Persona" %>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Análisis de IMC</title>
        <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
    </head>
    <body>
        <div class="contenedor-resultado">
            <%-- 
                PASO 1: Localizar el objeto en la SESIÓN.
            --%>
            <jsp:useBean id="datosPersona" scope="session" class="modelos.Persona" />

            <%-- 
                PASO 2: Extraer datos con protección contra valores nulos.
            --%>
            <% 
                String diag = datosPersona.getDiagnostico();
                // Si diag es null (porque entramos directo a la URL), evitamos que falle
                if (diag == null) {
                    diag = "Pendiente";
                }
                
                // Preparamos la clase CSS: convertimos "Bajo peso" en "bajo-peso"
                String claseCssFiltro = diag.toLowerCase().replace(" ", "-");
            %>

            <h1>Tu Análisis</h1>

            <div class="tarjeta-imc">
                <%-- 
                    PASO 3: Aplicar color dinámico al número.
                    Usamos la variable claseCssFiltro que ya procesamos arriba.
                --%>
                <span class="valor-imc <%= claseCssFiltro %>-text">
                    <jsp:getProperty name="datosPersona" property="imc" />
                </span>

                <p>Tu categoría es: <strong>
                        <jsp:getProperty name="datosPersona" property="diagnostico" />
                    </strong></p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Rango IMC</th>
                    </tr>
                </thead>
                <tbody>
                    <%-- 
                        PASO 4: Pintar la tabla con el semáforo dinámico.
                    --%>
                    <tr class="<%= diag.equals("Bajo peso") ? "bajo-peso" : "" %>">
                        <td>Bajo peso</td>
                        <td>&lt; 18.5</td>
                    </tr>

                    <tr class="<%= diag.equals("Normal") ? "normal" : "" %>">
                        <td>Normal</td>
                        <td>18.5 - 24.9</td>
                    </tr>

                    <tr class="<%= diag.equals("Sobrepeso") ? "sobrepeso" : "" %>">
                        <td>Sobrepeso</td>
                        <td>25.0 - 29.9</td>
                    </tr>

                    <tr class="<%= diag.equals("Obesidad") ? "obesidad" : "" %>">
                        <td>Obesidad</td>
                        <td>&ge; 30.0</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <%-- Botón para ir a la futura gráfica --%>
            <a href="grafico.jsp" class="btn-calcular" style="background-color: #3498db; text-decoration: none; display: block; margin-bottom: 10px;">Ver Proyección Gráfica</a>

            <a href="index.jsp" class="btn-volver">Realizar otro cálculo</a>
        </div>
    </body>
</html>