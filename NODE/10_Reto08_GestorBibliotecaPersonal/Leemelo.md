# RETO 08. GESTOR DE BIBLIOTECA PERSONAL.

Usaremos ES Modules (el estándar moderno de import/export) y una arquitectura de carpetas limpia.

La idea es crear una aplicación donde registramos libros que has leído o quieres leer.

Funcionalidad: Podrás añadir libros (POST), ver la lista (GET), editar detalles como la calificación (PUT) y eliminar los que ya no quieras (DELETE).

Estilos (BEM): Usaremos bloques como .card, .form-group y .button para que el CSS sea escalable y fácil de entender.

Vistas: Usaremos un motor de plantillas (como EJS) para renderizar el HTML dinámico directamente desde el servidor.

# 🗺️ Hoja de Ruta (El Camino)
Dividiremos el desarrollo en estas etapas:

## Fase 1: 
Preparación. Configuración del entorno, estructura de carpetas e instalación de dependencias base.

## Fase 2: 
Servidor Base. Levantar Express y configurar la entrega de archivos estáticos y el motor de plantillas.

## Fase 3: 
Conexión a Base de Datos. Configurar MongoDB y definir el Modelo de datos (cómo es un "Libro").

## Fase 4: 
Rutas y Lógica (Controladores). Crear las funciones que responden a los verbos HTTP.

## Fase 5: 
Interfaz (HTML/CSS con BEM). Crear las vistas y aplicar los estilos manuales con CSS3.

## 🛠️ Paso 1: Inicialización y Estructura
Antes de escribir código de servidor, debemos preparar el terreno. Sigue estos pasos en tu terminal/consola:

### Crea la carpeta del proyecto:  
 
 ---
```bash
    mkdir 10_Reto08_GestorBibliotecaPersonal   
```
---

 y entra en ella cd gestor-libros.

### Inicializa Node.js:   

---
```bash
npm init -y
```
---  

Esto creará el archivo package.json. La opcion **-y** hace que no te pregunte parametros del proyecto, que son los que puedes ver en el archivo package.json ( Si no respondes nada te mostrará el valor por defecto).

### Configura Módulos:

Abre el archivo package.json y añade la línea 

```json
"type": "module", 
```
---

justo debajo de "main": "index.js",. **Esto nos permitirá usar import en lugar de require.**

**OJO**: El package.json solo puede tener una clave "type" asi que hay que borrar el ultimo "type": "commonjs"

### Instala las dependencias iniciales:

---
```bash
npm install express mongoose ejs dotenv**
```
---

(Express para el servidor, Mongoose para Mongo, EJS para el HTML dinámico y Dotenv para variables de entorno).

### Ajustar el script en package.json

Cambiar la parte del script por esta:

---
```javascript
"scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "start": "node app.js",
    "dev": "node --watch app.js"
  },
```
---


**start:** Es el comando estándar para producción. Se ejecuta con npm start.

**dev:** Usa la bandera --watch (disponible en Node.js v18.11+). Esto hace que, cada vez que guardes un cambio en el código, el servidor se reinicie solo. Se ejecuta con npm run dev.

El archivo package.json debe quedar asi:



```json
{
  "name": "10_reto08_gestorbibliotecapersonal",
  "version": "1.0.0",
  "description": "",
  "main": "app.js",
  "type": "module",
  "scripts":  {
    "start": "node app.js",
    "dev": "node --watch app.js",
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC",
  "dependencies": {
    "dotenv": "^17.4.2",
    "ejs": "^5.0.2",
    "express": "^5.2.1",
    "mongoose": "^9.4.1"
  }
}
```
---


Donde podemos observar que tenemos:  

main es app.js   
type es module  

 Tenemos el scripts como se indico en el punto de "Ajustar el script en package.json  
 y tenemos un bloque de dependencies que se incluyeron automaticamente al ejecutar el comando **npm install express mongoose ejs dotenv** , es decir  
 dotenv , ejs, express, mongoose

### Crea la estructura de carpetas:

Colocarse en la carpeta principal ( 10_Reto08_GestorBibliotecaPersonal ) y crear el archivo:  

---
```javascript
app.js
```
---

Luego abrir la terminal en el directorio principal  

Aplicar
--- 
```bash
mkdir src
```
---  
Crear 2 archivos vacios  por el momento ( que van en la raiz de la carpeta principal ): 

app.js 
.env  ( Van en la raiz de la carpeta del proyecto)  


Mover la terminal a src:  
Aplicar  

---
```bash
  mkdir config, controllers, models, routes, views, public**  
```
---

Mover la terminal a public  
Aplicar:   

---
```bash
mkdir css,js  
```

---
```ini
10_Reto08_GestorBibliotecaPersonal/
├── src/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   ├── routes/
│   ├── views/
│   └── public/
│       ├── css/
│       └── js/
├── .env
└── app.js
```
---

Los "/" en la estructura significan carpetas o directorios.  
Sin los "/" son archivos, como .env y app.js  


