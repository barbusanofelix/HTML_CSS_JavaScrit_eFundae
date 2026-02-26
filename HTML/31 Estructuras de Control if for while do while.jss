// Archivo corrido directo por la consola usando node
// Definimos la variable que servira de contador. Usual i
// Definimos hasta que numero lo repetira ( i<=5) , seran 5 veces: 1,2,3,4,5
// Definimos como se incrementa la i ( i++ , significa que tomara la i con el  que llega, hace la operacion y luego la incrmenta...por ejemplo inicia con 1, imprime y la incrementa,

// * IF
let desicion = 5;
if (desicion == 5) {
  console.log("Pues es 5!!");
}

// * IF - ELSE
if (desicion > 10) {
  // Bloque de código que se ejecuta si la condición es verdadera
  console.log("Desicion es mayor que 10");
} else {
  console.log("Desicion es menor que 10. Desicion es " + desicion);
}

if (desicion > 10) {
  // Bloque de código que se ejecuta si la condición1 es verdadera
  console.log("Desicion es mayor que 10");
} else if (desicion > 5) {
  // Bloque de código que se ejecuta si la condicion2 es verdadera
  console.log("Desicion es mayor que 5 y menor a 10");
} else {
  // Bloque de código si ninguna de las dos condiciones es verdadera
  console.log("Desicion es igual o menor que 5");
}

// * FOR
// for (inicialización; condición; actualización) {
//   Código a ejecutar en cada iteración
//  }
for (let i = 1; i <= 5; i++) {
  console.log(i);
}

//! for...in (Para Objetos)
// Este bucle está diseñado para "curiosear" dentro de un objeto y extraer sus nombres de propiedades (las llaves). Key-Value

// Uso principal: Recorrer las etiquetas de un registro.

// Qué obtiene: La llave (key). key del lado izquierdo.
// y con la llave o key se obtiene su .

// Teniendo un registro:

// ! ESTRUCURA STANDARD
// for (const llave in objeto) {
//   // Cuerpo del bucle
//   console.log(llave); // Imprime el nombre de la propiedad
//   console.log(objeto[llave]); // Accede al valor usando la llave
// }

const registro = {
  Fecha: "23-02-2026",
  Lectura: 150.5,
  Unidad: "kWh",
};
console.log("for");

let contadorKeys = 1;
for (let key in registro) {
  console.log("La llave " + contadorKeys + " es " + key);
  contadorKeys++;
}

for (let key in registro) {
  // 'key' toma el nombre de la llave (Fecha, Lectura, etc.)
  console.log("Campo: " + key + " | : " + registro[key]);
}

// ? Otro ejemplo de for ..in
var miRegistro = { Fecha: "23-02-2026", Lectura: "18,0" };

for (var campo in miRegistro) {
  // 1. 'campo' obtendrá primero "Fecha" y luego "Lectura"
  console.log("Nombre del campo: " + campo);

  // 2. Para ver el contenido, usamos el nombre del campo entre corchetes
  var valor = miRegistro[campo];
  console.log("Contenido de " + campo + ": " + valor);
}

// ! for...of (Para Arrays e Iterables)
// Introducido en ES6,(nversion JavaScript 2015) este bucle es mucho más directo cuando trabajas con listas (como tu array de registros).

// Uso principal: Recorrer los elementos de una lista uno por uno.

// Qué obtiene: El valor directo del elemento.

// Ejemplo: Una lista de lecturas
//Si el for...in era para "chismosear" las etiquetas de los cajones, el for...of es para sacar directamente lo que hay dentro. Es la forma más moderna, limpia y segura de recorrer una lista (Array) en JavaScript actual.
// ESTRUCUTRA GENERAL for..of

// for (const elemento of iterable) {
//   Código a ejecutar con cada 'elemento'
// }

console.log("for ...of");

const lecturas = [10.5, 18.0, 26.3];

for (let valor of lecturas) {
  // 'valor' toma directamente el número (10.5, luego 18.0...)
  console.log("La lectura es: " + valor);
}

// También funciona con Strings (itera letra por letra)
const palabra = "Node";
const caracteres = palabra.length;
let cuentaLetras = 1;
for (let letra of palabra) {
  // Para imprimir en la misma linea, en lugar de console.log
  if (cuentaLetras == caracteres) {
    process.stdout.write(letra);
  } else {
    process.stdout.write(letra + ", "); // N, o, d, e
  }
  cuentaLetras++;
}
console.log();
// * WHILE
let contador = 0;
while (contador < 3) {
  console.log("Hola!");
  contador++;
}

// ! Ejemplo con Map
// En un Map (Diccionarios modernos)
// Un Map es parecido a un objeto, pero más potente. Lo interesante es que for...of te permite obtener la llave y el valor al mismo tiempo usando algo llamado desestructuración.
const productos = new Map([
  ["Manzana", 1.5],
  ["Pan", 0.9],
  ["Leche", 1.1],
]);

// Recorremos obteniendo [llave, valor] en cada vuelta
for (const [nombre, precio] of productos) {
  console.log(`El producto ${nombre} cuesta ${precio}€`);
}

// ! EJEMPLO CON UN SET
// En un Set (Colecciones sin duplicados)
// Un Set es como un array, pero no permite valores repetidos. Es muy útil para filtrar listas.

const invitados = new Set(["Ana", "Pedro", "Ana", "Luis"]);
// El Set automáticamente borra la segunda "Ana"

for (const persona of invitados) {
  console.log(`Invitado: ${persona}`);
}
// Resultado: Ana, Pedro, Luis (Ana solo sale una vez)

//! EJEMPLO CON NodeList ( DOM )
// En NodeList (DOM - Elementos de la Web)
// Si alguna vez haces programación web, esta es la forma más común de recorrer elementos (como todos los botones de una página).

// Imaginemos que seleccionamos todos los párrafos de una web
// const parrafos = document.querySelectorAll("p");

// for (const p of parrafos) {
//     p.style.color = "blue"; // Cambia el color a todos los párrafos
// }

// ! En Arguments
// En arguments (Funciones clásicas)
// Dentro de una función, existe un objeto "misterioso" llamado arguments que contiene todo lo que le
// pasaste a la función.
function sumarTodo() {
  let total = 0;
  for (const numero of arguments) {
    total += numero;
  }
  return total;
}

console.log("La suma de los 3 argumentos es: " + sumarTodo(10, 20, 30)); // Resultado: 60

//! USO BREAK (salida de bucle)

let numeros = [1, 2, 3, 4, 5];

for (let i = 0; i < numeros.length; i++) {
  if (numeros[i] === 3) {
    console.log('Numero '+i + 'encontrado.');
    break; // Sale del bucle for
  }
}

//! USO DE continue
for (let i = 1; i <= 5; i++) {
  if (i % 2 === 0) {
    continue; // Salta las iteraciones para los números pares
  }
  console.log('Impar :'+i); // Este código solo se ejecuta para números impares
}

//* DO WHILE
contador = 0; // Ya se definio arriba a si que le reasigno cero
do {
  console.log("A dios!");
  contador++;
} while (contador < 3);
