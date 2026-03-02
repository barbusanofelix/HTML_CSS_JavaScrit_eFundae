// almacenamos todos los <li> en un arrego
// Usamos const porque el arreglo no a cambiar, despues de recibir la entrada
const seleccionLi = document.querySelectorAll("li");

// ---------------------------------------------------------
console.log("Primera forma funcion - flecha con llaves");

seleccionLi.forEach((li) => {
  console.log(li.textContent);
});
//----------------------------------------------------------

console.log("Segunda forma funcion - Palabra function  y {}");

seleccionLi.forEach(function (li) {
  console.log(li.textContent);
});
// -----------------------------------------------------------

console.log("Tercera forma de funcion - flecha sin () y {}");

seleccionLi.forEach((li) => console.log(li.textContent));
// -----------------------------------------------------------

console.log("Cuarta forma de funcion - Definirla y llamarla");

function imprimirTexto(elemento) {
  console.log(elemento.textContent);
}

// Solo pasamos el nombre de la función como referencia
seleccionLi.forEach(imprimirTexto);
// -------------------------------------------------------------
console.log("Quinta forma de recorrer  - con for ..of");

for (let li of seleccionLi) {
  console.log(li.textContent);
}

// Filtrado con letra B
console.log(" Filtrado por letra B");

seleccionLi.forEach((li) => {
  // Verificamos si el texto contiene la "B"
  if (li.textContent.includes("B")) {
    console.log("Encontrado con B: " + li.textContent);
  }
});

seleccionLi.forEach((li) => {
  // Verificamos si el texto contiene la "B"
  if (li.textContent === "Elemeto 1") {
    li.textContent = "Elemento 1";
    console.log("Debio cambiar el nombre");

    li.style.color = "red";
    console.log("Debio cambiar el color");

    li.style.fontSize = "2rem";
    console.log("Cambio el tamaño de letra");
  }
});
