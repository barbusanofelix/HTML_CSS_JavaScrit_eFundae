<?php
// E:\...\src\crear_sqlite.php
/*
Una vez que ejecutes este script, en la carpeta data/ ( creada en este proyecto o cualquiera carpeta data que creemos en un proyecto nuevo). Verás un archivo llamado productos.db
*/

/* ABREVIACIONES IMPORTANTES USADAS 

$stmt es la abreviación de la palabra inglesa Statement (que en este contexto significa "Sentencia" o "Declaración").

En programación de bases de datos, nos referimos a la "Sentencia SQL" que ya ha sido procesada o preparada por el servidor.

¿Por qué se usa $stmt y no $resultado?
Hay una diferencia técnica importante:

$pdo: Es el objeto de la Conexión (el túnel).

$stmt: Es el objeto de la Sentencia (la instrucción que viaja por el túnel).

Cuando haces $stmt = $pdo->prepare(...), la variable $stmt no contiene todavía los datos de los productos (como "Nevera"), sino que contiene el "Plano de la consulta" listo para ejecutarse.

La familia de variables estándar
En la comunidad de PHP, casi todos los programadores usan las mismas abreviaciones por convención. Es como un lenguaje secreto que hace que el código sea más fácil de leer para otros:

$conn o $db: Para la conexión inicial (aunque en PDO preferimos $pdo).

$sql: Para el string de texto con la instrucción (ej: "SELECT * FROM...").

$stmt: Para la sentencia preparada (el objeto PDOStatement).

$row: Para una fila individual de datos (cuando recorres un bucle).

$res o $results: Para el conjunto final de datos.

EJEMPLOS
$sql  = "SELECT * FROM inventario"; // Aquí es solo TEXTO
$stmt = $pdo->prepare($sql);        // Aquí es una SENTENCIA (Statement) preparada
$stmt->execute();                   // Aquí la SENTENCIA se ejecuta
$row  = $stmt->fetch();             // Aquí obtenemos una FILA (Row) de datos

*/

// 1. Definir la ruta del archivo (usamos __DIR__ para que sea exacta)
$rutaBaseDatos = __DIR__ . '/../data/productos.db';

try {
    // 2. Conectar (Esto crea el archivo productos.db si no existe)
    /*
    sqlite:: Este es el prefijo del DSN que le dice a PDO que use el driver de SQLite. No necesita usuario ni contraseña porque el "permiso" lo da el sistema de archivos de Windows/Linux.
    */
    $pdo = new PDO("sqlite:" . $rutaBaseDatos);

    // Configurar errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Crear la tabla de inventario
    // En SQLite, INTEGER PRIMARY KEY se auto-incrementa automatico
    /*
    id TEXT PRIMARY KEY: Como defini , por ejemplo, ID es "0001" (con ceros a la izquierda), usamos TEXT. Si usáramos INTEGER, SQLite lo convertiría automáticamente en el número 1.
    */

    $sqlTabla = "CREATE TABLE IF NOT EXISTS inventario (
        id TEXT PRIMARY KEY,
        descripcion TEXT NOT NULL,
        precio DECIMAL(10,2),
        cantidad INTEGER
    )";
    /*
    $pdo->exec($sql)
    Qué hace: Ejecuta una sentencia SQL y devuelve el número de filas afectadas.

    Cuándo usarla: Para operaciones que no devuelven datos, como CREATE TABLE, UPDATE o DELETE masivos, siempre que no haya variables externas.

    Sintaxis: $filasModificadas = $pdo->exec("DELETE FROM inventario WHERE cantidad = 0");

    Retorna: Un número entero (integer).
    */

    $pdo->exec($sqlTabla);

    // 4. Insertar el producto inicial
    // Usamos sentencias preparadas por seguridad
    /*
    INSERT OR IGNORE: Esto es muy útil en SQLite. Evita que el código de error "explote" si ejecutas el script dos veces (ya que no se puede insertar dos veces el mismo ID).
    */
    $sqlInsert = "INSERT OR IGNORE INTO inventario (id, descripcion, precio, cantidad) 
                  VALUES (:id, :desc, :precio, :cant)";
    /*
    $pdo->prepare($sql)
    Es la instrucción más importante para la seguridad. No ejecuta la consulta, sino que envía una "plantilla" a la base de datos.

    Qué hace: Prepara una sentencia SQL para ser ejecutada. Permite usar "marcadores" (como :id o :nombre) en lugar de variables directas para evitar inyecciones SQL.

    Sintaxis: $stmt = $pdo->prepare("SELECT * FROM tabla WHERE campo = :marcador");

    Retorna: Un objeto de tipo PDOStatement (que guardamos en $stmt).
*/


    $stmt = $pdo->prepare($sqlInsert);
    /*
    $pdo->execute($array)
    (Nota: Realmente se llama desde el objeto que devolvió prepare, es decir, $stmt->execute()).

    Qué hace: Envía los datos reales para rellenar los huecos de la plantilla preparada.

    Sintaxis: $stmt->execute(['marcador' => $valorReal]);

    Retorna: true si tuvo éxito o false si falló.
    */

    $stmt->execute([
        'id' => '0001',
        'desc' => 'Nevera HR300',
        'precio' => 359.99,
        'cant' => 3
    ]);

    echo "✅ Base de datos y tabla creadas con éxito.<br>";
    echo "✅ Producto 'Nevera HR300' insertado correctamente.";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}

/*
NO SE USA EN EL CODIGO ANTERIOR PERO SI ES POSIBLE QUE LO NECESITEMOS

$pdo->query($sql)
Qué hace: Ejecuta una sentencia SQL directamente en una sola llamada.

Cuándo usarla: Solo para consultas que no tienen variables del usuario (ej. SELECT * FROM categorias). Nunca la uses con datos que vengan de un formulario.

Sintaxis: $resultado = $pdo->query("SELECT * FROM productos");

Retorna: Un objeto PDOStatement directamente con los datos.

*/


/*
$pdo->lastInsertId()
Qué hace: Te dice cuál fue el último ID generado (en campos autoincrementales).

Cuándo usarla: Justo después de un INSERT si necesitas saber qué ID se le asignó al nuevo registro.

Sintaxis: $idNuevo = $pdo->lastInsertId();
*/

/*
$pdo->setAttribute($atributo, $valor)
Qué hace: Configura el comportamiento de la conexión.

Sintaxis: $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

Atributos comunes:

PDO::ATTR_ERRMODE: Define cómo reportar errores.

PDO::ATTR_DEFAULT_FETCH_MODE: Define cómo queremos que nos devuelva los datos (ej. PDO::FETCH_ASSOC para arreglos asociativos).


*/