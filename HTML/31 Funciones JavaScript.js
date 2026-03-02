// Archivo para probar funciones

function saludar(nombre) {
  // ! Importante: Usar comillas invertidas `` para usar la variable dentro del ${ }
  console.log(`"¡Hola, ${nombre}!`);
}

nombreParaSaludo = "Felix";
saludar(nombreParaSaludo);

// ? DEMOSTRACION QUE UNA FUNCION SIN RETURN RETORNA undefined
// ! No confundir la impresion por pantalla, que ocurre dentro de la funcion, con lo que retorna.
// * Al no tener un return  las funciones retornan undefined.

let valorFuncion; // Nueva variable para recibir el valor de la funcion.

/* Aqui le asignamos la funcion saludar a valorFuncion.
Veremos la impresion por pantalla de ! Hola, Pepe ! sin embargo lo que se asigna a valorFuncion  es undefined. Eso es asi, por definicion. */
valorFuncion = saludar("Pepe");

console.log("Que hay realmente dentro de la funcion? =" + valorFuncion); // Mostrara undefined.

// AMBITO DE LAS FUNCIONES
// Ámbito Global
function decirHola() {
  let varInvisible = "Variable que solo se ve dentro de la funcion";
  console.log("Hola a todos");
  console.log(varInvisible);
}

decirHola(); // Funciona en cualquier parte
//console.log(varInvisible); //! esto da error porque varInvisible se declaro dentro de la funsion decirHola()

// Definicion de funcion de expresion (asignada a una variable) en base a definicon normal de funcion 
let potenciaXaY = function (base, potencia) {
 return base ** potencia;
}
let base   = 3,
  potencia = 10;
console.log(` La potencia de ${base} a la ${potencia} es ${potenciaXaY(base, potencia)}`);

// Funcion flecha resumida ( Los parametros se colocan entre parentisis, separados con coma)
const potenciaXalaY = (base, potencia) => base ** potencia; // Hay un return implicito

console.log(` La potencia base flecha de ${base} a la ${potencia} es ${potenciaXalaY(base, potencia)}`);