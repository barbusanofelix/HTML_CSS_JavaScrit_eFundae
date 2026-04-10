
import os
import subprocess
import sys

def configurar_env(nombre_env):
    # --- PASO CLAVE: Obtener la ruta absoluta de la carpeta del script ---
    directorio_actual = os.path.dirname(os.path.abspath(__file__))
    ruta_completa_env = os.path.join(directorio_actual, nombre_env)
    
    print(f"--- Creando el entorno virtual en: {ruta_completa_env} ---")
    
    # 1. Crear el entorno virtual usando la ruta absoluta
    subprocess.run([sys.executable, "-m", "venv", ruta_completa_env])
    print(f"✔ Entorno '{nombre_env}' creado.")

    # 2. Determinar la ruta de pip.exe (Windows)
    # IMPORTANTE: Usamos la ruta completa para evitar confusiones
    pip_path = os.path.join(ruta_completa_env, "Scripts", "pip.exe")

    print(f"--- Instalando Flask en el entorno ---")
    
    # 3. Instalar Flask
    try:
        subprocess.run([pip_path, "install", "flask"], check=True)
        print("✔ Flask instalado correctamente dentro del entorno.")
    except Exception as e:
        print(f"❌ Error al instalar Flask: {e}")

    return ruta_completa_env

if __name__ == "__main__":
    # Asignación directa para evitar problemas con la terminal de VS Code
    nombre_entorno_virtual = "venv_inv_flask_reto06" 
    
    ruta_final = configurar_env(nombre_entorno_virtual)
    
    print("\n" + "="*30)
    print("      ¡PROCESO FINALIZADO!      ")
    print("="*30)
    print(f"Para activar el entorno, copia y pega esto en tu terminal:")
    print(f"{ruta_final}\\Scripts\\activate")