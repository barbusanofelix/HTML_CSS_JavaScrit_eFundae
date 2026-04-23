using Microsoft.AspNetCore.Mvc;
using ToDoApp.Models; // Importamos nuestro modelo

namespace ToDoApp.Controllers;

public class TareaController : Controller
{
    // Creamos una lista en memoria para guardar las tareas temporalmente
    // Al ser "static", se mantiene viva mientras la app esté corriendo
    private static List<Tarea> _tareas = new List<Tarea>();

    // Acción para listar las tareas (INDEX)
    // public IActionResult Index()
    // {
    //     // Ordenamos por fecha de vencimiento antes de enviar a la vista
    //     var tareasOrdenadas = _tareas.OrderBy(t => t.FechaVencimiento).ToList();

    //     // Pasamos la lista a la Vista
    //     return View(tareasOrdenadas);
    // }

    public IActionResult Index(string filtro, string orden)
    {
        // Empezamos con todas las tareas
        IEnumerable<Tarea> tareasFiltradas = _tareas;

        // 1. Lógica de Filtrado
        switch (filtro)
        {
            case "activas":
                tareasFiltradas = tareasFiltradas.Where(t => !t.EstaCompletada);
                break;
            case "completadas":
                tareasFiltradas = tareasFiltradas.Where(t => t.EstaCompletada);
                break;
        }

        // 2. Lógica de Orden original
        // tareasFiltradas = orden switch
        // {
        //     "nombre" => tareasFiltradas.OrderBy(t => t.Titulo),
        //     "persona" => tareasFiltradas.OrderBy(t => t.AsignadoA),
        //     _ => tareasFiltradas.OrderBy(t => t.FechaVencimiento) // Por defecto: Fecha
        // };


        // 2. Lógica de Orden con "Desempatador" ( Ordena por 2 criterios )
        tareasFiltradas = orden switch
        {
            // Ordena por Título; si son iguales, ordena por Fecha de Vencimiento
            "nombre" => tareasFiltradas.OrderBy(t => t.Titulo).ThenBy(t => t.FechaVencimiento),

            // Ordena por Persona; si son iguales, ordena por Fecha de Vencimiento
            "persona" => tareasFiltradas.OrderBy(t => t.AsignadoA).ThenBy(t => t.FechaVencimiento),

            // Por defecto: solo por Fecha de Vencimiento
            _ => tareasFiltradas.OrderBy(t => t.FechaVencimiento)
        };

        // Guardamos los valores actuales para que los selectores en la vista no se reseteen
        ViewBag.FiltroActual = filtro;
        ViewBag.OrdenActual = orden;

        return View(tareasFiltradas.ToList());
    }


    // Acción para mostrar el formulario de creación (GET)
    public IActionResult Crear()
    {
        return View();
    }

    // Acción para recibir los datos del formulario y guardarlos (POST)
    // Metodo original sin incorporar la adicion de documentos
    // [HttpPost]
    // public IActionResult Crear(Tarea nuevaTarea)
    // {
    //     if (ModelState.IsValid)
    //     {
    //         // Asignamos un ID sencillo basado en el conteo
    //         nuevaTarea.Id = _tareas.Count + 1;

    //         _tareas.Add(nuevaTarea);

    //         // Al terminar, volvemos al listado
    //         return RedirectToAction("Index");
    //     }

    //     // Si hay errores (ej: falta el título), volvemos a mostrar el formulario
    //     return View(nuevaTarea);
    // }

