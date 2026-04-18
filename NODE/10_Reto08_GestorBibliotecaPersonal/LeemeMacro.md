En este proyecto hemos construido siguiendo el patrón de diseño MVC (Modelo-Vista-Controlador), que es el estándar en la industria.

Resumen estructurado de la ruta lógica y los puntos donde no se puede fallar:

🗺️ Ruta Lógica de Construcción (El "paso a paso" ideal)
Para cualquier proyecto futuro, este es el orden que te garantiza menos errores:

Infraestructura (El Suelo): Configurar package.json, instalar dependencias y crear la estructura de carpetas. Sin esto, el camino se llena de errores de "archivo no encontrado".

El Corazón (app.js): Levantar el servidor básico y los middlewares (configurar que Express entienda JSON, formularios y archivos estáticos).

La Base de Datos (Persistencia): Conectar con MongoDB y definir el Modelo. El Modelo es la "verdad" de tu aplicación: si el modelo dice que un campo es obligatorio, nada funcionará si no lo envías.

El Cerebro (Controladores): Escribir las funciones que manipulan los datos (Lógica CRUD).

El Sistema de Navegación (Rutas): Unir las funciones del controlador con las URLs (/agregar, /eliminar, etc.).

La Cara (Vistas EJS y CSS): Crear el HTML dinámico y aplicar los estilos (BEM).

⚠️ Puntos Críticos y Claves (Lo que no puedes olvidar)
Estos son los "pecados mortales" que suelen causar que la app no funcione:

1. El Orden de los Middlewares
En app.js, el orden importa mucho.

Crítico: Siempre coloca express.urlencoded y express.json antes de tus rutas. Si no, cuando envíes un formulario, el servidor recibirá un req.body vacío y no podrá guardar nada.

2. La variable de entorno (.env)
Clave: Nunca subas el archivo .env a repositorios públicos (como GitHub). Es donde vive tu MONGO_URI.

Tip: Siempre verifica que el nombre de la variable en el .env (ej: MONGO_URI) coincida exactamente con el que usas en el código (process.env.MONGO_URI).

3. El ID de MongoDB (_id)
Crítico: Recuerda que MongoDB genera automáticamente un campo llamado _id (con guion bajo).

Clave: Al crear los enlaces de Editar o Eliminar, asegúrate de pasar ese ID correctamente en la URL (/eliminar/<%= libro._id %>). Sin ese ID, el servidor no sabe sobre qué libro actuar.

4. Coherencia en el Name de los Inputs
Clave: El atributo name en la etiqueta input en el HTML debe coincidir exactamente con los nombres que definiste en tu libroModel.js.

Ejemplo: Si en el modelo usamos titulo, en el input debe ser name="titulo". Si se llaman distinto, Mongoose ignorará los datos.

5. Render vs Redirect
Clave: * Usa res.render para mostrar una página (GET).

Usa res.redirect para limpiar el flujo después de una acción (POST, PUT, DELETE). Esto evita que si el usuario refresca la página, se vuelva a enviar el formulario accidentalmente.


# VIENDO LA LOGICA COMO UNA PELOTA 
Si la informacion es como una pellota como hay que pasarla? 

**La pelota (los datos) se pasa siguiendo un camino circular y muy estricto.**

Vamos a visualizarlo con una nueva funcionalidad: "Marcar libro como leído/no leído" (un botón que cambie un estado).

1. El ciclo de la pelota (The Flow)
Paso A: 
La Vista (Donde empieza el pase)
La pelota sale del usuario. En el HTML (index.ejs), **necesitas un botón que envíe el ID del libro**.

Acción: **Creas un enlace o formulario que apunte a una ruta**, por ejemplo: /completar/<%= libro._id %>.

Paso B: La Ruta (El receptor)
El archivo libroRoutes.js está escuchando. Recibe la pelota y dice: "¡Ah! Quieren ir a /completar. Se la paso al controlador".

Acción: router.get('/completar/:id', controlador.marcarLeido);

Paso C: El Controlador (El que hace la jugada)
Es el archivo libroController.js. Recibe el ID, va a la base de datos (Modelo) y le dice: "Oye, cambia este campo".

Acción: await Libro.findByIdAndUpdate(id, { leido: true });

Paso D: El Modelo (El que guarda la pelota)
El archivo libroModel.js valida que el cambio sea correcto según el esquema y lo guarda en el disco duro (MongoDB).

Paso E: El Redireccionamiento (Devolver la pelota)
El controlador, tras recibir el "OK" de la base de datos, le dice al navegador: "Listo, ahora vuelve a cargar la página principal".

Acción: res.redirect('/');

2. Puntos Clave para no "perder la pelota"
Para que la pelota no se pierda entre archivos, debes vigilar estos 3 conectores:

Los Parámetros de URL (:id): Si en la Ruta escribes /:id, en el Controlador debes atraparlo exactamente como req.params.id. Si escribes /:identificador, pues req.params.identificador. Tienen que ser gemelos.

El Body del Formulario (name=""):
Cuando usas POST, la pelota viaja escondida en el "cuerpo" de la solicitud. El nombre que le pongas al name en el HTML es el nombre que Express usará en req.body.nombre. Si no coinciden, la pelota se vuelve invisible.

El Contexto de EJS ({ datos }):
Cuando haces res.render('index', { libros: misLibros }), estás creando un puente. La variable libros solo existirá dentro de ese HTML porque tú la pasaste explícitamente.

Resumen de Oro
De Vista a Controlador: Usas req.params (URLs) o req.body (Formularios).

De Controlador a Vista: Usas el objeto dentro de res.render().

De Controlador a Modelo: Usas los métodos de Mongoose como .find(), .save() o .update().