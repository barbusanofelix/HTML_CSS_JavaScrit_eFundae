
// ¿Qué demuestra este código?
// El "Efecto Espejo": Al hacer Persona p2 = p1;, no creaste una persona nueva. Creaste un segundo "control remoto" para la misma persona. Por eso, al cambiar p2.Nombre, p1.Nombre también cambió. Esto nunca pasaría con un int o un bool (tipos de valor).

// Strings: Aunque string es referencia, C# lo hace parecer valor por seguridad (inmutabilidad), pero internamente vive en el Heap.

// Colecciones: El array numeros1 se ve afectado por numeros2 porque el array vive en el Heap y ambos nombres apuntan a esa misma lista de números.

// Interfaz y Object: Son formas de referenciar a tus objetos. objetoCualquiera apunta a la misma Ana/Beatriz que p1.

// Un experimento para ti:
// Si en el código anterior añades p1 = null; y luego intentas hacer Console.WriteLine(p1.Nombre);, el programa explotará con un NullReferenceException. Esto es porque borraste la dirección del "control remoto" y ya no puede llegar al objeto en el Heap.




using System;
using System.Collections.Generic;

// 4. INTERFAZ
interface IInformacion { void Mostrar(); }

// 1. CLASE
class Persona : IInformacion {
    public string Nombre { get; set; } // 2. STRING (dentro de la clase)
    public void Mostrar() => Console.WriteLine($"Nombre: {Nombre}");
}

// 5. DELEGADO (Referencia a un método)
delegate void MiDelegado(string mensaje);

