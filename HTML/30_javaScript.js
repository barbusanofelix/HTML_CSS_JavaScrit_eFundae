alert("Me llamaron al final del body con un src hacia el archivo js");

console.log("Primer mensaje en consola del navagador");

const edad = 15;

if (edad < 18) {
  console.error("¡Acceso denegado! Debes ser mayor de edad.");
} else {
  console.log("Bienvenido al sistema.");
}

if (edad == 15) {
  console.warn("Tiene 15 años!!!");
}

function saludar(nombre) {
  console.log("Hola " + nombre + "!!!");
}
saludar("Lucy"); // Invoca la funcion
