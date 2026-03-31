frutas = ["manzanas","bananas","cerezas"] 

for fruta in frutas:
 	print(fruta)

  
for i in range(5): # Esto repetirá el bloque de código 5 veces
	print("Python es incredible")
 
 
contador = 1
while contador <= 5:
    print(contador)
    contador += 1
    
numeros = [1, 3, 5, 7, 9, 2, 4, 6, 8, 10]
for numero in numeros:
    if numero % 2 == 0: # Verifica si el numero es par
        print("Se encontro el primer numero par: ", numero)
        break # Termina el bucle    

print("Numeros impares entre 1 al 11")        
for numero in range(1, 11):
    if numero % 2 == 0: # Verifica si el numero es par
        continue # Salta al siguiente numero sin ejecutar las líneas siguientes
    print(numero) # Esto sólo se ejecutará para numeros impares        