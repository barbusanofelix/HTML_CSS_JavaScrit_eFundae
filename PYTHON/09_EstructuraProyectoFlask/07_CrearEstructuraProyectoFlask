
# Copiamos este archivo dentro de la Carpeta que usaremos para el proyecto
# Hay que crear manualmente la carpeta y luego este archivo.
import os

def crear_estructura(nombre_proyecto):
    # --- PASO CLAVE: Obtener la ruta donde reside este script ---
    # __file__ es la ubicación de este archivo .py
    directorio_actual = os.path.dirname(os.path.abspath(__file__))
    
    # Unimos la ruta del directorio con el nombre del proyecto
    ruta_base_proyecto = os.path.join(directorio_actual, nombre_proyecto)

    # Definimos la estructura usando la ruta absoluta
    estructura = [
        ruta_base_proyecto,
        os.path.join(ruta_base_proyecto, "templates"),
        os.path.join(ruta_base_proyecto, "static"),
        os.path.join(ruta_base_proyecto, "static/css")
    ]
    
    # Creamos las carpetas
    for ruta in estructura:
        os.makedirs(ruta, exist_ok=True)
        print(f"✔ Carpeta creada: {ruta}")

    # Creamos el archivo app.py dentro de la carpeta del proyecto
    ruta_app = os.path.join(ruta_base_proyecto, "app.py")
    
    with open(ruta_app, "w", encoding="utf-8") as f:
        f.write("from flask import Flask, render_template\n\n")
        f.write("app = Flask(__name__)\n\n")
        f.write("@app.route('/')\n")
        f.write("def index():\n")
        # Usamos f-string para insertar el nombre del proyecto limpiamente
        f.write(f"    return '<h1>Proyecto: {nombre_proyecto}</h1>'\n\n")
        f.write("if __name__ == '__main__':\n")
        f.write("    app.run(debug=True, port=5001)\n")
    
    print(f"\n🚀 ¡Éxito! Proyecto creado en:\n{ruta_base_proyecto}")

if __name__ == "__main__":
    # Nombre fijo para evitar problemas de input/terminal
    mi_nombre = "ProyectoFlask01"
    crear_estructura(mi_nombre)