class NombreDeLaClase:
    # Atributos de clase (estándar para todos)
    atributo1 = "Valor de Clase dado a atributo 1"
    atributo2 = "Valor de Clase dado a atributo 2"

    def __init__(self, parametro1, parametro2):
        # Atributos de instancia (únicos para este objeto)
        #self.atributo1 = parametro1
        #self.atributo2 = parametro2
       pass   # si queremos dejar el constructor vacio.
        
    def metodo(self, valor):
        return f"El valor del parametro recibido fue :{valor}"    
    


# 1. Creamos un objeto con valores específicos
objeto_personalizado = NombreDeLaClase("Dato A", "Dato B")

# 2. Pruebas de impresión
print("--- Valores del Objeto ---")
print(f"Atributo 1 del objeto: {objeto_personalizado.atributo1}")
print(f"Atributo 2 del objeto: {objeto_personalizado.atributo2}")

print("\n--- Valores Originales de la Clase ---")
# Accedemos a la clase directamente, no al objeto
# aunque en el constructor __init__ se reciben parametros al pedir los 
# atributos de clase muestra los valores que se definieron en la clase.
print(f"Atributo 1 original: {NombreDeLaClase.atributo1}")  # NombredeLaClase es el nombre de la clase.
print(f"Atributo 2 original: {NombreDeLaClase.atributo2}")

print("Usemos la funcion llamada metdo ")
print(objeto_personalizado.metodo(10))

print(f"Veamos que hay en objeto usando el diccionario {objeto_personalizado.__dict__}")


class Coche:
    ruedas=4  # atributo de clase
    
    def __init__(self, marca, modelo, año):
        self.marca = marca
        self.modelo = modelo
        self.año = año  # Ahora sí está asignado
        
    @classmethod
    def cantidadRuedad(cls):
        return f"La cantidad de ruedas de la clase es {cls.ruedas}"    
    
    @staticmethod
    def esVehiculo():
        print("Si, es un vehículo")    
        
    @staticmethod
    def esAñoValido(año):
        # Un método estático no usa 'self'
        return 1886 <= año <= 2030        

    # Vamos a añadir un método para probarlo
    def describir(self):
        return f"Este coche es un {self.marca} {self.modelo} del año {self.año}."
    
    def mostrarInfo(self):
        return f"Coche {self.marca} -- modelo {self.modelo}"

# --- Prueba de la instancia ---
miCoche = Coche("Toyota", "Corolla", 2024)
print(miCoche.describir())

# Atributo de clase
print(f"Ruedas del objeto miCoche es : {miCoche.ruedas}")

print(f"Tambien se puede ver las ruedas por la clase : {Coche.ruedas}")

# llamar al metodo mostrarInfo
print(miCoche.mostrarInfo())

# Uso de un metodo de la clase.
# Aunque se puede llamar por el objeto , lo mejor es llamar el metodo de clase por la clase.
print("LLamando el metodo de clase por la instancia: ", miCoche.cantidadRuedad())

# LLamando el metodo por la Clase Coche.
print("LLamando el metodo de clase por la misma clase : ", Coche.cantidadRuedad())

print("")
print("Usar metodos estaticos")
Coche.esVehiculo()

print(f"El año del coche es valido? : {Coche.esAñoValido(2024)}")


modulo=__name__

print("El modulo es : ", modulo)