<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<html>
    <body>
        <jsp:useBean id="usuarioObjeto" scope="request" class="modelos.Usuario" />

        <h1>Vía Bean: Hola
            <jsp:getProperty name="usuarioObjeto" property="nombre" />!
        </h1>
        <p>Tu mensaje fue:
            <jsp:getProperty name="usuarioObjeto" property="mensaje" />
        </p>

        <a href="index.jsp">Volver</a>
    </body>
</html>