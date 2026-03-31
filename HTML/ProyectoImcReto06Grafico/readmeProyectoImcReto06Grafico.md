
# AYUDA DE ESTE PROYECTO. ( ProyectoImcReto06Grafico . Nombre usando PascalCase . estandard para Clases en Java )

## Este proyecto consiste en calcular IMC ( Indice de masa Corporal) 
### Este proyecto es la continuacion del ProyectoImcReto06 con la adicion de un grafico.

1. Cree el directorio ProyectoImcReto06Grafico.
2. Armé, por consola,  la estructura de carpetas de ProyectoImcReto06Grafico

    * Hay que abrir el terminal en la carpeta que contendra el ProyectoImcReto06Grafico.
    * El comando en la terminal es: 

    ***
   mkdir -p ProyectoImcReto06Grafico/assets/css, ProyectoImcReto06Grafico/assets/js, ProyectoImcReto06Grafico/assets/img, ProyectoImcReto06Grafico/src, ProyectoImcReto06Grafico/WEB-INF/classes, ProyectoImcReto06Grafico/WEB-INF/lib
    ni ProyectoImcReto06Grafico/index.jsp, ProyectoImcReto06Grafico/WEB-INF/web.xml -Value ""

    ***

El resultado fue:
***
Estructura de carpetas
<pre>
ProyectoImcReto06Grafico/            <-- Raíz del proyecto (Context Path)
├── index.jsp                 <-- Archivo JSP (Público)                     ESTE ARCHIVO NO ESTACREADO
├── login.jsp                 <-- Archivo JSP (Público)                     ESTE ARCHIVO NO ESTACREADO
├── assets/                   <-- Carpetas para recursos estáticos
│   ├── css/                  <-- Estilos .css
│   ├── js/                   <-- Scripts .js
│   └── img/                  <-- Imágenes .png, .jpg
├── src/                      <-- TU CÓDIGO FUENTE (Zona de trabajo)
│   │── MiServlet.java        <-- El archivo que tú escribes                ESTE ARCHIVO NO ESTACREADO
│   └── modelos               <-- Aqui añadi el directorio modelos para colocar Persona.java
└── WEB-INF/                  <-- CARPETA DE CONFIGURACIÓN (Privada/Oculta)
    ├── web.xml               <-- El "Descriptor de Despliegue" (Vital)     ESTE ARCHIVO LO CREA EN BLANCO
    ├── classes/              <-- EL MOTOR (Donde vive el código compilado) 
    │   └── MiServlet.class   <-- El archivo compilado que Tomcat ejecuta   ESTE ARCHIVO NO ESTACREADO
    │   └── Persona.class     <-- Compile el archivo.
    └── lib/                  <-- LIBRERÍAS EXTERNAS  
        └── conector-db.jar   <-- Archivos .jar (como el de MySQL)          ESTE ARCHIVO NO ESTACREADO
</pre>
Crear una carpeta **modelos** dentro de src para el Bean ( Bean : Compartir/Manejar objeto )

***

Lo principal a considerar es la creacion del esqueleto a considerar, donde lo minimo a considerar: 
* Un directorio RAIZ : ProyectoImcReto06Grafico
* Directorios secundarios : assets, src, WEB-INF
* Los archivos jsp se incluyen en el directorio RAIZ
* Los archivos [*]Servlet.java  , Donde [*] representa palabra(s) descriptivas de la accion que hace el Servlet van dentro de src y estos archivos hay que compilarlos a estension .class y los compilados se almacenan en WEB-INF/classes donde se guardan con el [mismo nombre del archivo].class  ( La extension pasa a .class). Eso es para que tomcat los pueda ejecutar.


3. Colocar el basico minimo del archivo web.xml ( El descriptor de Despliegue )

```
    <?xml version="1.0" encoding="UTF-8"?>
    <web-app xmlns="http://xmlns.jcp.org/xml/ns/javaee"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://xmlns.jcp.org/xml/ns/javaee
                      http://xmlns.jcp.org/xml/ns/javaee/web-app_4_0.xsd"
    version="4.0">
    <!-- Esto es basicamente informativo -->
    <display-name>ProyectoWeb</display-name>

    <!--  En esta zona va el mapeo de las paginas -->


    </web-app>
```
    
