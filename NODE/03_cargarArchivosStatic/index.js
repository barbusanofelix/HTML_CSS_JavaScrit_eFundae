// CARGAR ARCHIVOS ESTATICOS UBICADOS EN LA CARPETA public DENTRO DEL PROYECTO


// Paso 1: Importamos express
const express = require('express');

// Creamos una instancia de express
const app = express();
// Configurar express para server archivos estáticos desde la carpeta public

// Hay que importar el path ( ruta )
const path = require(`path`);

// Para crear la ruta absoluta de la ubicacion de la carpeta public se usa __dirname que da la direccion del script que se ejecuta ( este mismo)
// y le unimos la carpeta public con el join.
// Por que hacer esto? Porque si ejecutamos este script desde otro directorio , aunque hagamos referencia al directorio donde esta, Node
// pensará que la carpeta public esta en el directorio desde donde se ejecuta asi que que colocar ./public no es seguro.
app.use(express.static(path.join(__dirname, `public`)));

const directorioEsteScript = __dirname;
console.log(`Este Script, ${__filename} se encuentra en ${directorioEsteScript}`)

const ubicacion_public = path.join(__dirname, `public`);
console.log(`El directorio public esta en la ruta absoluta  ${ubicacion_public}`); 


// Iniciar el servidor
const port = 3000;
app.listen(port, () => {console.log(`Servidor Express escuchando en el puerto ${port}`);});

// PARA LLAMAR LOS ARCHIVOS DESDE EL NAVEGADOR
// Si tenemos en la carpeta public un archivo llamado index.html podemos llamarlo asi:
// http://localhost:3000                    // Sin la barra final ...buscara el index.html
// http://localhost:3000/                   // Con la barra al final...igual muestra el index.html

// OJO, SI ESRIBIMOS DESPUES DE LA BARRA EL NOMBRE DEL ARCHIVO HAY QUE COLOCAR LA EXTENSION, INCLUSIVE PARA EL INDEX.HTML
// http://localhost:3000/index.html

// O por ejemplo para un 2do archivo que coloque llamado archivoEstatico.html
// http://localhost:3000/archivoEstatico.html 