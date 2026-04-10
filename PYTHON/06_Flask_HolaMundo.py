#EL AMBIENTE VIRTUAL venv_python DEBE ESTAR ACTIVATE
from flask import Flask

app = Flask(__name__)     # CREA UN OBJETO Flask con el parametro __name__

@app.route("/")         # En navegdor http://127.0.0.1:5000
def hello_world():
    return "¡Hola, mundo!"   # Lo dibuja en navegador

@app.route("/nosotros")  # En navegador http://127.0.0.1:5000/nosotros
def nosotros():
    # Aquí devolvemos la información de nostros y lo pinta en nueva pagina , segun el HTML siguiente.
    return """
    <h1>Sobre Nosotros Los mejores </h1>
    <ul>
        <li><strong>Empresa:</strong> eFUNDAE Corp</li>
        <li><strong>Teléfono:</strong> +34 900 000 000</li>
        <li><strong>Contacto:</strong> contacto@ejemplo.com</li>
    </ul>
    <a href="/">Volver al inicio</a>
    """
    

if __name__ == "__main__":
    # debug=True permite que el servidor se reinicie solo al guardar cambios
    app.run(debug=True, port=5000) # Cambiamos al puerto 5001 si no encuentra /nosotros
    