// Importamos
// Para importar de archivos en la misma carpeta se usa ./  por eso ponemos ./variablesParaExportar
const varImportada = require('./variablesParaExportar');  // Asi recupera todo el objeto literal ( Las 3 variables en el archivo variablesParaExportar)

// Si queremos extraer solo una variable , la colocamos entre {}  con el mismo nombre del origen {IVA} ó {PRECIO} ó {ARTICULO}
const { PRECIO } = require('./variablesParaExportar');   // Entre llave colocamos el nombre exacto de la variable que vendria y la recupera
// Importar funciones 
const funcion = require('./funcionesParaExportar');

// Para correlo con node.js simplemente abrimos la consola en el directorio de este script y escribimos
//  node principal.js      ( que sera lo mismo que darle al boton de correr dentro de VS code.)



// Recorrer el objeto literal para ver que se recibio ( Que sabemos que es IVA: 0.16, PRECIO: 2500, ARTICULO: 'TV32' 
console.log('Imprimir todo el objeto con las variables que importamos')
for (const clave in varImportada) {
    // Para mezclar ${} con otros strings hay que usar las comillas simples `  ( debajo de ^)
    console.log(`Clave ${clave} con el valor de ${varImportada[clave]}`); // Funciona con una comilla debajo de ^
}

console.log('Imrimir un solo elemento ...elegi ARTICULO')
console.log(`Para imprimir el articulo colocamos varImportada.ARTICULO : ${varImportada.ARTICULO}`)




console.log('Imprimir todoas las variables')
console.log(varImportada);  // salida { IVA: 0.16, PRECIO: 2500, ARTICULO: 'TV32' }
console.log(PRECIO);

console.log('Veamos que objetos llegaron desde funcionesParaExportar.js');

for (elemento in funcion) {   
    console.log(`El elemento ${elemento} es ${funcion[elemento]}`); // Cuando pedimos el valor el valor de las funcioens es la funcion completa
}

// Usemos las  funciones.
console.log('Funcion Saludar');
const nombre = "Felix";
const saludo = funcion.saludarUsuario(nombre);
console.log(`Para llamar la funcion escribimos funcion.saludarUsuario(nombre) y nos da : ${saludo}`);

const precioCompra = 1000;
const precioTotal = funcion.calcularTotal(precioCompra);
console.log(`Para el precio : ${precioCompra} tenemos un total, con iva de: ${precioTotal}`);