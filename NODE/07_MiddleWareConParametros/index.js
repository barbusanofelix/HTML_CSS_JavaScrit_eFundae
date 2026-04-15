// PRACTICA DE middleware CON PARAMETROS

// El truco: Una función que devuelve otra función
// Para pasar parámetros a un middleware, creas una función que recibe tus opciones y devuelve la función middleware que Express espera (la que tiene req, res, next).

// Ejemplo: Un guardia que cambia de "mensaje" según la ruta
// Imagina que quieres un middleware que bloquee el paso, pero que en cada ruta diga un mensaje diferente.

// EXPPLICACION DEL CODIGO
// ¿Por qué aquí sí van paréntesis , ES DECIR, en app.get('/ruta', vigilanteConfigurable('Mensaje'), (req, res)
// Es como una muñeca rusa:

// Al escribir vigilanteConfigurable('Zona militar...'), la función se ejecuta inmediatamente cuando Node lee el archivo.

// Esa ejecución "escupe" hacia afuera la función interna: (req, res, next) => { ... }.

// Express recibe esa función interna (la pequeña) y la guarda para usarla cuando alguien entre a la ruta.

// ¿Cuándo se usa esto en la vida real?
// El ejemplo más famoso es el middleware para servir archivos estáticos que ya usamos:
// app.use(express.static('public'))

// express.static es la "fábrica".

// 'public' es el parámetro de configuración.

// El resultado de ejecutar eso es el middleware real que busca los archivos.

// Resumen visual:
// Middleware simple: Pones el nombre de la función: app.get('/', miMiddleware)

// Middleware con parámetros: Ejecutas la función para que te devuelva el middleware configurado: app.get('/', miFabrica('opcion'))


const express = require('express');
const app = express();

// --- ESTO ES UNA FÁBRICA DE MIDDLEWARE ---
const vigilanteConfigurable = (mensajeDeError) => {
    // Esta es la función que REALMENTE usará Express
    return (req, res, next) => {
        const tienePermiso = req.query.permiso === 'si';      //aqui se controla el parametro al final de la URL permiso=si 

        if (tienePermiso) {
            next();
        } else {
            // Aquí usamos el parámetro que pasamos "afuera"
            res.status(403).send(`⚠️ Alerta: ${mensajeDeError}`);
        }
    };
};

// --- AQUÍ SÍ USAMOS PARÉNTESIS ---
// ¿Por qué? Porque al ejecutar vigilanteConfigurable('...'),
// el resultado que queda ahí es la función interna (req, res, next).

//Entrar con localhost:3000/area-secreta?permiso=si
app.get('/area-secreta', vigilanteConfigurable('Zona militar restringida'), (req, res) => {
    res.send('Entraste a la base secreta 🚀');
});

//Entrar con localhost:3000/caja-fuerte?permiso=si
app.get('/caja-fuerte', vigilanteConfigurable('No tienes la llave del banco'), (req, res) => {
    res.send('Dinero infinito concedido 💰');
});

app.get('/', (req, res) => {
    res.send('Inicio: Todo el mundo puede ver esto, para ejercicio de middleware con parametro.');
});


app.listen(3000, () => console.log('Servidor listo'));