### Condigo inicial de app.js  

---
```javascript
// 1. Importaciones de módulos
import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import dotenv from 'dotenv';

// 2. Configuración de variables de entorno y rutas de archivos
dotenv.config(); // Carga lo que haya en el archivo .env
const app = express();
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// 3. Configuración del motor de plantillas (EJS)
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'src', 'views'));

// 4. Middlewares (Funciones que se ejecutan antes de llegar a las rutas)
app.use(express.json()); // Para entender datos en formato JSON
app.use(express.urlencoded({ extended: true })); // Para entender datos de formularios HTML
app.use(express.static(path.join(__dirname, 'src', 'public'))); // Para servir CSS, imágenes, etc.

// 5. Ruta de prueba (Punto de entrada)
app.get('/', (req, res) => {
    // Renderizará un archivo llamado 'index.ejs' que crearemos luego
    res.render('index', { title: 'Mi Biblioteca Personal' });
});

// 6. Encendido del servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`🚀 Servidor corriendo en http://localhost:${PORT}`);
});
```
---

### Condigo inicial de index.ejs y .env   


Crea un archivo **index.ejs** dentro de **src/views/** con un HTML básico:

---
```html
<!DOCTYPE html>
<html lang="es">
    <head>
        <title><%= title %></title>
    </head>
    <body>
        <h1>Bienvenido a la Biblioteca (Vengo de index.ejs dentro de src/views/)</h1>
    </body>
</html>
```
---

# CORRER LA APLICACION POR PRIMERA VEZ
Ya con la carpeta principal del proyecto, la estructura de archivos, la inicializacion de la carpeta principal, la instalacion de dependencias y los archivos app.js, .env e index.ejs , aplicamos en la terminal el comando:  

Arrancar MongoDB EN TERMINAL WINDOWS, COMO ADMINISTRADOR

```sh
net start MongoDB
```

y luego corremos el proyecto con: ( EN TERMINAL DE VS CODE)

***
```sh
npm run dev
```
***



## 🔑 ¿Para qué sirve el .env?
Imagina que el código de tu aplicación es público (como en GitHub), pero tu contraseña de la base de datos es privada. Si escribes la contraseña directamente en app.js, cualquiera la vería.

### El archivo .env permite:

#### Seguridad: 
Guardar datos sensibles (claves, URIs de bases de datos).

#### Flexibilidad: 
Si hoy usas el puerto 3000 pero mañana en el servidor necesitas el 8080, solo cambias una línea en el .env sin tocar el código.

Inicialmente el archivo .env lo cree solo con el nombre.**¿Por qué parece que no afecta que estuviera vacio?** En el código de app.js, pusimos esta línea:  

>const PORT = process.env.PORT || 3000;

Esto significa: "Usa lo que diga el .env, y si no hay nada, usa el 3000 por defecto". Por eso funcionó!!.

## Fase 3: Conexión a MongoDB
Usaremos MongoDB Local por ser más rápido de configurar para aprender. 

### 1. Actualiza tu archivo .env
Añade la dirección de tu base de datos (la llamaremos biblioteca_db):

Fragmento de código
---
```javascript
PORT=3000
MONGO_URI=mongodb://127.0.0.1:27017/biblioteca_db
```
---
### 2. Crear el módulo de conexión
Para mantener el orden, no pondremos la conexión en app.js, sino en su propio archivo.

Crea una carpeta llamada config dentro de src/.

Dentro de src/config/, crea el archivo db.js.

---
```javascript
import mongoose from 'mongoose';

// Función para conectar a la base de datos
const conectarDB = async () => {
    try {
        const conn = await mongoose.connect(process.env.MONGO_URI);
        console.log(`✅ MongoDB Conectado: ${conn.connection.host}`);
    } catch (error) {
        console.error(`❌ Error de conexión: ${error.message}`);
        process.exit(1); // Detiene la app si no hay conexión
    }
};

export default conectarDB;
```
---




### 3. Importar la conexión en app.js
Ahora debemos decirle a nuestra aplicación que use esa función conectarDB al arrancar: 


Abre app.js y modifica la parte superior:

```javascript
// ... otras importaciones  
import dotenv from 'dotenv';  
import conectarDB from './src/config/db.js'; // <--- Añadir esto
```
y añade la funcion conectarDB() en app.js

---
```javascript
....  

dotenv.config();

// Conectar a la base de datos  
conectarDB(); // <--- Y TAMBIEN ESTO ( ES DECIR LA FUNCION QUE IMPORTAMOS EN EL BLOQUE DE IMPORTACIONES )

