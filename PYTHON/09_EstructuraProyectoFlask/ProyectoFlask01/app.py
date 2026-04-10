from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def index():
   # return '<h1>Proyecto: ProyectoFlask01</h1>'
   # Flask busca automáticamente dentro de la carpeta "templates"
    return render_template("index.html")

@app.route('/nosotros')
def nosotros():
    # Aquí podrías cargar otro HTML diferente
    return "<h2>Página de nosotros (todavía en texto)</h2><a href='/'>Volver</a>"

if __name__ == '__main__':
    app.run(debug=True, port=5001)
