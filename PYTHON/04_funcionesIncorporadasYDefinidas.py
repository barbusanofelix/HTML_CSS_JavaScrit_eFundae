
a=8
b=9


# Definicion de funcion ( def + [nombre funcion] + ( parametros ))
def suma(a,b):
    return a+b

resultado = suma(a,b)
print("La suma de a + b :", resultado)


# FUNCIONES INCORPORADAS ( Las propias de python)
# Ejemplo:
print("print es una funcion incorporada")

palabra = "Barquisimeto"
longitudPalabra = len(palabra)

print("Con len se determina la cantidad de elementos. La palabra ", palabra, " tiene  ", longitudPalabra, " caracteres")

# Funcion type
num = 42
VarString = "Felix"
VarBoleano = True 

print("El tipo del numero 42 es", type(num)) # Salida: <class “int”>
print("En un string el type es: ", type(VarString))
print("El tipo de un booleano es ", type(VarBoleano))

# Funcion incorporada range()
print("Imprimir numeros de 0 a 4 , usando range(5)")
print("")
for i in range(5):
    print(i) # imprime los números del 0 al 4
print("")
print("")
print("Conteo desde 2 a 20 , brincando 5 ")
    


for i in range(2,20,5):
    print(i) # imprime los números del 0 al 4
    
    
    