const app = express();
// ... resto del código
```
---

# CORRER LA APLICACION POR SEGUNDA  VEZ
Ya con la carpeta principal del proyecto, la estructura de archivos, la inicializacion de la carpeta principal, la instalacion de dependencias, LA CONEXION A MONGODB y los archivos app.js, .env e index.ejs , aplicamos en la terminal el comando:  

Arrancar MongoDB EN TERMINAL WINDOWS, COMO ADMINISTRADOR

>**net start MongoDB**

y luego corremos el proyecto con: ( EN TERMINAL DE VS CODE)

>**npm run dev**  

## Fase 4: El Modelo de Datos (La "M" de MVC)
definir qué información guardaremos de cada libro. En MongoDB, aunque es "no relacional", usamos Mongoose para darle una estructura mínima y que no sea un caos.

Crea el archivo libroModel.js dentro de la carpeta src/models/.

**libroModel.js**:

```javascript
import mongoose from 'mongoose';

// Definimos la estructura de un "Libro"
const libroSchema = new mongoose.Schema({
    titulo: {
        type: String,
        required: [true, 'El título es obligatorio'],
        trim: true
    },
    autor: {
        type: String,
        required: [true, 'El autor es obligatorio'],
        trim: true
    },
    genero: {
        type: String,
        default: 'Sin género'
    },
    leido: {
        type: Boolean,
        default: false
    },
    fechaPublicacion: {
        type: Number // Año
    }
}, {
    timestamps: true // Crea automáticamente campos "createdAt" y "updatedAt"
});

// Creamos el modelo basado en el esquema
const Libro = mongoose.model('Libro', libroSchema);

export default Libro;
```

---
**¿Por qué se hace el modelo de datos como el anterior?**
>required: Evita que guardemos libros sin nombre.

>trim: Limpia espacios en blanco accidentales al principio o final.

>timestamps: Es muy útil para saber cuándo añadiste un libro a tu colección sin tener que programarlo a mano.

# CORRER LA APLICACION POR TERCERA  VEZ

Despues de tener lLibroModel.js

Arrancar MongoDB EN TERMINAL WINDOWS, COMO ADMINISTRADOR

>**net start MongoDB**

y luego corremos el proyecto con: ( EN TERMINAL DE VS CODE)

>**npm run dev**

La salida en consola fue EXITO:

Restarting 'app.js'  
◇ injected env (2) from .env // tip: ◈ secrets for agents [www.dotenvx.com]  
🚀 Servidor corriendo en http://localhost:3000  
✅ MongoDB Conectado: 127.0.0.1


## Fase 4: Los Controladores y las Rutas
Ahora vamos a crear el "cerebro" que manejará los verbos HTTP (GET, POST, etc.) y las rutas que los activan. Lo haremos en dos partes para mantener el código limpio (Modularización).

### 4.1. El Controlador (Lógica)
Crea el archivo libroController.js en la carpeta src/controllers/.

Aquí definiremos las funciones para Listar y Crear libros por ahora (para no saturar). Usaremos una codificación sencilla y comentada:

---
libroController.js , ubicado src/controllers/
---
```javascript
import Libro from '../models/libroModel.js';

// GET - Obtener todos los libros
export const obtenerLibros = async (req, res) => {
    try {
        // Buscamos todos los libros en la BD
        const libros = await Libro.find();
        // Renderizamos la vista 'index' pasándole los libros encontrados
        res.render('index', { 
            title: 'Mi Biblioteca Personal',
            libros: libros 
        });
    } catch (error) {
        res.status(500).send('Error al obtener los libros');
    }
};

// POST - Crear un nuevo libro
export const crearLibro = async (req, res) => {
    try {
        // Extraemos los datos del formulario (req.body)
        const { titulo, autor, genero, fechaPublicacion } = req.body;
        
        // Creamos una nueva instancia del modelo
        const nuevoLibro = new Libro({
            titulo,
            autor,
            genero,
            fechaPublicacion
        });

        // Guardamos en MongoDB
        await nuevoLibro.save();
        
        // Al terminar, volvemos a la página principal
        res.redirect('/');
    } catch (error) {
        res.status(400).send('Error al guardar el libro: ' + error.message);
    }
};
```
---

### 4.2. Las Rutas (Direcciones)
Crea el archivo libroRoutes.js en la carpeta src/routes/.

Este archivo le dice a Express: "Si alguien entra a la URL '/', llama a tal función del controlador".

---
libroRoutes.js , ubicado en src/routes/
---
```javascript
import express from 'express';
import { obtenerLibros, crearLibro } from '../controllers/libroController.js';

const router = express.Router();

// Ruta para ver todos los libros (GET)
router.get('/', obtenerLibros);

// Ruta para recibir los datos del formulario (POST)
router.post('/agregar', crearLibro);

export default router;
```
---


### 4.3. Conectar las rutas en app.js
Para que esto funcione, debemos decirle a app.js que use este nuevo archivo de rutas.

Abre app.js y reemplaza la ruta de prueba que hicimos antes (app.get('/', ...)) por esto:

En app.js:
---
```javascript
// ... importaciones anteriores
import libroRoutes from './src/routes/libroRoutes.js'; // 1. Importar rutas

// ... configuraciones anteriores (app.use, etc.)