    // Acción para marcar como completada
    // Recibimos el ID de la tarea que queremos modificar
    // Importante : Al crear un archivoAdjunto IFormFile debe definirse con ? para que permita que sea vacio ...Sino no deja grabar el formulario
    [HttpPost]
    public IActionResult Crear(Tarea nuevaTarea, IFormFile? archivoAdjunto)
    {
        if (ModelState.IsValid)
        {
            // 1. Lógica para guardar el archivo si el usuario subió uno
            if (archivoAdjunto != null && archivoAdjunto.Length > 0)
            {
                // Creamos un nombre único para el archivo para que no se sobrescriban
                string nombreUnico = Guid.NewGuid().ToString() + "_" + archivoAdjunto.FileName;

                // Definimos la ruta física donde se guardará (wwwroot/uploads)
                string rutaCarpeta = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads");
                string rutaCompleta = Path.Combine(rutaCarpeta, nombreUnico);

                // Guardamos el archivo físicamente
                using (var stream = new FileStream(rutaCompleta, FileMode.Create))
                {
                    archivoAdjunto.CopyTo(stream);
                }

                // Guardamos el NOMBRE del archivo en nuestra Tarea
                nuevaTarea.RutaAdjunto = nombreUnico;
            }

            // 2. Guardar la tarea (lo que ya hacíamos)
            nuevaTarea.Id = _tareas.Count + 1;
            _tareas.Add(nuevaTarea);

            return RedirectToAction("Index");
        }
        return View(nuevaTarea);
    }

    public IActionResult MarcarComoCompletada(int id)
    {
        // Buscamos la tarea en nuestra lista estática por su ID
        var tarea = _tareas.FirstOrDefault(t => t.Id == id);

        if (tarea != null)
        {
            // Cambiamos el estado al contrario del que tenga
            tarea.EstaCompletada = !tarea.EstaCompletada;

            // Si se completa, guardamos la fecha de hoy
            if (tarea.EstaCompletada)
            {
                tarea.FechaCulminacion = DateTime.Now;
            }
        }

        // Regresamos al listado para ver el cambio
        return RedirectToAction("Index");
    }
    // EDITAR REGISTROS
    // 1. Mostrar el formulario con los datos actuales (GET)
    public IActionResult Editar(int id)
    {
        var tarea = _tareas.FirstOrDefault(t => t.Id == id);
        if (tarea == null) return NotFound();

        return View(tarea); // Le pasamos la tarea encontrada a la vista
    }

    // 2. Recibir los cambios y guardarlos (POST)
    [HttpPost]
    public IActionResult Editar(Tarea tareaEditada, IFormFile? nuevoAdjunto)
    {
        if (ModelState.IsValid)
        {
            var tareaOriginal = _tareas.FirstOrDefault(t => t.Id == tareaEditada.Id);

            if (tareaOriginal != null)
            {
                // Actualizamos los campos uno a uno
                tareaOriginal.Titulo = tareaEditada.Titulo;
                tareaOriginal.AsignadoA = tareaEditada.AsignadoA;
                tareaOriginal.FechaVencimiento = tareaEditada.FechaVencimiento;
                tareaOriginal.Lugar = tareaEditada.Lugar;
                tareaOriginal.Direccion = tareaEditada.Direccion;
                tareaOriginal.Notas = tareaEditada.Notas;

                // Lógica para el adjunto (si sube uno nuevo, reemplazamos el anterior)
                if (nuevoAdjunto != null && nuevoAdjunto.Length > 0)
                {
                    // (Opcional) Aquí podrías borrar el archivo anterior físicamente
                    string nombreUnico = Guid.NewGuid().ToString() + "_" + nuevoAdjunto.FileName;
                    string ruta = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads", nombreUnico);

                    using (var stream = new FileStream(ruta, FileMode.Create))
                    {
                        nuevoAdjunto.CopyTo(stream);
                    }
                    tareaOriginal.RutaAdjunto = nombreUnico;
                }
            }
            return RedirectToAction("Index");
        }
        return View(tareaEditada);
    }
public IActionResult Borrar(int id)
  {
    // 1. Buscar la tarea
    var tarea = _tareas.FirstOrDefault(t => t.Id == id);

    if (tarea != null)
    {
        // 2. Si tiene un archivo adjunto, hay que borrarlo del disco duro
        if (!string.IsNullOrEmpty(tarea.RutaAdjunto))
        {
            string rutaArchivo = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads", tarea.RutaAdjunto);
            
            if (System.IO.File.Exists(rutaArchivo))
            {
                System.IO.File.Delete(rutaArchivo);
            }
        }

        // 3. Borrar la tarea de la lista
        _tareas.Remove(tarea);
    }

    return RedirectToAction("Index");
  }  


}