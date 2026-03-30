<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <title>Mi Primer JSP</title>
    </head>
    <body>
        <h1>¡Hola Mundo desde JSP! hecho por Felix L.</h1>
        <p>La fecha y hora en el servidor es: <%= new java.util.Date() %></p>

        <% 
        String nombre = "Programador";
        out.print("Bienvenido, " + nombre);
    %>
    </body>
</html>