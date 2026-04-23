// See https://aka.ms/new-console-template for more information
Console.WriteLine("Hello, World! Nueva  prueba1 y ahora si se actualiza");

Console.WriteLine("--- BIENVENIDO AL SISTEMA ---");

// Declaración de variables
string nombreUsuario;
int edad;

// Pedir datos
Console.Write("Introduce tu nombre: ");
nombreUsuario = Console.ReadLine();

Console.Write("Introduce tu edad: ");
// Convertimos el texto de la terminal a un número entero
edad = int.Parse(Console.ReadLine());

// Mostrar resultado usando "Interpolación de cadenas" (el signo $)
Console.WriteLine($"Hola {nombreUsuario}, el año que viene tendrás {edad + 1} años.");
