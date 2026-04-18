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