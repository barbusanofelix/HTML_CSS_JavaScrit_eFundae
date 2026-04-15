// --- MIDDLEWARE A NIVEL DE APLICACIÓN ---
// Se define con app.use() antes de las rutas
app.use((req, res, next) => {
    const tiempo = new Date().toLocaleTimeString();
    const metodo = req.method; // GET, POST, etc.
    const url = req.url;       // /, /contacto, etc.

    console.log(`[${tiempo}] Petición recibida: ${metodo} en ${url}`);

    // ¡CRUCIAL!: next() le dice a Express que continúe a la siguiente función.
    //! Si no pones next(), el navegador se quedará cargando para siempre.
    next(); 
});