class Program {
    static void Main() {
        Console.WriteLine("---            DEMOSTRACIÓN DE TIPOS DE REFERENCIA       ---");
        Console.WriteLine("--- Ejemplo con igualacion de instancias de Clase Persona ---");


        // 1 y 2. CLASE y STRING
        Persona p1 = new Persona { Nombre = "Ana" };
        Console.WriteLine($"El nombre original de P1 es: {p1.Nombre}");
        
        Persona p2 = p1; // p2 apunta a la MISMA dirección que p1
        Console.WriteLine($"Igualamos a p2=P1, donde p1.nombre es Ana y P2.nombre ahora es : {p2.Nombre}");

        p2.Nombre = "Beatriz"; // Cambiamos p2...
        Console.WriteLine($"Ahora le asignamos a p2.nombre = Beatriz y ya vimos que p2.nombre y p1.nombre eran Ana");
        Console.WriteLine($"¿P1 cambió?...SI, cambio!!! Ahora p1.nombre es : {p1.Nombre}, es p1.Nombre=p2.Nombre :{p1.Nombre == p2.Nombre}"); // ¡P1 ahora es Beatriz! (Demuestra referencia)
        Console.WriteLine("Con el ejemplo anterior se demostró que se hace referencia al mismo objeto en la Memoria");

        // 3. ARREGLO (Array)
        Console.WriteLine("--- Ejemplo con Array ---");
        Console.WriteLine("--- Se crea el array1, llamado numeros1 , con valores {1,2,3} y se crea array2, llamado numeros2 que se iguala a numeros1 ---"); 
        int[] numeros1 = { 1, 2, 3 };
        int[] numeros2 = numeros1;
        Console.WriteLine($"Los array son numeros1: {string.Join(", ",numeros1)}  y numeros2: {string.Join(", ",numeros2)}");
        numeros2[0] = 99;
        Console.WriteLine($"Le asignamos 99 a la primera posicion de numero2 que ahora es:{string.Join(", ", numeros2)}, sin tocar a numero1");
        Console.WriteLine($"¿Numeros1[primera posicion] cambió?...Si cambió y ahora es : {numeros1[0]}, de hecho ahora numeros1 es {string.Join(", ", numeros1)}"); // Muestra 99

        // 4. INTERFAZ
        Console.WriteLine("--- Ejemplo con Interfaz ---");
        // ¿ Qué es realmente una Interface? 
        // Imagina que la interface es un contrato legal. No es una persona, ni un objeto; es solo un documento que dice: "Cualquier clase que firme este contrato está OBLIGADA a tener un método llamado Mostrar()".

        // La interface no sabe cómo se muestra la información.

        // Solo garantiza que el método existe.

        // Análisis de tu ejemplo (El "Disfraz" de Referencia)
        // En el código hicimos esto:

        // C#
        // IInformacion miInterfaz = p1; 
        // Aquí no estás creando un objeto nuevo. Lo que estás haciendo es ponerle un "disfraz" a p1.

        // Referencia compartida: miInterfaz apunta a la misma dirección de memoria en el Heap donde vive Beatriz. Por eso, si Beatriz cambia de nombre, la interfaz mostrará el nuevo nombre.

        // Restricción de vista: Esta es la parte clave. Aunque p1 (Beatriz) tenga muchas otras cosas (edad, dirección, otros métodos), a través de miInterfaz solo puedes ver lo que el contrato permite (el método Mostrar()).

        //Vamos a desglosarlo con la analogía del disfraz y la del título profesional, que suelen aclarar mucho este concepto de polimorfismo.

// 1. ¿Qué sucede realmente en esa línea?
// Cuando escribes IInformacion miInterfaz = p1;, no estás creando un objeto nuevo en el Heap. Solo estás creando una nueva variable en el Stack (el "control remoto").

// p1 es un control remoto que tiene botones para TODO lo que una Persona puede hacer (Nombre, Edad, Correr, Caminar, Mostrar).

// miInterfaz es un control remoto que solo tiene el botón Mostrar(), porque eso es lo único que dice el contrato IInformacion.

// 2. La analogía del "Disfraz" o el "Rol"
// Imagina que tú eres una persona real (el objeto en el Heap). Tienes muchas habilidades: sabes cocinar, conducir, programar y bailar.

// Si yo te llamo como "Amigo" (Persona p1), puedo pedirte cualquier cosa.

// Pero si tú te pones el "Disfraz de Conductor" (IEnchufable o en nuestro caso IInformacion), para el resto del mundo, en ese momento, tú solo eres un conductor.

// Si yo te trato como miInterfaz (conductor), solo puedo decirte "¡Conduce!". No puedo decirte "¡Cocina!", aunque yo sepa que tú sabes cocinar. El "disfraz" (la interfaz) limita lo que yo puedo pedirte, pero tú sigues siendo la misma persona completa en la memoria.

// 3. ¿Por qué apunta a Beatriz? (El efecto espejo)
// Como miInterfaz apunta a la misma dirección de memoria que p1:

// Si tú (p1) te cambias el nombre de Ana a Beatriz...

// Cuando yo te pida como miInterfaz que te identifiques (Mostrar()), tú me vas a decir "Soy Beatriz".

// No hay dos Beatriz. Hay una sola Beatriz en el Heap, siendo observada por dos variables distintas: una que ve todo (p1) y otra que solo ve lo que dicta el contrato (miInterfaz).

// 4. ¿Para qué sirve esto en la práctica?
// Imagina que tienes una lista de muchas cosas diferentes: una Persona, un Perro y un Robot.

// La Persona tiene nombre.

// El Perro tiene raza.

// El Robot tiene número de serie.

// Si los tres firman el contrato IInformacion, tú puedes crear una lista de tipo List<IInformacion>. Podrás recorrer la lista y decirle a todos: "¡Mostrar!".

// No necesitas saber si es un perro o un robot; el "disfraz" te asegura que el botón Mostrar() existe y funcionará.

// En resumen:
// La línea IInformacion miInterfaz = p1; hace dos cosas:

// Crea una referencia (puntero) llamada miInterfaz.

// La apunta al objeto que ya existía en p1.

// Le pone un filtro: A través de miInterfaz, el compilador de C# te prohibirá usar cualquier cosa de p1 que no esté en la interfaz.


        IInformacion miInterfaz = p1;
        miInterfaz.Mostrar();

        // 5. DELEGADO
        //**************************************************************
//         Imagina que un Delegado es como un Contenedor de Instrucciones o un "Cupón de Acción".

// Paso 1: La Definición (Crear el molde)
// delegate void MiDelegado(string mensaje);

// Aquí no has creado nada que "funcione" todavía. Solo has definido una regla de compatibilidad. Es como si estuvieras diseñando un enchufe específico:

// void: "La función que metas aquí no debe devolver nada (solo hacer su trabajo)".

// (string mensaje): "La función que metas aquí debe aceptar obligatoriamente un texto".

// Paso 2: La Asignación (Elegir quién hace el trabajo)
// MiDelegado delegado = Console.WriteLine;

// Aquí es donde ocurre lo interesante. Console.WriteLine es un método que ya existe en C# y, curiosamente, cumple con tu regla: es void y recibe un string.

// ¿Qué pasa en la memoria? No estás ejecutando el WriteLine. Estás tomando la dirección de memoria (el puntero) de donde vive el código de WriteLine y la estás guardando en la variable llamada delegado.

// Ahora, la variable delegado es como un control remoto que ha sido "sintonizado" con el canal de Console.WriteLine.

// Paso 3: La Ejecución (Disparar la acción)
// delegado("Hola mundo");

// Cuando escribes esto, C# hace lo siguiente:

// Mira dentro de la variable delegado.

// Ve que tiene guardada la dirección de Console.WriteLine.

// Salta a esa dirección de memoria y ejecuta el código, pasándole el texto "Hola mundo".

// Es exactamente lo mismo que si hubieras escrito Console.WriteLine("Hola mundo"); directamente.


        //**************************************************************
        MiDelegado delegado = Console.WriteLine;
        delegado("Hola desde el delegado");

        // 6. OBJECT (El padre de todos) y DYNAMIC
        object objetoCualquiera = p1;
        dynamic dinamico = "Puedo ser lo que sea";
        Console.WriteLine($"Dinámico es: {dinamico}");

        // EXTRA: Verificando si apuntan al mismo sitio en el Heap
        bool mismaReferencia = object.ReferenceEquals(p1, p2);
        Console.WriteLine($"\n¿P1 y P2 comparten la misma memoria?: {mismaReferencia}");
    }
}
