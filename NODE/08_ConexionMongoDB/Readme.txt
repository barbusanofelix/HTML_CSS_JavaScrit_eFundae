1. CREAR DIRECTORIO DEL PROYECTO.
Creamos el directorio del proyecto:  mkdir 08_ConexionMongoDB

2. HACEMOS npm init -y
3. INSTALAMOS Express
    npm install Express
4. INSTALAMOS DRIVER PARA MONGODB.
    npm install mongodb
   
En el terminal mostro:
added 12 packages, and audited 78 packages in 3s

22 packages are looking for funding
  run `npm fund` for details

found 0 vulnerabilities

5. conectar Node con mongodb
Una vez instalado el driver, el siguiente paso es establecer una
conexión entre tu aplicación Node.js y tu instancia de MongoDB.
Esto se realiza creando una instancia del cliente MongoDB en tu código
y conectándote a la base de datos utilizando una cadena de conexión
URI.

EXPLICACION A DETALLE DEL CODIGO:
1. La Importación del Driver

const { MongoClient } = require('mongodb');

llamaMOS la librería oficial de MongoDB que instale con npm.
 Usamos llaves { } para traer específicamente la clase MongoClient, que es la "llave maestra" que nos permite abrir conexiones.

2. Configuración de Coordenadas o parametros para la conexion.

const url = 'mongodb://127.0.0.1:27017';
const client = new MongoClient(url);
const dbName = 'miProyecto';

url: Es la dirección del servidor. 127.0.0.1 en nuestra propia PC y 27017 es la "puerta" (puerto) que MongoDB deja abierta por defecto para escuchar órdenes.

client: Aquí creamos una instancia del cliente. Es como tener el teléfono en la mano, listo para marcar, pero aún no hemos iniciado la llamada.

3. La Función Asíncrona (async/await)

async function main() { ... }
Las bases de datos no responden de inmediato (tardan milisegundos). Usamos async y await para decirle a Node: "Espera a que la base de datos responda antes de pasar a la siguiente línea". Sin esto, el código intentaría buscar datos antes de haber terminado de conectarse.

4. El Bloque de Seguridad (try...catch...finally)
Esta es la estructura profesional para manejar errores:

try: "Intenta hacer esto". Si todo va bien, corre de arriba a abajo.

catch: Si en cualquier momento falla internet o el servicio de MongoDB está apagado, el código "salta" aquí y te explica qué falló en lugar de cerrarse bruscamente.

finally: "Pase lo que pase, haz esto al final". Aquí cerramos la conexión con client.close(). Es vital para no dejar conexiones "fantasma" que consuman memoria en tu servidor.

5. Acceso a Datos y Colecciones

await client.connect();
const db = client.db(dbName);
const coleccion = db.collection('usuarios');

connect(): Marca el número y establece la comunicación.

db(dbName): Una vez dentro del servidor, eliges la "habitación" (Base de Datos) donde quieres entrar.

collection('usuarios'): Dentro de la habitación, eliges el "archivador" (Colección) que vas a manipular.

6. Métodos CRUD en Node.js

const insertResult = await coleccion.insertOne(nuevoUsuario);
const usuarioFelix = await coleccion.findOne({ nombre: 'Felix' });
Fíjate que los comandos son idénticos a los que usaste en la consola (mongosh), con dos pequeñas diferencias:

Debes poner await delante.

Los resultados se guardan en variables (como insertResult o usuarioFelix) para que puedas usarlos después (por ejemplo, enviarlos a una página web).

