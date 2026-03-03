// Seleccionamos elemento h1
const etiquetaH1aModificar = document.querySelector("h1"); // "h1", busca el primer h1

// ! USO DEL textContent (Ver o reemplar el texto de un elemento HTML)
//? Obtener el texto de elemento h1
console.log("El texto en h1 es " + etiquetaH1aModificar.textContent);

//? Reemplazar el contenido del texto que aparece en h1 con elemento.textContent
// Lo sustituye de inmediato en la web aunque el html sigue igual.
// Como cambia el texto, las etiquetas las considera como texto y no como etiquetas.
etiquetaH1aModificar.textContent =
  "textContent cambia el h1 pero lo copia extual, POR EJEMPLO <u>elemento.textContent</u> p";

// ! USO DE innerHTML
/* inner = interior, parte interna. Se modifica lo interno pero NO se puede cambiar el tipo de etiqueta al seleccionarlo directamente. 
Si tenemos, por ejemplo un div con id="contenedor" y dentro una(s) etiquetas de h1 , el inner modificaria todo el contendio del contenedor.
*/
const etiquetaH2aModificar = document.querySelector("h2"); // busca el h2
// Inner es interior = contenido
// innerHTML si considera etiquetas dentro del texto y las aplica.
etiquetaH2aModificar.innerHTML = `Reemplazo contenido h2 usando <u>innerHTML</u>, el cual puede aplicar otras etiquetas`;

//! Ejemplo del innerHTML cambiando todo lo que esta en un div

/* En la siguiente instruccion "document.getElementById("miContenedor")" es el equivalente a crear una constante o variable, ejemplo 
const container = document.getElementById("miContenedor")  y luego aplicar container.innerHTML = "<h3>Solo quiero un h3</h3>"
*/
document.getElementById("miContenedor").innerHTML =
  "<h3>Elimino del div el h2, el p y el buttom y lo cambio por un h3</h3>";

//! Modificar el estilo del elemnto, por ejemplo el color del texto dentro del MiContenedor
document.getElementById("miContenedor").style.color = "blue";

// Le coloco violeta al texto del h2
etiquetaH2aModificar.style.color = "violet";

//! Cambiar atributos
// Como hay una sola etiqueta de img puedo usar querySelector
const imagenGato = document.querySelector("img");

// Obtiene el atributo src de imagenGato
console.log(imagenGato.getAttribute("src"));

// Fijat un nuevo atributo
imagenGato.setAttribute("src", "UnLolo.jpg");
// Fijamos el atributo Alt="Ahora teemos un Lolo"
imagenGato.setAttribute("Alt", "Ahora tenemos un Lolo");

// Imprime lo que tenemos en el atributo Alt
console.log(imagenGato.getAttribute("Alt"));

// !Crea un atributo o cambia existente
// También podemos cambiar clases o IDs
// ?Si el atributo ya existe, lo sobrescribe. Si no existe, lo crea.
/* 
Ahora, si hacemos F12 veremos que la etiqueta de img esta asi, con la class"fotoGato"

<img src="UnLolo.jpg" width="150px" height="auto" alt="Ahora tenemos un Lolo" class="fotoGato"> 
*/
imagenGato.setAttribute("class", "fotoGato");

// !Ojo, se usa += para SUMAR al HTML.
// si colocamos solo el = , sustituira todo el HTML, dentro del cuerpo y lo sustitira por el h4
/*Esta instruccion finalmente no la use porque al ser para el body, que tiene todo, 
yo añadi posteriormente un footer que tambien esta en el body y por lo tanto con
el += lo que se hace es sumar a lo que hay,  lo nuevo: es decir, lo pone al final.
Si en vez de usar el body, usamos un contenedor mas pequeño, seguramente si
funcionaria al ser controlada el area a sumar el h4, de este ejemplo   */
//document.querySelector("body").innerHTML += "<h4> Cambiamos el gato</h4>"; //Sumamos al body (+=) un h4


//! Adicion de un h3 justo antes del footer ( despues de la foto)
// 1. Seleccionamos al "Padre" (el body)
const padre = document.body;

// 2. Seleccionamos el elemento de "Referencia" 
// (Queremos que el h3 aparezca ANTES del footer)
const referencia = document.querySelector("footer");

// 3. Creamos el nuevo elemento h3
const nuevoH3 = document.createElement("h3");
nuevoH3.textContent = "Gato cambiado. De un Krono hemos colodo un Lolo";

// 4. Ejecutamos la inserción
padre.insertBefore(nuevoH3, referencia);

//! AÑADIR UNA CLASE A UN ELEMENTO.
// Añade una clase al elemento, que en este caso es un h3
//<h3 class="gato">Gato cambiado. De un Krono hemos colodo un Lolo</h3>
nuevoH3.classList.add("gato1", "perro");    

// toggle = alternar, cambiar . Si la clase existe la elimina o sino la crea.
nuevoH3.classList.toggle("gato");