// 5. Uso de las Rutas
app.use('/', libroRoutes); // 2. Usar las rutas

// 6. Encendido del servidor...
```
---

## EXPERIENCIA AL CORRER EL CODIGO:

### Basicamente hay que correr el codigo usando la consola y con la instruccion:

---
```bash
npm run dev
```
---

y ***NO CORRERLO USANDO EL BOTON DE RUN CODE*** y aquí el motivo:

diferencia entre ejecutar un script manualmente y usar un entorno configurado.

    1. ¿Por qué el error "URI undefined" al dar "Run Code"?
    El problema es el Directorio de Trabajo (Working Directory).

    Cuando usas npm run dev, el comando se ejecuta desde la raíz de tu carpeta 10_Reto08_GestorBibliotecaPersonal. Ahí es donde está tu archivo .env, y la librería dotenv lo encuentra fácilmente.

    Cuando usas el botón derecho "Run Code", a veces el editor intenta ejecutar el archivo de forma aislada o desde una ruta distinta. Al no encontrar el archivo .env, la variable process.env.MONGO_URI queda vacía (undefined), y Mongoose explota porque no sabe a dónde conectarse.

    Solución:   
    **No uses "Run Code" para este proyecto.**  
     Quédate siempre con:
     
>>---
>>```bash
>>npm run dev  
>>```
>>---
    en la terminal, ya que es la forma que respeta toda tu configuración y mantiene el servidor "vivo".


    2. Sobre el index.ejs y por qué no da error
    Efectivamente, no da error porque todavía no estás intentando usar la variable libros en el index.ejs. 
    En EJS, si el controlador envía datos pero el HTML los ignora, no pasa nada. El error ocurre al revés: si el HTML intenta leer libros y tú no se los envías.


       

### 4.3.a Como quedó el archivo app.js?

---
app.js modificado. Agregé el import de libroRoutes y se cambio el punto 5. Uso de Rutas por app.get('/',libroRoutes);

---
```javascript

// 1. Importaciones de módulos
import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import conectarDB from './src/config/db.js'; // <--- Añadimos esto al crear el db.js dentro de src/config
import dotenv from 'dotenv';
import libroRoutes from './src/routes/libroRoutes.js'; // ! 1. Importar rutas

// 2. Configuración de variables de entorno y rutas de archivos
dotenv.config(); // Carga lo que haya en el archivo .env

// Conectar a la base de datos
conectarDB(); // <--- Ejecutar la conexion. La funcion viene de la importacion import conectarDB from './src/config/db.js'; 

const app = express();
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// 3. Configuración del motor de plantillas (EJS)
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'src', 'views'));

// 4. Middlewares (Funciones que se ejecutan antes de llegar a las rutas)
app.use(express.json()); // Para entender datos en formato JSON
app.use(express.urlencoded({ extended: true })); // Para entender datos de formularios HTML
app.use(express.static(path.join(__dirname, 'src', 'public'))); // Para servir CSS, imágenes, etc.

// 5. Ruta de prueba (Punto de entrada)..HAY QUE ELIMINARLA PUES SERA SUSTITUIDA POR LA SIGUINETE No5, PARA QUE VAYA A libroRoutes
// app.get('/', (req, res) => {
//     // Renderizará un archivo llamado 'index.ejs' que crearemos luego
//     res.render('index', { title: 'Mi Biblioteca Personal' });
// });

// 5. Uso de las Rutas
app.use('/', libroRoutes); // ! 2. Usar las rutas

// 6. Encendido del servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`🚀 Servidor corriendo en http://localhost:${PORT}`);
});
```
---

### Fase 5: La Vista Dinámica (index.ejs)
Vamos a actualizar src/views/index.ejs para que pinte los libros. 
Usaremos una estructura sencilla para que luego podamos aplicarle BEM fácilmente.

**Reemplaza** el contenido de src/views/index.ejs por este:

---
index.ejs  : Cambiemos el index.ejs basico por este otro. Aplicando método BEM ( Block-Element-Modifier) para aplicar CSS.  
Recuerda que index.ejs está en src/views/
---

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><%= title %></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="container">

    <header class="header">
        <h1 class="header__title"><%= title %></h1>
    </header>

    <main>
        <section class="form-section">
            <h2 class="form-section__title">Añadir nuevo libro</h2>
            <form action="/agregar" method="POST" class="form">
                <input type="text" name="titulo" placeholder="Título del libro" class="form__input" required>
                <input type="text" name="autor" placeholder="Autor" class="form__input" required>
                <input type="text" name="genero" placeholder="Género" class="form__input">
                <input type="number" name="fechaPublicacion" placeholder="Año" class="form__input">
                <button type="submit" class="form__button">Guardar Libro</button>
            </form>
        </section>

        <hr>

        <section class="list-section">
            <h2 class="list-section__title">Mi Colección</h2>
            <div class="book-grid">
                <% if (libros.length > 0) { %>
                    <% libros.forEach(libro => { %>
                        <article class="book-card">
                            <h3 class="book-card__title"><%= libro.titulo %></h3>
                            <p class="book-card__author">Autor: <%= libro.autor %></p>
                            <p class="book-card__genre">Género: <%= libro.genero %></p>
                            <p class="book-card__year">Año: <%= libro.fechaPublicacion %></p>
                        </article>
                    <% }) %>
                <% } else { %>
                    <p>No hay libros en la biblioteca todavía.</p>
                <% } %>
            </div>
        </section>
    </main>

</body>
</html>

```
¿Qué destacar en el index.ejs?
#### Formulario: 
El action="/agregar" coincide con la ruta router.post('/agregar', ...) que creamos en el paso anterior. Es decir el enlace con libroRoutes.js que manda la ruta router.post('/agregar', **crearLibro**);  y **crearLibro** esta definido en libroController donde se añade un nuevo libro.

