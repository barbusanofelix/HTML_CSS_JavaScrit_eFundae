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