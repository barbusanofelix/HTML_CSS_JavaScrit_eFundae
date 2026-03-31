<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calculadora de IMC</title>
        <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
      
    </head>
    <body>
        <div class="contenedor">
            <h1>Calculadora de Salud</h1>
            <h2>"${pageContext.request.contextPath}"</h2>
            <p>Introduce tus datos para calcular el Índice de Masa Corporal</p>

            <form action="CalcularImc" method="get">
                <div class="grupo-input">
                    <label for="peso">Peso (kg):</label>
                    <input type="number" id="peso" name="peso" step="0.1" placeholder="Ej: 75.5" required>
                </div>

                <div class="grupo-input">
                    <label for="altura">Altura (m):</label>
                    <input type="number" id="altura" name="altura" step="0.01" placeholder="Ej: 1.75" required>
                </div>

                <button type="submit" class="btn-calcular">Calcular IMC</button>
            </form>
        </div>
    </body>
</html>