#### Lógica EJS (<% %>): 
Usamos un bucle forEach para recorrer el array de libros que viene de la base de datos.

#### BEM (Block Element Modifier): 
Se han usado clases como form__input o book-card__title. Esto nos facilitará mucho la vida cuando escribamos el CSS.

Significa que el flujo completo de datos (Formulario → Express → MongoDB → EJS → Navegador) funciona a la perfección.

Ya tienes una aplicación funcional. Ahora vamos a darle el aspecto profesional que se merece usando CSS3 puro y la metodología BEM.

## Fase 6: Estilos con Metodología BEM
Como recordatorio, BEM significa Block (Bloque), Element (Elemento), Modifier (Modificador). Ayuda a que el CSS sea legible y no "rompa" otras partes de la web.

Bloque:   
form-section

Elemento:  
form-section__title

Modificador:  
(Lo usaremos más adelante para botones de diferentes colores).

>### 6.1. Crear el archivo CSS
    Busca en tu estructura la carpeta src/public/css/ y crea el archivo style.css.


style.css :


```css
/* --- Base --- */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --bg-color: #f4f7f6;
    --text-color: #333;
    --white: #ffffff;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
    line-height: 1.6;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 900px;
    margin: 0 auto;
}

/* --- Header --- */
.header {
    text-align: center;
    padding: 2rem 0;
    color: var(--primary-color);
}

.header__title {
    font-size: 2.5rem;
    margin: 0;
}

/* --- Form Section (BEM) --- */
.form-section {
    background: var(--white);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.form-section__title {
    margin-top: 0;
    color: var(--secondary-color);
}

.form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
}

.form__input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.form__button {
    background-color: var(--secondary-color);
    color: var(--white);
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
}

.form__button:hover {
    background-color: #2980b9;
}

/* --- Book List Section (BEM) --- */
.book-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.book-card {
    background: var(--white);
    padding: 15px;
    border-left: 5px solid var(--secondary-color);
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.book-card__title {
    margin: 0 0 10px 0;
    color: var(--primary-color);
}

.book-card__author, 
.book-card__genre, 
.book-card__year {
    margin: 5px 0;
    font-size: 0.9rem;
}
```
---

#### COMO ENCUENTRA EL ARCHIVO style.css ? 
En el **index.ejs** colocamos la linea 

---
```html

<link rel="stylesheet" href="/css/style.css"> 
```
---

asi que al guardar el archivo style.css en la carpeta /css/en nuestro index.ejs, solo tienes que guardar el archivo CSS y refrescar el navegador.  
Pero lo anterior tiene su explicacion en:  

Esa es precisamente la función de la línea que escribimos en el app.js:

---
app.use(express.static(path.join(__dirname, 'src', 'public')));
---

¿Cómo funciona la "Carpeta Virtual"?
Cuando configuras un middleware de archivos estáticos en Express, lo que haces es decirle al servidor: "Si recibes una solicitud de un archivo que no coincide con ninguna ruta (como /css/style.css), busca dentro de esta carpeta (public), pero trátala como si fuera la raíz (/)".

Por eso:

En el código:  
El archivo está físicamente en **src/public**/css/style.css.

En el navegador:  
Se accede simplemente como /css/style.css.

Nota cultural de programador:  
A esto se le llama a veces "montar" un directorio. Es mucho más seguro porque el usuario final no tiene por qué saber la estructura interna de tus carpetas (src, public, etc.), solo accede a lo que tú "expones" voluntariamente.

## NUEVO ASPECTO DE NUESTRO INDEX.
Al usar y carhar la hoja style.css los libros ya no están en una lista infinita hacia abajo, sino en una cuadrícula (grid).

El formulario estará organizado y con colores más modernos.

Todo tiene un aire mucho más limpio.

## Fase 7: Eliminar Libros (DELETE)
En las aplicaciones web tradicionales, para hacer un "Delete" desde un enlace HTML simple, solemos usar una ruta GET o un formulario POST. Para hacerlo de forma profesional y seguir los verbos HTTP, usaremos una ruta que identifique el libro por su ID único de MongoDB.

