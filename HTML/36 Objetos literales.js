// ! OBJETOS LITERALES ( Construido a partir de https://www.youtube.com/watch?v=njWlkfDGo9k)

/* 
* Un objeto literal en JavaScript es una lista de pares de nombre:valor (también llamados clave:valor) encerrados entre llaves {}. Es la forma más sencilla y común de estructurar datos relacionados sin necesidad de crear una clase o un constructor.

Se les llama "literales" porque los escribes exactamente como quieres que sean, literalmente definiendo su contenido en el código fuente mediante una sintaxis de inicialización fija ({ ... }).
*/

/*
? Los elementos que pueden formar los valores pueden ser cualquier tipo de dato u objeto:

?    Tipos primitos 
?    Otros Objetos ( como otro objeto literal )
?    Arrays 
?    Funciones ( metodos )
?    fechas ( date ) 
?    ....no hay restriccion en lo que se puede meter   */

// fORMA ANTIGUA DE CREAR UN OBJETO LITERAL.
const persona = new Object();

// AÑADIR PARES CLAVE - VALOR
// crea las clave y le da su valor. ( CLAVE - VALOR )
persona.nombre = "Felix";
persona.apellido = "Lopez";

console.log(persona); // Salida: { nombre: 'Felix', apellido: 'Lopez' }

// ! FORMA MODERNA DE CREAR OBJETOS LITERALES

let personas = {}; // Defini con let para reasignar la variable personas
console.log(personas); // Salida : {}  ...es decir, objeto vacio.

// * Añadir valores en forma sencilla
// * Se hace en la misma deficion, si queremos.
// Al crear seria const estudiante {...} pero para cambiarlo use let
// Para crear elementos simplemente se escriben como a continuacion...clave/Valor.

const estudiante = {
  nombre: "Juan", // Se usan : y no = , por la definicion de clave-valor
  apellido: "Lopez",
  edad: 30,
  adorasProgramar: true,
  idiomas: ["Español", "Ingles"],
  direccion: {
    calle: "Amistad",
    numero: 7,
  },

  nombreCompleto: function () {
    return `${this.nombre} ${this.apellido}`;
  },
  saludar: function () {
    console.log(`Hola ${this.nombreCompleto()}`);
  },
  adios() {
    console.log(`Adios ${this.nombreCompleto()}`); // Tienes que lalmar a la funcion con ()
  },
};

// ? AGREGAR Clave / vALOR:
estudiante.telefono = "643537550"; // ! ojo, Asignacion con "=" y no ":"

console.log(estudiante);

// ? BORRAR un elemento.
delete estudiante.edad; //! "delete" separado de "estudiante.telefono"

console.log(estudiante);

//* MOSTRAR PROPIEDADES EN PARTICULAR: Clave / Valor
console.log(estudiante.nombre); // Juan
console.log(estudiante["nombre"]); // JUan. Hace lo mismo estudiante.nombre

//* CAMBIAR EL VALOR DE UNA CLAVE
estudiante.nombre = "Juan Andres";

console.log(estudiante.nombre); // Cambio nombre de JUan a Juan Andres

estudiante["apellido"] = "Lopez Rodriguez"; // equivale a estudiente.apellidos ="Lopez Rodriguez"

console.log(estudiante.nombre + " - " + estudiante.apellido);

//! METODOS DE LOS OBJETOS LITERALES
// * Es basicamente una clave / valor dondel el valor en una funcion.

console.log(estudiante.nombre + " * " + estudiante.apellido);

// La clave que lleva a la funcion es nombreCompleto
console.log(estudiante.nombreCompleto()); //! Ojo, al ser funcion se coloca (). NombreClave()

estudiante.saludar(); // Funcion saludas que se combina con a funsion nombre compelto

estudiante.adios();