4. Añadir libreria servlet-api.jar :  
Para que visual estudio code detecte que la carpeta ProyectoImc06 es un proyecto java debe tener al menos un archivo dentro de src que tenga extension .java, inclusive si esta en blanco. 
Al colocar el archivo nos aperecera, abajo a la izquierda, JAVA PROJECT y luego de unos segundos veremos, debajo de JAVA PROJECT una carpeta con el nombre ProyectoImc06 y debajo de ella carpetas src ( donde coloque el archivo vacio con extension java) , una carpeta JRE System Library (JavaSE-17) y una carpeta "Referenced Libraries" , que no tiene nada.
* Hacemos clic en el simbolo **+**  a la derecha de Referenced Libraries. para añadir la libreria servlet-api.jar
    * Tenemos que conocer la ubicacion. En este caso lo tenemos en **E:\tomcat_version_9\lib** asi que al hacer clic entra al explorador de windows y buscamos la carpeta indicada y damos clic sobre el archivo **servlet-api.jar**

5. Compilaciones: (Cada modificacion en los archivos java, en src, hay que compilarlos para que pasen al directorio classes como .class)
    * Compilar el Bean: **javac -d WEB-INF/classes src/modelos/Persona.java**
    * Compilar el Servlet: **javac -cp "E:\tomcat_version_9\lib\servlet-api.jar;WEB-INF/classes" -d WEB-INF/classes src/ServletImc.java**
    * Verificar carpetas: Que los .class estén en WEB-INF/classes y el Persona.class esté dentro de modelos/.

6. Correr el proyecto:
    * Añadir el servidor Tomcat 9.x 
    * Add Deployment: Asegúrate de que el servidor tenga el proyecto cargado y diga Synchronized.
        * El deployment apunta a la carpeta completa de ProyectoImcReto06Grafico - Exploded y atento en darle NO, a la pregunta de cambiar algun parametro. ( Las preguntas salen en la parte superior y como la conexion al servidor se hace en la parte inferior izquierda, NO se ve mucho sino estamos atentos = NO se hace la conexion.)
    * Junto a Tomcat 9.x debe aparecer (Started) (Synchronized). El Stardt viene al darle boton derecho sobre el Tomcat y hacer clic en **start server** y el synchronized al darle boton derecho y hacer clic en **Publish Server (Full)**

7. Arquitectura y Flujo de Datos
El proyecto sigue el patrón MVC (Modelo-Vista-Controlador). Así es como interactúan los archivos que has creado:

#### **Descripción de los Componentes:**
**Persona.java (El Modelo/Bean):**
**Función:** Es la unidad de almacenamiento. Contiene los atributos (peso, altura, imc) y la lógica de cálculo.
**Ubicación:** src/modelos/.
**Relación:** Es el objeto que "viaja" por todo el sistema. El Servlet lo llena de datos y los JSPs lo leen para mostrar resultados.

**index.jsp (La Vista de Entrada):** <br>
**Función:** Formulario inicial donde el usuario introduce su peso y altura.<br>
**Relación:** Envía los datos mediante un método POST hacia el Servlet.

**ServletImc.java (El Controlador):**<br>
**Función:** Es el "cerebro". Recibe los datos del formulario, crea una instancia de Persona, ordena el cálculo del IMC y genera la lista de proyección (variación de +/- 10kg) para el gráfico.<br>
**Relación:** Guarda el objeto Persona y las listas del gráfico en la Sesión (HttpSession) para que no se pierdan, y luego redirige al usuario a la página de **resultado**.

**resultado.jsp (La Vista de Resultados):**<br>
**Función**: Muestra el IMC calculado y la tabla de categorías (Normal, Sobrepeso, etc.).<br>
**Relación:** Recupera el Bean Persona de la sesión para mostrar los datos. Contiene el botón para ir a la proyección gráfica.

**grafico.jsp (La Vista Visual):**<br>
**Función:** Renderiza el gráfico interactivo usando la librería Chart.js. <br>
**Relación:** Toma las listas de pesos e IMCs que el Servlet dejó en la sesión y las convierte en arreglos de JavaScript para dibujar la curva sobre las zonas de salud.

#### **El Camino de los Datos (Paso a Paso):**<br>
*Usuario introduce datos en index.jsp.
*ServletImc procesa, calcula y guarda en la Sesión.
*ServletImc redirige a resultado.jsp.
*El usuario decide ver más y navega a grafico.jsp.
*grafico.jsp extrae todo de la sesión y presenta la comparativa visual final.

#### **Nota adicional:**<br>
Gestión de Sesión: Es vital entender que usamos la sesión para que grafico.jsp sepa qué datos calculó el Servlet sin tener que pedirlos de nuevo al usuario.

