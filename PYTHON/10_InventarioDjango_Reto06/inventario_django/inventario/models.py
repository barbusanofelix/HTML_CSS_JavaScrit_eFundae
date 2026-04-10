from django.db import models

class Producto(models.Model):
    codigo = models.CharField(max_length=20, unique=True)
    descripcion = models.CharField(max_length=100)
    costo = models.DecimalField(max_digits=10, decimal_places=2)
    entradas = models.PositiveIntegerField(default=0)
    salidas = models.PositiveIntegerField(default=0)

    @property
    def stock_actual(self):
        return self.entradas - self.salidas

    @property
    def valor_inventario(self):
        return float(self.costo) * self.stock_actual

    def __str__(self):
        return self.descripcion


# from django.db import models   # Importas el módulo de Django que contiene todas las herramientas para interactuar con bases de datos.

# # Create your models here.

# # Aquí defines tu tabla. Al heredar de models.Model, Django entiende que esta clase debe convertirse en una tabla de SQLite.
# class Producto(models.Model):
#     # Campo string, con max longitud de 20 y debe ser unique.                                                              
#     codigo = models.CharField(max_length=20, unique=True)   
#     # descripcion es campo texto, con max cantidad de caracteres = 100                      
#     descripcion = models.CharField(max_length=100)
#     # costo: Campo decimal con 2 decimales y 10 digitos en total ( cuenta los decimales) 
#     costo = models.DecimalField(max_digits=10, decimal_places=2, default=0.00)
#     # Campos para números enteros que no permiten valores negativos. El default=0 asegura que, si no pones nada, el conteo empiece en cero.
#     entradas = models.PositiveIntegerField(default=0)
#     salidas = models.PositiveIntegerField(default=0)

#     # Propiedades Calculadas (@property)
#     # Estas no son columnas en la base de datos, sino funciones que se comportan como si fueran atributos. Son muy útiles porque se calculan "al vuelo":
#     # @property: Es un decorador de Python que te permite llamar a la función como si fuera una variable (usarías producto.stock_actual en lugar de producto.stock_actual()).
#     # stock_actual: Simplemente resta las salidas de las entradas para decirte cuánto hay en bodega.

#     @property
#     def stock_actual(self):
#         return self.entradas - self.salidas

#     # valor_inventario: Multiplica el stock por el costo.
#     @property
#     def valor_inventario(self):
#         # a veces python se queja al multiplicar un entero x float y por eso convertimos ambos a float
#         return float(self.stock_actual) * float(self.costo)

#     def __str__(self):
#         return f"{self.codigo} - {self.descripcion}"
    
    
# # Nota técnica: Usas float(self.costo) porque DecimalField devuelve un objeto tipo Decimal, y para operaciones matemáticas rápidas a veces se prefiere convertirlo, aunque en Django # financiero es más seguro operar directamente con Decimal

