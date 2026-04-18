const { MongoClient } = require('mongodb');

// 1. URL de conexión (Usamos la IP 127.0.0.1 para evitar demoras de resolución)
const url = 'mongodb://127.0.0.1:27017';
const client = new MongoClient(url);

// 2. Nombre de la base de datos que ya creamos
const dbName = 'miProyecto';

async function main() {
    try {
        // Conectamos al servidor
        await client.connect();
        console.log('✅ Conectado exitosamente al servidor de MongoDB');

        const db = client.db(dbName);
        const coleccion = db.collection('usuarios');

        // --- OPERACIONES DE PRUEBA (CRUD) ---

        // A. Insertar un usuario de prueba desde Node
        const nuevoUsuario = { 
            nombre: "Carlos Node", 
            edad: 30, 
            email: "carlos.node@ejemplo.com" 
        };
        const insertResult = await coleccion.insertOne(nuevoUsuario);
        console.log('👤 Usuario insertado con ID:', insertResult.insertedId);

        // B. Recuperar el dato de 'Felix' (lo que preguntaste al principio)
        const usuarioFelix = await coleccion.findOne({ nombre: 'Felix' });
        console.log('🔍 Resultado de búsqueda (Felix):', usuarioFelix);

    } catch (error) {
        console.error('❌ Hubo un error en la conexión o la operación:', error);
    } finally {
        // Cerramos la conexión
        await client.close();
        console.log('🔌 Conexión cerrada correctamente');
    }
}

main().catch(console.error);