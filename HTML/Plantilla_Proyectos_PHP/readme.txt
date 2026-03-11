

Estructura sugerida para las carpetas del directorio de un proyecto en PHP

mi-proyecto/
├── assets/                 		# Archivos públicos que el navegador lee directamente
│   ├── css/                		# Tus hojas de estilo (style.css)
│   ├── js/                 		# Tus scripts personalizados
│   └── img/                		# Imágenes y logos
├── includes/               		# Fragmentos de HTML reutilizables (Partials)
│   ├── head.php            	    # <head>, metas y enlaces a librerías (SweetAlert)
│   ├── header.php        		    # Menú de navegación / Logo
│   └── footer.php          		# Pie de página y scripts finales
├── src/                    		# La "cocina" del proyecto (Lógica PHP)
│   ├── funciones.php   		    # Aquí va tu función alerta()
│   ├── db.php              		# Conexión a la base de datos (si llegas a tenerla)
│   └── validaciones.php    	    # Lógica de formularios
├── index.php               		# Página principal (el "ensamblador")
└── contacto.php            	    # Otras páginas del sitio

Como crear fácilmente esta estructura de carpetas y archivos:
1.	Creamos una carpeta (New Folder) con el nombre del proyecto que queremos, por ejemplo “DirectorioDeUnProyecto”
2.	Boton derecho sobre el nombre de la nueva carpeta ( el new Folder) y seleccionamos la opción: Open in Integrated Terminal y se abrirá el terminal en la dirección de la nueva carpeta, mostrando toda la ruta hasta la carpeta:
PS E:\Python\WorkSpace curso Python_HTML_CSS_JavaScript\14 CURSO PROGRAMACION WEB DE eFUNDAE\HTML\DirectorioDeUnProyecto>
3.	Pegamos el siguiente comando para crear las subcarpetas y nombre de algunos archivos, con la estructura mostrada arriba ( Bueno, sin el archivo contacto.php)

Pegar esto:
mkdir assets/css, assets/js, assets/img, includes, src; New-Item src/funciones.php, includes/head.php, includes/header.php, includes/footer.php, index.php

Los archivos en las subcarpetas posrian reutilizables de proyecto a proyecto, como por ejemplo:
src/funciones.php y probablemente validaciones.php

El archivo que incluye en el raiz pues es un ejemplo (45 Validacion nombre email edad en servidor.php)
