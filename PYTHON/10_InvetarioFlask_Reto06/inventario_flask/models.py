from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

class Producto(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    codigo = db.Column(db.String(20), unique=True, nullable=False)
    descripcion = db.Column(db.String(100), nullable=False)
    costo = db.Column(db.Float, default=0.0)
    entradas = db.Column(db.Integer, default=0)
    salidas = db.Column(db.Integer, default=0)

    @property
    def stock_actual(self):
        return self.entradas - self.salidas

    @property
    def valor_inventario(self):
        return self.stock_actual * self.costo