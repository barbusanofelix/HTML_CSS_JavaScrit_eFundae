// 1. Pasamos el objeto boton a memoria buscandolo por id
const inputNombre = document.getElementById("inputNombre");
const reporte = document.getElementById("reporte"); // Es el p despues del formulario





// 2. Le asignamos un "escuchador de eventos"
// Sintaxis: elemento.addEventListener('evento', funcion)

inputNombre.addEventListener('mouseover', function(){
    reporte.textContent = ''; // Limpia el <p> debajo del formulario
    
    // alert(`El codigo esta en el archivo externo de javaScript`);
});
 


// 2. Usamos la variable que definimos en el HTML mensajeError
// Nota: 'mensajeError' viene del bloque <script> que pusimos al final del body en el HTML-php
if (mensajeValidacion !== "") {
    reporte. innerHTML = mensajeValidacion;  // Usamos el innerHTML ( interno) para que los <br> que vienen se rendericen. No funciona textContext porque es texto plano.
}