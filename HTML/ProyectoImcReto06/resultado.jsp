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
                PASO 1: Localizar el objeto que el Servlet envió.
                El ID "datosPersona" debe ser idéntico al que usamos en request.setAttribute.
            --%>
            <jsp:useBean id="datosPersona" scope="request" class="modelos.Persona" />

            <%-- 
                PASO 2: Extraer datos necesarios ANTES de dibujar el HTML.
                Declaramos la variable 'diag' aquí arriba para evitar el error "cannot be resolved".
            --%>
            <% 
                String diag = datosPersona.getDiagnostico(); 
            %>

            <h1>Tu Análisis</h1>

            <div class="tarjeta-imc">
                <%-- 
                    PASO 3: Aplicar color dinámico al número.
                    toLowerCase().replace(" ", "-") convierte "Bajo peso" en "bajo-peso" 
                    para que coincida con nuestras clases .bajo-peso-text, .normal-text, etc.
                --%>
                <span class="valor-imc <%= diag.toLowerCase().replace(" ", "-") %>-text">
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
                        PASO 4: Pintar la tabla y resaltar la fila correcta.
                        Usamos el operador ternario para decidir qué clase CSS aplicar a cada <tr>.
                        Si la condición se cumple, se escribe el nombre de la clase (ej: "obesidad").
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
            <a href="index.jsp" class="btn-volver">Realizar otro cálculo</a>
        </div>
    </body>
</html>