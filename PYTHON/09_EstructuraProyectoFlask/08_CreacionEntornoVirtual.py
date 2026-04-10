import os
import subprocess
import sys

def configurar_env(nombre_env):
    print(f"--- Creando el entorno virtual: {nombre_env} ---")
    
    # 1. Crear el entorno virtual
    # Esto equivale a ejecutar: python -m venv nombre_env
    subprocess.run([sys.executable, "-m", "venv", nombre_env])
    print(f"✔ Entorno {nombre_env} creado.")

    # 2. Determinar la ruta del ejecutable de pip dentro del entorno
    # En Windows es: nombre_env/Scripts/pip.exe
    pip_path = os.path.join(nombre_env, "Scripts", "pip.exe")

    print(f"--- Instalando Flask en {nombre_env} ---")
    
    # 3. Instalar Flask usando el pip del entorno virtual
    # Usamos subprocess para ejecutar el comando
    # flask-sqlalchemy maneja mejor sqlite
    try:
        subprocess.run([pip_path, "install", "flask-sqlalchemy"], check=True)
        print("✔ Flask instalado correctamente.")
    except Exception as e:
        print(f"❌ Error al instalar Flask: {e}")

if __name__ == "__main__":
# ! AQUI PONEMOS EL NOMBRE QUE QUEREMOS DEL ENTORNO VIRTUAL
# ? CAMBIE EL INPUT POR ASIGNARLO DIRECTAMENTE AQUI , PORQUE VS CODE GENERABA ERROR     
    nombre_entorno_virtual = "venv_inv_flask" # Nombre por defecto. EL 08 PARA QUE SEA EL NUMERO DEL PROGRAMA.
    # nombre = input("¿Qué nombre quieres para tu entorno virtual? (ej. venv): ")
    configurar_env(nombre_entorno_virtual)
    print("\n--- ¡LISTO! ---")
    print(f"Para empezar a trabajar, recuerda activarlo manualmente con: {nombre_entorno_virtual}\\Scripts\\activate")
    #print(f"{nombre}\\Scripts\\activate")