
# AYUDA DE ESTE PROYECTO. ( ProyectoImcReto06 . Nombre usando PascalCase . estandard para Clases en Java )

## Este proyecto consiste en calcular IMC ( Indice de masa Corporal) 

Las plataformas bases fueron:<br>
* Lenguaje: Java SE 17 (LTS).<br>
* Plataforma Web: Java EE 8 (basado en Tomcat 9).<br>
* Especificación: Servlets 4.0 / JSP 2.3 (usando el paquete javax).<br>

**1. Descripción del Proyecto**<br>
Este proyecto es una aplicación web Java (J2EE) diseñada para calcular el Índice de Masa Corporal (IMC) y clasificarlo según los estándares de la OMS. 
Esta se centra en la lógica de negocio sólida y la visualización de resultados mediante tablas dinámicas.

**2. Estructura de Archivos y Responsabilidades**<br>
Para que este proyecto funcione, los archivos deben relacionarse de la siguiente manera:

**index.jsp:**<br> 
El punto de entrada. Contiene el formulario HTML para captar peso y altura.

**Persona.java (en src/modelos/):**<br<> 
El Bean que realiza el cálculo matemático 

$IMC = peso / altura^2$. 

Es el encargado de determinar la categoría (Normal, Sobrepeso, etc.).<br>

**ServletImc.java (en src/):**<br> 
El controlador que recibe los datos del formulario, instancia a la clase Persona y decide qué página mostrar a continuación.<br>

**resultado.jsp:**<br> 
La vista final que muestra el número del IMC y resalta la fila correspondiente en la tabla de categorías.<br>

**estilos.css (en assets/css/):**<br> 
Contiene las clases .bajo-peso, .normal, .sobrepeso y .obesidad para dar color a los resultados.

**3. Lógica de Intercambio de Datos (El Bean)**<br>
En esta versión, el uso de <jsp:useBean> es fundamental:<br>
    El Servlet crea el objeto Persona, calcula el IMC y lo guarda en la sesión:<br>
    <pre>
        request.getSession().setAttribute("datosPersona", p);
    </pre>   
    El archivo **resultado.jsp** recupera ese objeto automáticamente usando el id="datosPersona", permitiendo mostrar el valor sin necesidad de volver a calcular nada en la vista.

**4. Clasificaciones del IMC**<br>



| Categoría | Rango IMC | Acción Visual |
| :--- | :--- | :--- |
| **Bajo peso** | < 18.5 | Se aplica clase `.bajo-peso` (Naranja) |
| **Normal** | 18.5 - 24.9 | Se aplica clase `.normal` (Verde) |
| **Sobrepeso** | 25.0 - 29.9 | Se aplica clase `.sobrepeso` (Naranja) |
| **Obesidad** | ≥ 30.0 | Se aplica clase `.obesidad` (Rojo) |

5. Pasos para la Compilación y Despliegue
Al ser un proyecto puramente Java/JSP, los comandos en consola son vitales:

* Compilar Modelo: javac -d WEB-INF/classes src/modelos/Persona.java.

* Compilar Servlet: javac -cp "ruta/a/servlet-api.jar;WEB-INF/classes" -d WEB-INF/classes src/ServletImc.java.

* Reiniciar Tomcat: Asegurarse de que el estado sea Started y Synchronized para que los cambios en los archivos .class surtan efecto. Comandos criticos son el Start Server y Publish Server (Full)

## **PASOS BASICOS** 
1. Cree el directorio ProyectoImcReto06.
2. Armé, por consola,  la estructura de carpetas de ProyectoImcReto06

    * Hay que abrir el terminal en la carpeta que contendra el ProyectoImcReto06.
    * El comando en la terminal es: 

    ***
   mkdir -p ProyectoImcReto06/assets/css, ProyectoImcReto06/assets/js, ProyectoImcReto06/assets/img, ProyectoImcReto06/src, ProyectoImcReto06/WEB-INF/classes, ProyectoImcReto06/WEB-INF/lib
    ni ProyectoImcReto06/index.jsp, ProyectoImcReto06/WEB-INF/web.xml -Value ""

    ***

El resultado fue:
***
Estructura de carpetas
<pre>
ProyectoImcReto06/            <-- Raíz del proyecto (Context Path)
├── index.jsp                 <-- Archivo JSP (Público)                     ESTE ARCHIVO NO ESTACREADO
├── login.jsp                 <-- Archivo JSP (Público)                     ESTE ARCHIVO NO ESTACREADO
├── assets/                   <-- Carpetas para recursos estáticos
│   ├── css/                  <-- Estilos .css
│   ├── js/                   <-- Scripts .js
│   └── img/                  <-- Imágenes .png, .jpg
├── src/                      <-- TU CÓDIGO FUENTE (Zona de trabajo)
│   └── MiServlet.java        <-- El archivo que tú escribes                ESTE ARCHIVO NO ESTACREADO
└── WEB-INF/                  <-- CARPETA DE CONFIGURACIÓN (Privada/Oculta)
    ├── web.xml               <-- El "Descriptor de Despliegue" (Vital)     ESTE ARCHIVO LO CREA EN BLANCO
    ├── classes/              <-- EL MOTOR (Donde vive el código compilado) 
    │   └── MiServlet.class   <-- El archivo compilado que Tomcat ejecuta   ESTE ARCHIVO NO ESTACREADO
    └── lib/                  <-- LIBRERÍAS EXTERNAS  
        └── conector-db.jar   <-- Archivos .jar (como el de MySQL)          ESTE ARCHIVO NO ESTACREADO
