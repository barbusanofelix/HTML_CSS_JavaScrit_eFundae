from flask import Flask, render_template, request, redirect, url_for
from models import db, Producto

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///inventario.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False # Recomendado para evitar avisos
db.init_app(app)

# Crear la base de datos al iniciar
with app.app_context():
    db.create_all()

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/reporte')
def reporte():
    productos = Producto.query.all()
    # Calculamos totales para el reporte global
    total_valor_almacen = sum(p.valor_inventario for p in productos)
    return render_template('reporte.html', productos=productos, total=total_valor_almacen)

@app.route('/movimiento', methods=['POST'])
def movimiento():
    codigo = request.form.get('codigo')
    tipo = request.form.get('tipo')  # 'entrada' o 'salida'
    cantidad = int(request.form.get('cantidad'))
    
    prod = Producto.query.filter_by(codigo=codigo).first()
    if prod:
        if tipo == 'entrada':
            prod.entradas += cantidad
        elif tipo == 'salida':
            prod.salidas += cantidad
        db.session.commit()
    return redirect(url_for('reporte'))

@app.route('/crear_producto', methods=['POST'])
def crear_producto():
    codigo = request.form.get('codigo')
    descripcion = request.form.get('descripcion')
    costo = float(request.form.get('costo'))
    
    # Verificamos si ya existe para no duplicar
    existe = Producto.query.filter_by(codigo=codigo).first()
    if not existe:
        nuevo_p = Producto(codigo=codigo, descripcion=descripcion, costo=costo, entradas=0, salidas=0)
        db.session.add(nuevo_p)
        db.session.commit()
    
    return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)