// funcionesParaExportar.js
function calcularTotal(precio) {
    const impuesto = precio * 0.16; // Podríamos importar el IVA aquí también
    return precio + impuesto;
}

function saludarUsuario(nombre) {
    return `Hola, ${nombre}. Bienvenido al sistema.`;
}

const PRUEBA = "Es una prueba para ver que se pueden exportar mezcla de datos";
// Exportamos las funciones en un objeto literal
// Se exporta solo el nombre ...no se escribe calcularTotal() o que tienen parametros.
module.exports = {
    calcularTotal,
    saludarUsuario,
    PRUEBA
};