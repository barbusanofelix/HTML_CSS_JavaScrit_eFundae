// Archivo corrido directo por la consola usando node
// Definimos la variable que servira de contador. Usual i
// Definimos hasta que numero lo repetira ( i<=5) , seran 5 veces: 1,2,3,4,5
// Definimos como se incrementa la i ( i++ , significa que tomara la i con el valor que llega, hace la operacion y luego la incrmenta...por ejemplo inicia con 1, imprime y la incrementa,

for (let i = 1; i <= 5; i++) {
  console.log(i);
}

let contador = 0;
while (contador < 3) {
  console.log("Hola!");
  contador++;
}

contador = 0; // Ya se definio arriba a si que le reasigno cero
do {
  console.log("A dios!");
  contador++;
} while (contador < 3);