</pre>
Crear una carpeta **modelos** dentro de src para el Bean ( Bean : Compartir/Manejar objeto )

***

Lo principal a considerar es la creacion del esqueleto a considerar, donde lo minimo a considerar: 
* Un directorio RAIZ : ProyectoImcReto06
* Directorios secundarios : assets, src, WEB-INF
* Los archivos jsp se incluyen en el directorio RAIZ
* Los archivos [*]Servlet.java  , Donde [*] representa palabra(s) descriptivas de la accion que hace el Servlet van dentro de src y estos archivos hay que compilarlos a estension .class y los compilados se almacenan en WEB-INF/classes donde se guardan con el [mismo nombre del archivo].class  ( La extension pasa a .class). Eso es para que tomcat los pueda ejecutar.


3. Hacer el web.xml ( El descriptor de Despliegue ), asi: <br>

```
    <?xml version="1.0" encoding="UTF-8"?>
    <web-app xmlns="http://xmlns.jcp.org/xml/ns/javaee"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://xmlns.jcp.org/xml/ns/javaee
                      http://xmlns.jcp.org/xml/ns/javaee/web-app_4_0.xsd"
    version="4.0">
    <!-- Esto es basicamente informativo -->
    <display-name>ProyectoImcReto06</display-name>

    <!--  En esta zona va el mapeo de las paginas -->
    <servlet>
        <servlet-name>ServletSalud</servlet-name>
        <servlet-class>ServletImc</servlet-class>
    </servlet>

    <servlet-mapping>
        <servlet-name>ServletSalud</servlet-name>
        <url-pattern>/CalcularImc</url-pattern>
    </servlet-mapping>

    </web-app>
```
### **Detalles del web.xml:**<br>
En el archivo index.jsp tenemos la instruccion: 
```
<form action="CalcularImc" method="get">
```
**CalcularImc** del form => url-pattern /CalcularImc =>  servlet-name: ServletSalud => clase ServletImc => resultado.jsp

### **El Camino de la Petición (Request Flow)** ( Extension de la explicacion anterior)<br>
**Disparador (Vista):** El usuario hace clic en el botón del formulario en index.jsp. El navegador busca el destino CalcularImc.

**Puerta de Enlace (URL Pattern):** Tomcat recibe la petición, mira el web.xml y encuentra que el <url-pattern> /CalcularImc está registrado.

**Identificador Interno (Servlet Name):** El mapeo le dice a Tomcat: "Este patrón de URL pertenece al alias ServletSalud".

**Ejecutor (Servlet Class):** Tomcat busca quién es ServletSalud en la sección de definición y encuentra que la clase física encargada de trabajar es **ServletImc.class**.

**Procesamiento (Lógica):** Se ejecuta el método doGet (porque tu form usa method="get") dentro de ServletImc.java. Aquí se usa el Bean Persona para calcular todo.

**Despacho (Forward):** El Servlet hace un RequestDispatcher hacia **resultado.jsp** para mostrar los datos finales al usuario.

    
4. Añadir libreria servlet-api.jar :  
Para que visual estudio code detecte que la carpeta ProyectoImc06 es un proyecto java debe tener al menos un archivo dentro de src que tenga extension .java, inclusive si esta en blanco. 
Al colocar el archivo nos aperecera, abajo a la izquierda, JAVA PROJECT y luego de unos segundos veremos, debajo de JAVA PROJECT una carpeta con el nombre ProyectoImc06 y debajo de ella carpetas src ( donde coloque el archivo vacio con extension java) , una carpeta JRE System Library (JavaSE-17) y una carpeta "Referenced Libraries" , que no tiene nada.
* Hacemos clic en el simbolo **+**  a la derecha de Referenced Libraries. para añadir la libreria servlet-api.jar
    * Tenemos que conocer la ubicacion. En este caso lo tenemos en **E:\tomcat_version_9\lib** asi que al hacer clic entra al explorador de windows y buscamos la carpeta indicada y damos clic sobre el archivo **servlet-api.jar**

5. Compilaciones:
    * Compilar el Bean: **javac -d WEB-INF/classes src/modelos/Persona.java**
    * Compilar el Servlet: **javac -cp "E:\tomcat_version_9\lib\servlet-api.jar;WEB-INF/classes" -d WEB-INF/classes src/ServletImc.java**
    * Verificar carpetas: Que los .class estén en WEB-INF/classes y el Persona.class esté dentro de modelos/.

6. Correr el Proyecto:
    * Añadir el servidor Tomcat 9.x 
    * Add Deployment: Asegúrate de que el servidor tenga el proyecto cargado y diga Synchronized.
        * El deployment apunta a la carpeta completa de ProyectoImcReto06 - Exploded y atento en darle NO, a la pregunta de cambiar algun parametro. ( Las preguntas salen en la parte superior y como la conexion al servidor se hace en la parte inferior izquierda, NO se ve mucho sino estamos atentos = NO se hace la conexion.)
    * Junto a Tomcat 9.x debe aparecer (Started) (Synchronized). El Stardt viene al darle boton derecho sobre el Tomcat y hacer clic en **start server** y el synchronized al darle boton derecho y hacer clic en **Publish Server (Full)**