>### 7.1. Actualizar el Controlador
    Abre src/controllers/libroController.js y añade esta función al final:

---
```javascript
// DELETE - Eliminar un libro por ID
export const eliminarLibro = async (req, res) => {
    try {
        const { id } = req.params; // Obtenemos el ID de la URL
        await Libro.findByIdAndDelete(id); // Borramos en MongoDB
        res.redirect('/'); // Refrescamos la página
    } catch (error) {
        res.status(500).send('Error al eliminar el libro');
    }
};
```
---

Ahora libroController.js quedó asi:  

```javascript
import Libro from '../models/libroModel.js';

// GET - Obtener todos los libros
export const obtenerLibros = async (req, res) => {
    try {
        // Buscamos todos los libros en la BD
        const libros = await Libro.find();
        // Renderizamos la vista 'index' pasándole los libros encontrados
        res.render('index', { 
            title: 'Mi Biblioteca Personal',
            libros: libros 
        });
    } catch (error) {
        res.status(500).send('Error al obtener los libros');
    }
};

// POST - Crear un nuevo libro
export const crearLibro = async (req, res) => {
    try {
        // Extraemos los datos del formulario (req.body)
        const { titulo, autor, genero, fechaPublicacion } = req.body;
        
        // Creamos una nueva instancia del modelo
        const nuevoLibro = new Libro({
            titulo,
            autor,
            genero,
            fechaPublicacion
        });

        // Guardamos en MongoDB
        await nuevoLibro.save();
        
        // Al terminar, volvemos a la página principal
        res.redirect('/');
    } catch (error) {
        res.status(400).send('Error al guardar el libro: ' + error.message);
    }
};

// DELETE - Eliminar un libro por ID
export const eliminarLibro = async (req, res) => {
    try {
        const { id } = req.params; // Obtenemos el ID de la URL
        await Libro.findByIdAndDelete(id); // Borramos en MongoDB
        res.redirect('/'); // Refrescamos la página
    } catch (error) {
        res.status(500).send('Error al eliminar el libro');
    }
};

```
---

>#### 7.2. Actualizar las Rutas
    Abre src/routes/libroRoutes.js e importa la nueva función y añade la ruta:

---
libroRoutes.js
---
```javascript

import { obtenerLibros, crearLibro, eliminarLibro } from '../controllers/libroController.js';

// ... las rutas anteriores ...

// Ruta para eliminar (Usamos GET para simplificar el enlace en el HTML por ahora)
router.get('/eliminar/:id', eliminarLibro);
```
---

Despues de los cambios anteriores el archivo libroRoutes.js quedó asi:

---
```javascript
import express from 'express';
import { obtenerLibros, crearLibro, eliminarLibro } from '../controllers/libroController.js';

const router = express.Router();

// Ruta para ver todos los libros (GET)
router.get('/', obtenerLibros);

// Ruta para recibir los datos del formulario (POST)
router.post('/agregar', crearLibro);

// Ruta para eliminar (Usamos GET para simplificar el enlace en el HTML por ahora)
router.get('/eliminar/:id', eliminarLibro);

export default router;
```
----

>### 7.3. Actualizar la Vista (EJS)
    Necesitamos un botón o enlace en cada tarjeta para poder borrarla. Abre src/views/index.ejs y localiza donde se cierra el último <p> del año. Añade el enlace con una clase BEM:

 ---
```html
    <article class="book-card">
        <h3 class="book-card__title"><%= libro.titulo %></h3>
        <p class="book-card__author">Autor: <%= libro.autor %></p>
        <p class="book-card__genre">Género: <%= libro.genero %></p>
        <p class="book-card__year">Año: <%= libro.fechaPublicacion %></p>
    <!-- Agregamos aqui el boton para borrar/Eliminar el libro -->
        <div class="book-card__actions">
             <a href="/eliminar/<%= libro._id %>" class="button button--delete" onclick="return confirm('¿Seguro que quieres eliminar este libro?')">Eliminar</a>
        </div>
    </article>
```
---        
Archivo src/views/index.ejs completo:
---
```html
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><%= title %></title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body class="container">

        <header class="header">
            <h1 class="header__title"><%= title %></h1>
        </header>

        <main>
            <section class="form-section">
                <h2 class="form-section__title">Añadir nuevo libro</h2>
                <form action="/agregar" method="POST" class="form">
                    <input type="text" name="titulo" placeholder="Título del libro" class="form__input" required>
                    <input type="text" name="autor" placeholder="Autor" class="form__input" required>
                    <input type="text" name="genero" placeholder="Género" class="form__input">
                    <input type="number" name="fechaPublicacion" placeholder="Año" class="form__input">
                    <button type="submit" class="form__button">Guardar Libro</button>
                </form>
            </section>

            <hr>

            <section class="list-section">
                <h2 class="list-section__title">Mi Colección</h2>
                <div class="book-grid">
                    <% if (libros.length > 0) { %>
                    <% libros.forEach(libro => { %>
                    <article class="book-card">
                        <h3 class="book-card__title"><%= libro.titulo %></h3>
                        <p class="book-card__author">Autor: <%= libro.autor %></p>
                        <p class="book-card__genre">Género: <%= libro.genero %></p>
                        <p class="book-card__year">Año: <%= libro.fechaPublicacion %></p>
                        <!-- Agregamos aqui el boton para borrar/Eliminar el libro -->
                        <div class="book-card__actions">
                            <a href="/eliminar/<%= libro._id %>" class="button button--delete" onclick="return confirm('¿Seguro que quieres eliminar este libro?')">Eliminar</a>
                        </div>
                    </article>
                    <% }) %>
                    <% } else { %>
                    <p>No hay libros en la biblioteca todavía.</p>
                    <% } %>
                </div>
            </section>
        </main>

    </body>
</html>
```

