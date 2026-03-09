//!  Reto 4 JavaScrip

/* Instrucciones
Aquí hay una guía rápida para comenzar: 
• Abre el editor de código 
• Crea un nuevo archivo con extensión ".js" (por ejemplo, "reto.js"). 
• Escribe tu código JavaScript dentro de este archivo para cumplir con los pasos del reto
Una vez abierto el editor, crea un programa que incluya al menos tres variables, una para cada tipo de dato primitivo: String, Number, Boolean.
Después, asigna valores a estas variables de acuerdo con lo siguiente: 
• String: Tu nombre completo. 
• Number: Tu edad. 
• Boolean: Verdadero si te gusta la programación, falso si no.
•	Luego, crea un objeto llamado persona 
	que represente información sobre ti, utilizando propiedades como nombre, edad y si te gusta programar.
•	Define un array llamado intereses que contenga al menos tres cadenas de texto representando tus intereses.
•	Finalmente, crea una función llamada mostrarInfo que acepte el objeto persona como parámetro y que muestre en la consola la información de la persona, incluyendo sus intereses.
•	No voy a pedirte más. Solo algunas recomendaciones de buenas prácticas, que ya deberías conocer: incluye comentarios para explicar cada sección de tu código y utiliza nombres de variables descriptivos.
•	Usa la guía de evaluación para saber si has superado el reto. Si es así, sube tu código, tu página y cualquier otro elemento a tu portfolio.


*/

// CEACION VARIABLES TIPOS PRIMITIVOS

let nombreCompleto; // Para string
let edad; // para number
let gustasProgramar; // para boolean
let estadoCivil; // string
let profesion; // string
let intereses; // arreglo de strings
let idiomas; // arreglo de strings

// Asignamos valores a las variables ( se puede hacer directamente en la definicion)
nombreCompleto = "Felix Concepcion Lopez Barbusano";
edad = 66;
gustasProgramar = true;
estadoCivil = "casado";
profesion = "Ingeniero";
intereses = ["programacion", "ciclismo", "diseño", "paseos"];
idiomas = ["Español", "Ingles medio"];

// Definir el objeto llamado persona ( objeto literal)
// Formado por clave / valor

const persona = {
  nombre: nombreCompleto, // Se asigna explicitamente
  edad, // Java deduce que queremos edad = 66
  gustasProgramar,
  estadoCivil,
  profesion,
  intereses,
  idiomas,
};

mostrarInfo(persona);
mostrarEsenciales(persona);

function mostrarInfo(persona) {
  // colocar nombre descriptivo al parametro, es decir, persona. JS lo toma como objeto
  for (const clave in persona) {
    // Colocamos SI o NO a los clave/valor que sean booleano
    if (typeof persona[clave] === "boolean") {
      if (persona[clave]) {
        persona[clave] = "si";
      } else {
        persona[clave] = "no";
      }
    }

    //Identificar si hay un array. Con typeof no sirve porque devuelve object
    if (Array.isArray(persona[clave])) {
      // devuelve true si el valor (persona[clave] es un array
      console.log(clave + " tiene " + persona[clave].length);
      console.log("Que son: ");
      for (const element of persona[clave]) {
        console.log("     " + element);
      }

      continue; // actua sobre el for
    }

    console.log(clave.padEnd(20) + " : " + persona[clave]); //padEnd(n) completa espacios para  tener n caracteres. Alinea
  }
}

function mostrarEsenciales({ nombre, edad }) {
  console.log();
  console.log("DATOS ESENCIALES");
  console.log("Nombre:".padEnd(20) + nombre);
  console.log("Edad :".padEnd(20) + edad);
}
