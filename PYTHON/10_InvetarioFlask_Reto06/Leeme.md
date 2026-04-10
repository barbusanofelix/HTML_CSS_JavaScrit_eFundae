
# 🏗️ 1. El Corazón: 
La Base de Datos (SQLite + SQLAlchemy)<br>
Elegimos SQLite porque es un archivo local (inventario.db). <br>
No requiere instalar un servidor complejo como MySQL.<br>
## El concepto de ORM<br>
En lugar de escribir código SQL como CREATE TABLE..., usamos SQLAlchemy.<br>
Esto nos permite tratar a los productos como objetos de Python.<br>
Punto clave: Al definir @property en el modelo, permitimos que el Stock se calcule dinámicamente:<br><br>
$Stock = Entradas - Salidas$.<br><br>
Esto es vital: No guardamos el stock en la base de datos para evitar que se desincronice si alguien modifica una entrada manualmente.


# 🧠 2. La Lógica de Control (app.py)
Flask actúa como el "director de orquesta". Su trabajo es escuchar las peticiones del usuario y decidir qué hacer.

Rutas (@app.route): Son las direcciones URL.

Contexto de Aplicación: El comando db.create_all() dentro del app_context es el que asegura que, si borras el archivo .db, Flask lo vuelva a crear al arrancar basándose en tu código.

Captura de Datos: Usamos request.form.get() para extraer lo que el usuario escribe en el HTML.

# 🎨 3. La Capa de Presentación (Jinja2 + CSS3)
Flask usa un motor llamado Jinja2 para renderizar los HTML.

Bucle For: {% for p in productos %} nos permite escribir el código de una sola fila de la tabla y que Flask la repita 100 veces si hay 100 productos.

Lógica en el Template: Podemos usar condicionales para poner colores (verde si es entrada, rojo si es salida).

CSS3: Usamos Flexbox para el diseño responsivo y sombras (box-shadow) para dar profundidad, lo que separa visualmente el contenido del fondo.

# 🚩 Puntos Críticos de Aprendizaje
El Entorno Virtual (venv): Es tu "burbuja". Evita que las librerías de este proyecto se mezclen con otros, lo que garantiza que tu código funcione en cualquier computadora.

El Ciclo de Vida de una Petición:

Usuario hace clic (POST).

Flask recibe los datos.

SQLAlchemy busca el producto y suma/resta.

db.session.commit() guarda los cambios permanentemente.

redirect refresca la página para mostrar los datos actualizados.

¡Claro que sí! Para cerrar con broche de oro, vamos a diseccionar el proyecto. En el desarrollo web con Python, la organización es tan importante como el código.

Aquí tienes el mapa de lo que hemos construido y por qué cada pieza es vital.

# 📂 Arquitectura del Proyecto
### 1. models.py (El Plano Arquitectónico)
Este archivo define qué datos vamos a guardar. Es el lenguaje que entiende la base de datos.

**Punto Clave:** El uso de db.Model. Al heredar de aquí, Flask sabe que esta clase debe convertirse en una tabla de SQLite.

La Lógica de Negocio: Aquí definimos los @property (stock_actual y valor_inventario).

**¿Por qué es clave?** Porque el cálculo se hace en Python justo antes de mostrarlo, asegurando que si cambias una "Entrada", el stock se actualice al instante sin errores de suma manual.

### 2. inventario_app.py (El Cerebro/Controlador)
Es el archivo que "corre". Su función es recibir las peticiones del navegador y decidir qué responder.

**app.config:** Aquí es donde ocurre la magia de la carpeta instance. Al configurar la URI de la base de datos, Flask establece la conexión.

**Las Rutas (@app.route):** * GET: Cuando solo pides ver la página (Index o Reporte).

**POST:** Cuando envías datos (Crear producto o Movimiento).

**db.session.commit():** Este es el "botón de guardar". Sin esta línea, los cambios se quedan en la memoria volátil y no se escriben en el archivo .db.

## 3. La carpeta templates/ (La Cara Visible)
Flask usa el motor Jinja2 para que el HTML deje de ser estático y se vuelva inteligente.

**index.html:** Contiene los formularios. El punto clave aquí es el atributo name en la etiqueta input. Ese nombre es el que Flask buscará con request.form.get('nombre').

**reporte.html:** Usa bucles {% for ... %}. Esto permite que tu tabla crezca sola. No importa si tienes 2 o 2,000 productos, el código HTML es el mismo.

## 4. La carpeta instance/ y inventario.db
Aquí vive la persistencia.

SQLite: Es una base de datos de "un solo archivo". Es perfecta para este nivel de proyecto porque no requiere configuración, pero es lo suficientemente potente para manejar miles de registros.

# 🔑 Conceptos Lógicos Fundamentales
## El Ciclo de Vida de un Movimiento
Para entender cómo fluye la información, sigue este camino:

**Navegador:** El usuario escribe "10" en entradas y pulsa "Guardar".

**Ruta /movimiento:** Recibe el código y la cantidad.

**ORM (SQLAlchemy):** Busca el objeto en la base de datos: Producto.query.filter_by(codigo=codigo).first().

**Actualización:** Se suma la cantidad al atributo .entradas.

**Persistencia:** db.session.commit() guarda en el disco duro.

**Respuesta:** redirect(url_for('reporte')) le dice al navegador: "Vete a la página de reporte para ver los cambios".

# 🏆 Resumen para tu portafolio
Los puntos fuertes son:

Uso de un entorno virtual para la limpieza de dependencias.

Separación de responsabilidades: Modelos por un lado, rutas por otro y diseño por otro.

Integridad de datos: Los cálculos de stock no se guardan, se derivan de las transacciones (entradas/salidas), lo que evita errores contables.