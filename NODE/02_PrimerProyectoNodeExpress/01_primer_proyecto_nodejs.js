// PASO 1. IMPORTAMOS A express
const express = require('express');

// PASO 2: INSTANCIAMOS A express para usa todos sus atributos y metodos.
// Es un objeto literal ( Un tipo list ) 
const app = express();

console.log('');
console.log(`MUESTRAS LOS OBJETOS DENTRO DE express EN EL ORDEN QUE LOS GENERA`);
let contador = 1;
for (const elemento in app) {
    // Usamos process.stdout.write en lugar de console.log para imprimir en la misma linea
    process.stdout.write(`${contador} ${elemento}, `);
    contador += 1;
}
console.log();
console.log();
console.log('');
console.log(`ORDENA TODOS LOS ELEMENTOS  DE express GENERANDO UN ARRAY Y LUEGO LOS UNE PARA CREAR UNA SOLA VARIABLE`);
// Obtener el listado anterior en orden alfabetico
// 1. Obtenemos las llaves, 2. Las ordenamos, 3. Las unimos con coma.  ( HAsta el punto 2 es un ARRAY)
const salidaOrdenada = Object.keys(app).sort().join(', ');
// Como salidaOrdenada es realmente una string en bloque al usar el join , usamos console.log() para imprimir esa variable.
console.log(salidaOrdenada);

console.log();
console.log();

console.log('');
console.log(`ORDENA LOS OBJETOS DENTRO DE express E IMPRIME EL ARRAY ORDENADO`);
const salidaOrdenadaEnElementos = Object.keys(app).sort();
let contador1 = 1;
// Para un ARRAY hay que usar for ...of 
for (const elemento of salidaOrdenadaEnElementos) {
    // Usamos process.stdout.write en lugar de console.log para imprimir en la misma linea
    process.stdout.write(`${contador1} ${elemento}, `);
    contador1 += 1;
}

// PASO 3 
// A.	Define una ruta utilizando el método HTTP deseado (GET, POST, PUT, DELETE, etc.)
// B.	Especifica la URL de la ruta y 
// C.	Una función de devolución de llamada para manejar la solicitud. 

app.get(`/`, (req, res) => {
    res.send(`¡Hola, mundo! hecho por Felix Lopez`);
});

 // PASO 4: DEFINE EL PUERTO 
const PORT = 3000;
		app.listen(PORT, () => {
		console.log(`Servidor escuchando en el puerto ${PORT}`);
		});
