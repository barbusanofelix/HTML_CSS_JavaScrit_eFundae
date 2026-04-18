// ! IMPORTA EL MODULO 09_CONEXIONcONmONGOdb.js
// OJO : En esta carpeta debe estar instalado en node el modulo de mongo
// ! npm install mongodb          // En la carpeta del proyecto.npm

// ! CRITICO: HABER INICIADO EL SERVIDOR DE MONGO CON : "net start MongoDB"  en terminal de Windows como Administrador.

const { conectarDB, client } = require('./09_conexionConMongoDB');

async function ejecutar() {
    try {
        const db = await conectarDB();
        const usuarios = db.collection('usuarios');   // Aqui el nombre de la Colection ( Tabla  )

        // Ejemplo: Buscar un usuario
        // const resultado = await usuarios.findOne({ nombre: "Felix" });   // Recupera un registro
        // Para traer a todos los "Felix", necesitamos cambiar a find(). Pero hay un pequeño truco: find() no devuelve los datos directamente, sino un Cursor (un puntero a los resultados). Para verlos todos de golpe, debemos convertir ese cursor en un Array.
        const resultados = await usuarios.find({ nombre : "Felix" }).toArray();

        // console.log('Datos recuperados:', resultado)
        console.log(`Se encontraron ${resultados.length} resultados `);
        console.log('Datos recuperados:', resultados);
        // Se puede hacer una impresion asi o eliminarla
        resultados.forEach((user, index) => {
            console.log(`${index + 1}. Nombre: ${user.nombre} - edad: ${user.edad}`);
});


    } catch (error) {
        console.error("❌ ERROR DETECTADO:");
        console.error("Mensaje:", error.message); // Te dirá: "resultados.length is not a function"
        console.error("Línea del error:", error.stack.split('\n')[1]); // Te dirá dónde falló
    } finally {
        await client.close();
        console.log('🔌 Conexión cerrada');
    }
}

ejecutar();