Compilación: Recuerda que si cambias una fórmula en Persona.java, debes recompilar tanto el Bean como el Servlet (paso 5 de tu guía) para que los cambios se reflejen en Tomcat.    

8. Solución de Problemas Comunes (Troubleshooting)
En el desarrollo con Tomcat y JSP/Servlets, es común que el servidor se "quede pegado" con versiones antiguas. Aquí cómo solucionarlo:

A. Los cambios en el código Java no se ven
Causa: No se ha recompilado el archivo .java o Tomcat no ha detectado el nuevo .class.

**Solución:**<br> 
1. Detén el servidor (Stop Server).
2. Ejecuta el comando de compilación de nuevo (Paso 5 de la guía).
3. Start Server ( Antes, Boton derecho sobre nombre servidor )
3. Haz clic derecho en Tomcat -> Publish Server (Full).
    * Junto al nombre del servidor debe verse (Started) ( Synchronized) 

B. Error 404 al intentar acceder al Servlet
Causa: El nombre del Servlet en el formulario del index.jsp no coincide con el @WebServlet o con el mapeo en web.xml.

Solución: Revisa que el action del <form> sea exactamente igual al nombre configurado en el código Java.

C. La gráfica no carga o sale en blanco
Causa: Falta de conexión a internet (para descargar la librería Chart.js) o un error de sintaxis en JavaScript.

**Solución:** <br>
1. Abre la Consola del Navegador (F12 -> pestaña "Console").
2. Si ves errores en rojo, te dirá exactamente en qué línea de tu grafico.jsp está el fallo.

D. El servidor dice "Port 8080 already in use"
Causa: Hay otra instancia de Tomcat (o programa) usando el puerto.

**Solución:**<be> 
1. Cierra todas las terminales.
2. Si persiste, cambia el puerto en el archivo conf/server.xml de tu instalación de Tomcat (por ejemplo, al 8081).<br>


9.Lógica de Cálculo e Implementación del Gráfico<br>

**A. El Motor de Cálculo (Clase Persona.java)**<br>
La lógica se basa en la fórmula estándar de la Organización Mundial de la Salud (OMS):

Fórmula del IMC: Se calcula dividiendo el peso (kg) por la altura al cuadrado ($m^2$).$$IMC = \frac{peso}{altura^2}$$

**Generación de Proyección:**<br> 
El método getProyeccion() en el Bean no solo calcula el estado actual, sino que genera un mapa de datos (Map<Double, Double>).Toma el peso base y resta 10kg para el inicio.Suma de 1 en 1kg hasta llegar a peso + 10kg. Para cada peso intermedio, recalcula el IMC manteniendo la altura constante.<br>

**B. La Magia del Gráfico (Plugin de Chart.js)**<br>
El gráfico en grafico.jsp no es una imagen estática; es un lienzo (Canvas) dibujado programáticamente para garantizar precisión.Tratamiento de Datos: Los datos del Map de Java se inyectan en arreglos de JavaScript (etiquetas y datosImc) mediante bucles JSP.<br>
**Zonas de Salud (Semáforo):** Se implementó un Plugin Personalizado llamado zonasColorSolidasYPrecisas.<br>
**Recorte (Clipping):** Se usa ctx.clip() para asegurar que los colores no se salgan de los ejes X e Y.<br>
**Coordenadas Dinámicas:** El color no se pone "a ojo"; se usa yScale.getPixelForValue(valor) para que la franja verde siempre coincida exactamente con el rango 18.5 - 24.9 del eje Y, sin importar el tamaño de la pantalla.<br>
**Etiquetado Inteligente:** Las categorías (NORMAL, SOBREPESO, etc.) se dibujan en el lado izquierdo (ctx.textAlign = 'left') con un margen de 15px respecto al eje, facilitando la lectura inmediata del usuario.<br>

**C. Resaltado del Punto Actual**<br>
Para que el usuario se ubique, el gráfico compara cada etiqueta con el peso real almacenado en el Bean.Si etiqueta === pesoUsuario, el punto se pinta de Rojo (#e74c3c).Si no, el punto permanece Blanco para contrastar con los fondos sólidos.


**10.Resumen de comandos útiles**<br>

```
Compilar Bean	  javac -d WEB-INF/classes src/modelos/Persona.java<br>
Compilar Servlet  javac -cp ".../lib/servlet-api.jar;WEB-INF/classes" -d WEB-INF/classes src/ServletImc.java<br>
Ubicación .class  WEB-INF/classes/modelos/Persona.class<br>
Librería Vital	  servlet-api.jar (dentro de la carpeta lib de Tomcat)<br>
```