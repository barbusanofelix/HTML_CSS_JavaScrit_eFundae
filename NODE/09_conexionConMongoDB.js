// ! ESTE SCRIPT CREA LA CONEXION A MONGODB A UNA BASE DE DATOS miProyecto ( QUE PODRIA CAMBIARSE POR OTRO NOMBRE )


const { MongoClient } = require('mongodb');

// Parámetros de configuración
const url = 'mongodb://127.0.0.1:27017';
const dbName = 'miProyecto';                // ! COLOCAR EL NOMBRE DE LA BASE DE DATOS

const client = new MongoClient(url);

async function conectarDB() {
    try {
        // Conectamos solo si no hay una conexión activa
        await client.connect();
        console.log('✅ Conexión establecida con MongoDB');
        
        const db = client.db(dbName);
        return db; 
    } catch (error) {
        console.error('❌ Error al conectar a la base de datos:', error);
        throw error; // Re-lanzamos el error para que el script que lo use sepa que falló
    }
}

// Exportamos la función y el cliente para usarlos fuera
module.exports = { conectarDB, client };