### 7.4. Añadir los estilos para el botón
Abre src/public/css/style.css y añade estos estilos al final. Aquí usaremos un Modificador BEM (--delete):

---
```css
/* --- Botones y Acciones --- */
.book-card__actions {
    margin-top: 15px;
    border-top: 1px solid #eee;
    padding-top: 10px;
}

.button {
    text-decoration: none;
    font-size: 0.8rem;
    padding: 5px 10px;
    border-radius: 4px;
    display: inline-block;
    transition: background 0.3s;
}

.button--delete {
    background-color: #e74c3c;
    color: white;
}

.button--delete:hover {
    background-color: #c0392b;
}

```
---
Archivo src/public/css/style.css completo, al colocar el boton de borrado:
---
```css
/* --- Base --- */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --bg-color: #f4f7f6;
    --text-color: #333;
    --white: #ffffff;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
    line-height: 1.6;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 900px;
    margin: 0 auto;
}

/* --- Header --- */
.header {
    text-align: center;
    padding: 2rem 0;
    color: var(--primary-color);
}

.header__title {
    font-size: 2.5rem;
    margin: 0;
}

/* --- Form Section (BEM) --- */
.form-section {
    background: var(--white);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.form-section__title {
    margin-top: 0;
    color: var(--secondary-color);
}

.form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
}

.form__input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.form__button {
    background-color: var(--secondary-color);
    color: var(--white);
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
}

.form__button:hover {
    background-color: #2980b9;
}

/* --- Book List Section (BEM) --- */
.book-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.book-card {
    background: var(--white);
    padding: 15px;
    border-left: 5px solid var(--secondary-color);
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.book-card__title {
    margin: 0 0 10px 0;
    color: var(--primary-color);
}

.book-card__author, 
.book-card__genre, 
.book-card__year {
    margin: 5px 0;
    font-size: 0.9rem;
}

/* --- Botones y Acciones --- */
.book-card__actions {
    margin-top: 15px;
    border-top: 1px solid #eee;
    padding-top: 10px;
}

.button {
    text-decoration: none;
    font-size: 0.8rem;
    padding: 5px 10px;
    border-radius: 4px;
    display: inline-block;
    transition: background 0.3s;
}

.button--delete {
    background-color: #e74c3c;
    color: white;
}

.button--delete:hover {
    background-color: #c0392b;
}

```
---

## Fase 8: Editar Libros (UPDATE)
Esto requiere tres sub-pasos:

* 8.1 Una función para buscar el libro y mostrar el formulario de edición.

* 8.2 Una función para guardar los cambios en la base de datos (POST o PUT).

* 8.3 La vista editar.ejs.

### 8.1 Actualizar el Controlador (src/controllers/libroController.js) para buscar el libro a editar y tener un formulario de edicion. 
Añade estas dos funciones al final de tu controlador libroController.js :

---
```js
// GET - Mostrar formulario de edición
export const formularioEditar = async (req, res) => {
    try {
        const libro = await Libro.findById(req.params.id);
        res.render('editar', { title: 'Editar Libro', libro });
    } catch (error) {
        res.status(500).send('Error al buscar el libro');
    }
};

// POST - Guardar cambios del libro
export const actualizarLibro = async (req, res) => {
    try {
        const { id } = req.params;
        await Libro.findByIdAndUpdate(id, req.body);
        res.redirect('/');
    } catch (error) {
        res.status(500).send('Error al actualizar');
    }
};
```
---

### 8.2 Actualizar las Rutas (src/routes/libroRoutes.js) relacionado con la funcion para guardar los cambios ( POST ó PUT)
Importa las nuevas funciones y añade las rutas:

Adiciones a libroRoutes.js
---
```js
import { obtenerLibros, crearLibro, eliminarLibro, formularioEditar, actualizarLibro } from '../controllers/libroController.js';

// ... rutas anteriores

router.get('/editar/:id', formularioEditar);
router.post('/editar/:id', actualizarLibro);
```
---

