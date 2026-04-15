
// El Middleware a nivel de Ruta. Aquí, el middleware es "selectivo": solo se activa si el usuario toca una puerta específica.

// Ejemplo: Middleware a nivel de Ruta (El "Guardia de Seguridad")
// Imagina que tienes una sección de /perfil que es privada, pero tu página de /inicio es pública. No quieres bloquear a todo el mundo, solo a los que intentan entrar a una zona específica.

// ¿Qué cambió aquí?
// La ubicación: Ya no usamos app.use(). Ahora el nombre de la función (esUsuarioVip) se coloca como un argumento extra dentro del app.get, justo antes de la función final.

// La ejecución: * Si vas a localhost:3000/, el servidor ni siquiera mira el código de esUsuarioVip.

// Si vas a localhost:3000/perfil, Express se detiene y dice: "Espera, antes de entregarte el perfil, tengo que ejecutar esta función que me pusieron aquí".

// Cómo probar este ejemplo con curl.exe:
// Prueba denegada: curl.exe http://localhost:3000/perfil
// (Te responderá con el error 403).

// Prueba concedida: curl.exe "http://localhost:3000/perfil?vip=si"
// (Te dejará entrar al perfil).

// Entonces , para la Aplicación usamos 	app.use(miMiddleware)	que sera para todas las rutas que estén escritas debajo.
// Para una ruta especifica tendremos 	app.get('/ruta', miMiddleware, (req, res)...)	que se aplicará solo a esa ruta específica.

// La anatomía de la URL
// Una URL con Query Strings se divide así:

// http://localhost:3000/perfil: La ruta base (el destino).

// ?: El separador. Le dice al servidor: "Aquí terminan las carpetas y empiezan los datos adicionales".

// vip: La llave (key). Es el nombre de la variable.

// =: El asignador.

// si: El valor (value). Lo que contiene esa variable.

// 2. ¿Cómo lo recibe Express?
// Express es muy amable y ya tiene un "traductor" integrado. Toma todo lo que viene después del ? y lo mete dentro de un objeto llamado req.query.
// Si tu escribes en el navegador :
// http://localhost:3000/perfil?vip=si

// express crea automaticamente un objeto
// req.query = {
//     vip: 'si'
// };

// Si tú escribes: .../perfil?vip=si&color=azul&nivel=5

// Express crea automáticamente este objeto detrás de escena:

// JavaScript
// // Así se ve internamente en Node
// req.query = {
//     vip: 'si',
//     color: 'azul',
//     nivel: '5'
// };
// Por eso, en el código del middleware pudimos usarlo así de fácil:
// const vip = req.query.vip;

// 3. Reglas de oro de los Query Strings
// Múltiples parámetros: Si quieres enviar más de una cosa, se separan con el símbolo & (ampersand).

// Ejemplo: localhost:3000/buscar?producto=monitor&precio=200

// Todo es un String: Aunque envíes un número (como ?edad=25), Express lo recibirá como texto ('25'). Si necesitas hacer matemáticas, tendrás que usar parseInt().

// No son para datos secretos: Nunca envíes contraseñas por aquí, porque la URL queda guardada en el historial del navegador y cualquiera que mire la pantalla la verá.

// Dato de experto: Puedes poner tantos middlewares como quieras en fila.
// Por ejemplo: app.get('/admin', revisarLogueo, revisarPermisos, (req, res) => { ... }). Express los irá ejecutando uno por uno como una carrera de relevos.

// const esUsuarioVip = (req, res, next) => { ... };
// const esUsuarioVip: Estás creando una caja (variable constante) y le pones una etiqueta. En lugar de guardar un número (5) o un texto ("Hola"), vas a guardar una lógica de comportamiento.

// =: El operador de asignación. Le dices: "Lo que está a la derecha es lo que vive dentro de mi constante".

// (req, res, next) => { ... }: Esta es una función flecha (arrow function). Es una función anónima (no tiene nombre propio) que acaba de ser "adoptada" por la constante esUsuarioVip.

// Me 


const express = require('express');
const app = express();

// 1. Definimos la función del middleware por separado
const esUsuarioVip = (req, res, next) => {
    const vip = req.query.vip; // Leemos un dato de la URL: ?vip=si

    if (vip === 'si') {
        console.log("Acceso concedido a zona VIP");
        next(); // ¡Adelante!
    } else {
        console.log("Acceso denegado ( Mensaje dentre de funcion esUsuarioVip) ");
        res.status(403).send('No tienes permiso para entrar aquí sin ser VIP');
    }
};
// OTRO middleware pero usando una funcion normal para ver la diferencia  y no de flecha como la esUsuarioVip
// Primero definimos la funcion.
function esPersonaVip(req, res, next) {
    const personaVip = req.query.perVip;    // Leer el dato de la URL: ?perVip=si
    if (personaVip === 'si') {              // En personaVip habiamos guarado el parametro que llega con la URL
        console.log('Acceso concedido a persona Vip ( mensaje generado dentro ')
        next();   // Hace que se ejecute el res.send('Bienvenido Persona VIP'); dentro del app.get('/persona')
    } else {
            res.status(403).send('Acceso denegado, no eres persona VIP');
        }     
};



// 2. Aplicamos el middleware SOLO a esta ruta ( Funcion esUsuarioVip asignada a const )
app.get('/perfil', esUsuarioVip, (req, res) => {
    res.send('Bienvenido a tu perfil ultra secreto 🕵️‍♂️');
});

// Luego usamosla funcion esPersonaVip en la ruta
// Importante: Se incluye solo el nombre de la funcion esPersonaVip, SIN PARAMETROS. Express manda req, res, next por TI.
// Para entrar en esta ruta hay que escribir en el navegador http://localhost:3000/persona?perVip=si
// donde /persona es la URL de esta ruta pero la funcion esPersonaVip compara  if (req.query.perVip === 'si') 
app.get('/persona', esPersonaVip, (req, res) => {
    res.send('Bienvenido Persona VIP');
});

// Esta ruta NO tiene el middleware, es libre
app.get('/', (req, res) => {
    res.send('Inicio: Todo el mundo puede ver esto.');
});

app.listen(3000, () => console.log('Servidor en el 3000'));