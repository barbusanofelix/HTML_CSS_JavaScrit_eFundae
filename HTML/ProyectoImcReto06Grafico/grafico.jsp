<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="modelos.Persona, java.util.List" %>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gráfico de Proyección - IMC</title>
        <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            .contenedor-grafico {
                background: white;
                padding: 2.5rem;
                border-radius: 15px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                width: 95%;
                max-width: 900px;
                margin: 20px auto;
                text-align: center;
            }

            h1 {
                color: #2c3e50;
                margin-bottom: 5px;
                font-size: 1.8rem;
            }

            .subtitulo {
                color: #7f8c8d;
                margin-bottom: 25px;
                font-size: 1.1rem;
            }

            .subtitulo strong {
                color: #2c3e50;
            }

            canvas {
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="contenedor-grafico">
            <%-- 1. Declaración del Bean y extracción segura de datos --%>
            <jsp:useBean id="datosPersona" scope="session" class="modelos.Persona" />
            <% 
                List<Double> pesos = (List<Double>) session.getAttribute("pesosGrafico");
                List<Double> imcs = (List<Double>) session.getAttribute("imcsGrafico");
                
                if (pesos == null) pesos = new java.util.ArrayList<>();
                if (imcs == null) imcs = new java.util.ArrayList<>();
                
                double pesoActual = datosPersona.getPeso();
                double alturaActual = datosPersona.getAltura();
                double imcActual = datosPersona.getImc();
            %>

            <%-- 2. Encabezado dinámico con los 3 valores --%>
            <h1>Evolución del IMC vs Variación de Peso</h1>
            <p class="subtitulo">
                Altura: <strong><%= alturaActual %>m</strong> |
                Peso: <strong><%= pesoActual %>kg</strong> |
                IMC Actual: <strong><%= imcActual %></strong>
            </p>

            <canvas id="miGrafico"></canvas>

            <script>
                // 1. Datos de Java y Usuario
                const etiquetas = [<% for (double p : pesos) { %> "<%= String.format(" % .2f", p) %>",<% } %>];
                const datosImc = [<% for (double i : imcs) { %> <%= i %>,<% } %>];
                const pesoUsuario = <%= pesoActual %>;

                const ctx = document.getElementById('miGrafico').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: etiquetas,
                        datasets: [{
                            label: 'Evolución del IMC',
                            data: datosImc,
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 7,
                            pointBackgroundColor: etiquetas.map(e => parseFloat(e) === pesoUsuario ? '#e74c3c' : '#ffffff'),
                            pointBorderColor: etiquetas.map(e => parseFloat(e) === pesoUsuario ? '#fff' : '#ffffff'),
                            pointBorderWidth: 1.5,
                            fill: false,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { title: { display: true, text: 'IMC' }, beginAtZero: false },
                            x: { title: { display: true, text: 'Peso (Kg)' } }
                        },
                        plugins: { legend: { display: false } }
                    },
                    plugins: [{
                        id: 'zonasColorSolidasYPrecisas',
                        beforeDraw: (chart) => {
                            const { ctx, chartArea: { top, bottom, left, right } } = chart;
                            const yScale = chart.scales.y;

                            ctx.save();
                            ctx.beginPath();
                            ctx.rect(left, top, right - left, bottom - top);
                            ctx.clip();

                            function drawZoneAndLabel(yMin, yMax, color, text) {
                                ctx.fillStyle = color;
                                const yTopPixel = yScale.getPixelForValue(yMax);
                                const yBottomPixel = yScale.getPixelForValue(yMin);

                                const rectTop = Math.max(yTopPixel, top);
                                const rectBottom = Math.min(yBottomPixel, bottom);
                                const rectHeight = rectBottom - rectTop;

                                if (rectHeight > 0) {
                                    ctx.fillRect(left, rectTop, right - left, rectHeight);

                                    // --- AJUSTE DE ETIQUETAS A LA IZQUIERDA ---
                                    ctx.fillStyle = '#ffffff';
                                    ctx.font = 'bold 0.9rem Arial';
                                    ctx.textAlign = 'left'; // Alineado a la izquierda
                                    ctx.textBaseline = 'middle';

                                    // 'left + 15' nos da un pequeño margen desde el eje Y
                                    const textX = left + 15;
                                    const centerY = rectTop + (rectHeight / 2);

                                    // ctx.fillText(text.toUpperCase(), textX, centerY);
                                    ctx.fillText(text, textX, centerY);
                                }
                            }

                            // Dibujo de zonas con opacidad 1
                            drawZoneAndLabel(0, 18.5, 'rgba(243, 156, 18, 1)', 'Bajo Peso');
                            drawZoneAndLabel(18.5, 25.0, 'rgba(39, 174, 96, 1)', 'Normal');
                            drawZoneAndLabel(25.0, 30.0, 'rgba(243, 156, 18, 1)', 'Sobrepeso');
                            drawZoneAndLabel(30.0, 100, 'rgba(231, 76, 60, 1)', 'Obesidad');

                            ctx.restore();
                        }
                    }]
                });
            </script>
            <br>
            <a href="resultado.jsp" class="btn-volver">Volver al resultado</a>
        </div>
    </body>
</html>