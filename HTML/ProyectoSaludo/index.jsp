<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de Saludo</title>
    </head>
    <body>
        <h2>Dime tu nombre y un mensaje</h2>
        <h2>Sigue el concepto basico del texto </h2>
        <form action="ProcesarSaludo" method="get">
            Nombre: <input type="text" name="nombreUsuario"><br><br>
            Mensaje: <input type="text" name="mensajeUsuario"><br><br>
            <input type="submit" value="Enviar al Servidor">
        </form>

<br><br><br><br>

<h2>Sigue el concepto de hacer Bean ( Buscar en IA) </h2>

        <form action="ProcesarConBean" method="get">
            Nombre: <input type="text" name="nombreUsuario"><br><br>
            Mensaje: <input type="text" name="mensajeUsuario"><br><br>
            <input type="submit" value="Enviar al Servidor">
        </form>
    </body>
</html>