libroRoutes.js completo:
---
---
```js
import express from 'express';
import { obtenerLibros, crearLibro, eliminarLibro, formularioEditar, actualizarLibro } from '../controllers/libroController.js';

const router = express.Router();

// Ruta para ver todos los libros (GET)
router.get('/', obtenerLibros);

// Ruta para recibir los datos del formulario (POST)
router.post('/agregar', crearLibro);

// Ruta para eliminar (Usamos GET para simplificar el enlace en el HTML por ahora)
router.get('/eliminar/:id', eliminarLibro);

// Ruta para editar un libro
router.get('/editar/:id', formularioEditar);

// Ruta para actualizar informacion de un libro
router.post('/editar/:id', actualizarLibro);

export default router;
```
---

### 8.3 Crear la nueva vista src/views/editar.ejs
Crea este archivo. Nota cómo usamos value="<%= libro.titulo %>" para que el formulario aparezca ya relleno:

---
Nuevo archivo editar.ejs que hay que ubicar en src/views/
---
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><%= title %></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="container">
    <header class="header">
        <h1 class="header__title">Editar: <%= libro.titulo %></h1>
    </header>

    <section class="form-section">
        <form action="/editar/<%= libro._id %>" method="POST" class="form">
            <input type="text" name="titulo" value="<%= libro.titulo %>" class="form__input" required>
            <input type="text" name="autor" value="<%= libro.autor %>" class="form__input" required>
            <input type="text" name="genero" value="<%= libro.genero %>" class="form__input">
            <input type="number" name="fechaPublicacion" value="<%= libro.fechaPublicacion %>" class="form__input">
            
            <button type="submit" class="form__button">Actualizar Cambios</button>
            <a href="/" style="text-align: center; margin-top: 10px; color: #7f8c8d;">Cancelar</a>
        </form>
    </section>
</body>
</html>
```
---

### 8.3.a. Añadir el botón de "Editar" en index.ejs
Abre tu src/views/index.ejs y añade el enlace de editar justo al lado del de eliminar (dentro de book-card__actions):
---
```html
<div class="book-card__actions">
    <!-- Agregamos aqui el boton para borrar/Eliminar el libro -->
    <a href="/eliminar/<%= libro._id %>" class="button button--delete" onclick="return confirm('¿Seguro?')">Eliminar</a>
     <!-- Agregamos aqui el boton para editar/modificar el libro -->
    <a href="/editar/<%= libro._id %>" class="button button--edit">Editar</a>
</div>
```
---

## 9. Ajuste finales. ( editar.ejs)
El boton Cancelar de la vista editar.ejs estaba muy sencillo. Solo un Cancelar subrayado.
Añadiremos un nuevo modificador llamado --cancel.   
El boton sera en tono gris/naranja.

---
### 9.1 Añadiremos estos estilos al archivo style.css
---
```css
.button--cancel {
    background-color: #95a5a6; /* Gris azulado */
    color: white;
    text-align: center;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    margin-top: 0; /* Para alinearlo bien en el grid */
}

.button--cancel:hover {
    background-color: #7f8c8d;
    color: white;
}
```
---

### 9.2. Actualización de la Vista (editar.ejs)
Ahora simplemente aplicamos las clases al enlace en tu archivo src/views/editar.ejs. Sustituye la línea del enlace de cancelar por esta:

---
```html
<div class="form__group"> <button type="submit" class="form__button">Actualizar Cambios</button>
    <a href="/" class="button button--cancel">Cancelar</a>
</div>
```
---

# DETALLE FINAL: NO SE USO METODO PUT


1. La Teoría vs. La Realidad de los Navegadores
En la teoría de REST, los verbos HTTP tienen significados específicos:

POST: Crear algo nuevo.

GET: Leer información.

PUT / PATCH: Actualizar algo que ya existe.

DELETE: Borrar algo.

El problema: Los formularios HTML (etiqueta form) estándar, hasta el día de hoy, solo soportan de forma nativa los métodos GET y POST.

Si en tu editar.ejs pusieras:

---
```html
 <form method="PUT">
```
---    
el navegador no lo entendería y, por defecto, acabaría enviando un GET, lo que rompería tu ruta. Por eso, en proyectos "sencillos" de Node y Express, usamos POST para actualizar: es el estándar compatible con todos los navegadores sin añadir librerías extra.


# RESUMEN DEL PROYECTO

Hemos terminado un ciclo de desarrollo profesional completo:

Backend: Node.js + Express con arquitectura de carpetas (MVC-ish).

Base de Datos: MongoDB con Mongoose (Modelos, Conexión).

Frontend Dinámico: EJS para renderizar datos del servidor.

Estilos: CSS3 puro organizado con metodología BEM.

Operaciones: CRUD completo (Create, Read, Update, Delete).

# ¿Qué aprendismos?

Modularización: Usar import/export para no tener un solo archivo gigante de 500 líneas.

Persistencia: Que los datos no se borren al reiniciar el servidor.

Rutas dinámicas: Usar :id para saber exactamente qué libro editar o borrar.
