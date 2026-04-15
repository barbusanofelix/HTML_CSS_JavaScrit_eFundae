## middleware a nivel de aplicacion

### 1. Crear el directorio

Creamos un directorio para el proyecto.<br>
Dentro de la carpeta que queremos crear el proyecto hacemos un : <br> <br> 
**mkdir 03_MiddleWareNivelAplicacion**


### 2. Inicializas el directorio con Node
Dentro del directorio para el proyecto **mkdir 03_MiddleWareNivelAplicacion** ejecutamos :<br>
**npm init -y**       <br>

### 3. Instalamos express
**npm install express**


## middleware para todo el proyecto

<pre>
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

</pre>

## VER EL middleware en acción:

Al colocal en el navegador "http://localhost:3000/" veremos , debajo de "Servidor activo en el puerto 3000" :<br>
Hora: [1:50:08] Petición recibida: GET con URL : /

<br>
La linea anterior la genera la instruccion **console.log()**  dentro de :<br>
app.use((req, res, next) => {  }

En las constantes :
app.use((req, res, next) => {
    const tiempo = new Date().toLocaleTimeString();
    const metodo = req.method; // GET, POST, etc.
    const url = req.url;       // /, /contacto, etc.

donde obtenemos la hora , metodo que se llamo y la URL que se colocó en el navegador ( aparte de localhost:3000)    

