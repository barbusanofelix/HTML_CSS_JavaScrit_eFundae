// 1. Pasamos el objeto boton a memoria buscandolo por id
const boton = document.getElementById("btn");

// 2. Le asignamos un "escuchador de eventos"
// Sintaxis: elemento.addEventListener('evento', funcion)

boton.addEventListener(`click`, function(){
    alert(`El codigo esta en el archivo externo de javaScript`);
 });