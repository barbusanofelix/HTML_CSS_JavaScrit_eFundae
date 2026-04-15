const express = require('express');
const app = express();

// --- MIDDLEWARE A NIVEL DE APLICACIÓN ---
// Se define con app.use() antes de las rutas
app.use((req, res, next) => {
    const tiempo = new Date().toLocaleTimeString();
    const metodo = req.method; // GET, POST, etc.
    const url = req.url;       // /, /contacto, etc.

    console.log(`Hora: [${tiempo}] Petición recibida: ${metodo} con URL : ${url}`);

    // ¡CRUCIAL!: next() le dice a Express que continúe a la siguiente función.
    //! Si no pones next(), el navegador se quedará cargando para siempre.
    next(); 
});

// Rutas de prueba
app.get('/', (req, res) => {
    res.send(`Estás en el Inicio`);
});

app.get('/contacto', (req, res) => {
    res.send('Estás en Contacto');
});

app.listen(3000, () => {
    console.log('Servidor activo en el puerto 3000');
});