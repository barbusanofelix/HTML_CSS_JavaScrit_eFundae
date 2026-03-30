<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <title>Página de Saludo</title>
    </head>
    <body>
        <h1><%= request.getAttribute("mensajeFinal") %></h1>
        <br>
        <a href="index.jsp">Volver atrás</a>
    </body>
</html>