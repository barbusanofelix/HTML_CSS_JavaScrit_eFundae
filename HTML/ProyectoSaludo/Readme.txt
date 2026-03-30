Este es un proyecto basico de las tegnologias Servlet con JSP.

El proyecto lo corri en VS code.
Use jdk-17 con tomcat 9

Instale la extension Community Server Connector ( SERVERS ) y la vincule a tomcat 9

No use Maven asi que tuve que añadir las librerias manualmente.

Usar el servidor tomcat desde VS code tiene sus mañas. 
Tenemos que añadir el Servidor al conector ( Boton derecho sobre el community Server Connector) - Create new Server y
navegar hasta la carpeta global tomcat 9 y darle FINISH en la ventana emergente.

Sobre el tomcat 9.x creado - boton derecho - Add Deployment - Seleccionar Exploded - Navegar hasta la carpeta de ProyectoSaludo, seleccionarla - Luego te pregunta arriba ( Do you want to edit deployment parameters? ) y seleccionamos NO ( si no selecionas nada) no se hace la conexion.
Si la seleccion es correcta te mostrara la direccion completa de la carpeta ProyectoSaludo debajo de tomcat 9.x 


PARA QUE FUNCIONE EL TOMCAT BIEN DONDE ESTA EL TOMCAT LE DAMOS ( PRIMERO BOTOM DERECHO) START SERVER PARA QUE MUESTRE (STARTED) JUNTO A TOMCAT 9.X Y LUEGO (BOTON DERECHO) PUBLISH SERVER (FULL) Y DEBE APARECER ENTRE PARENTISIS  (SYNCRONIZED).

Con lo anterior ya el servidor debe estar listo. 
Hay que ir directamente a Chrome ( u otro navegador) y colocar en el  navegador:

http://localhost:8080/ProyectoSaludo/index.jsp

El index.jsp mostrara 2 formularios, que piden nombre y un mensaje  ( los 2 son iguales pero lo quise separar porque cada uno sigue 2 caminos distintos para llegar al mismo resultado). Uno por variables y el otro usando una clase ( objeto) .
LOs formularios usan el metodo GET porque apenas lleva el nombre y un mensaje generico ( hola....o lo que quieras).( No es informacion sensible).

La estrucura de archivos se construyo con el terminal aplicando el comando  :
mkdir -p  ProyectoSaludo/assets/css,  ProyectoSaludo/assets/js,  ProyectoSaludo/assets/img,  ProyectoSaludo/src,  ProyectoSaludo/WEB-INF/classes,  ProyectoSaludo/WEB-INF/lib
ni  ProyectoSaludo/index.jsp,  ProyectoSaludo/WEB-INF/web.xml -Value ""

web.xml ( el Descriptor de Despliegue) se creo en la estrucura como vacio pero luego hay que colocar las relaciones:
El archivo quedo asi:
<?xml version="1.0" encoding="UTF-8"?>
<!-- La linea 1 siempre debe ser la anterior  -->
<web-app xmlns="http://xmlns.jcp.org/xml/ns/javaee"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:schemaLocation="http://xmlns.jcp.org/xml/ns/javaee
                      http://xmlns.jcp.org/xml/ns/javaee/web-app_4_0.xsd"
  version="4.0">

<!-- La siguiente linea es para informacion -->
<display-name>ProyectoSaludo</display-name>

<!-- Mapeo de SaludoServlet -->
<servlet>
    <servlet-name>ServletDeSaludo</servlet-name>
    <servlet-class>SaludoServlet</servlet-class>
  </servlet>

  <servlet-mapping>
    <servlet-name>ServletDeSaludo</servlet-name>
    <url-pattern>/ProcesarSaludo</url-pattern>
  </servlet-mapping>

<!-- Mapeo de BeanServlet -->
  <servlet>
    <servlet-name>ServletBean</servlet-name>
    <servlet-class>BeanServlet</servlet-class>
</servlet>

<servlet-mapping>
    <servlet-name>ServletBean</servlet-name>
    <url-pattern>/ProcesarConBean</url-pattern>
</servlet-mapping>

  
</web-app>
Por ejemplo en el segundo formulario tenemos la action="ProcesarConBean".

El usuario pulsa un botón que apunta a: action="ProcesarConBean".

Tomcat mira el web.xml y busca quién tiene el <url-pattern>/ProcesarConBean</url-pattern>.

Ve que ese patrón pertenece al "apodo" ServletBean.

Busca arriba quién es ServletBean y ve que su clase real es BeanServlet.

Tomcat va a WEB-INF/classes/BeanServlet.class y lo pone a trabajar.


La clase BeanServlet.class es la que finalmente direcciona a /saludoBean.jsp ( en la instruccion : 
var1.getRequestDispatcher("/saludoBean.jsp").forward(var1, var2);).

La compilacion de las clases las hice manualmente. Hay que tomar todos los archivos dentro de src y sus carpetas y luego colocar los archivos compilados a .class se meten en el directorio WEB-INF/classes , donde debemos incluir las subcarpetas que venian de src. En otras palabras, si tomamos el directorio src con archivos .java veremos que en la carpeta classes ( dentro de WEB-INF) tendremos los mismos nombres de archivo solo que las extensiones son .class y no java .
Eso es asi porque tomcat necesita los archivos compilados que estan en el directorio WEB-INF/classes

El "Truco" para compilar con paquetes
Al tener una subcarpeta, el comando de compilación cambia un poco. Ahora tienes que compilar primero el Bean (porque el Servlet lo necesita para existir) y luego el Servlet.

Prueba estos pasos en tu terminal:

Compilar el Bean:

"En PowerShell"
javac -d WEB-INF/classes src/modelos/Usuario.java
Nota: El parámetro -d es inteligente; él solo creará la carpeta modelos dentro de WEB-INF/classes por ti.

Compilar el nuevo Servlet:

"En PowerShell"
javac -cp "E:\tomcat_version_9\lib\servlet-api.jar;WEB-INF/classes" -d WEB-INF/classes src/BeanServlet.java
Fíjate que en el -cp añadí ;WEB-INF/classes. Esto es porque BeanServlet necesita "leer" la clase Usuario que acabas de compilar en el paso anterior.

Si tienes dudas pregunta a IA Gemini.


