using Microsoft.AspNetCore.Mvc;
using ToDoApp.Models; // Importamos nuestro modelo
using Microsoft.EntityFrameworkCore; // <--- ESTA ES LA QUE FALTA

namespace ToDoApp.Controllers;

public class TareaController : Controller
{
    // Creamos una lista en memoria para guardar las tareas temporalmente
    // Al ser "static", se mantiene viva mientras la app esté corriendo
    // private static List<Tarea> _tareas = new List<Tarea>();
    //*******************************************************
    // SUSTITUIMOS: private static List<Tarea> _tareas = ...
    // POR:
    private readonly ApplicationDbContext _context;

    // Para la Base de datos añadimos este constructor que recibe la base de datos
    public TareaController(ApplicationDbContext context)
    {
        _context = context;
    }
    //*********************************************************
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
        IEnumerable<Tarea> tareasFiltradas = _context.Tareas;

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
            // 1. Lógica para guardar el archivo (Se mantiene IGUAL)
            if (archivoAdjunto != null && archivoAdjunto.Length > 0)
            {
                string nombreUnico = Guid.NewGuid().ToString() + "_" + archivoAdjunto.FileName;
                string rutaCarpeta = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads");
                string rutaCompleta = Path.Combine(rutaCarpeta, nombreUnico);

                using (var stream = new FileStream(rutaCompleta, FileMode.Create))
                {
                    archivoAdjunto.CopyTo(stream);
                }
                nuevaTarea.RutaAdjunto = nombreUnico;
            }

            // 2. Guardar la tarea
            // ELIMINADO: nuevaTarea.Id = _tareas.Count + 1; (Ya no hace falta)

            _context.Tareas.Add(nuevaTarea); // Añadimos al contexto
            _context.SaveChanges();          // Impactamos la base de datos

            return RedirectToAction("Index");
        }
        return View(nuevaTarea);
    }

    public IActionResult MarcarComoCompletada(int id)
    {
        var tarea = _context.Tareas.FirstOrDefault(t => t.Id == id);

        if (tarea != null)
        {
            tarea.EstaCompletada = !tarea.EstaCompletada;

            if (tarea.EstaCompletada)
            {
                tarea.FechaCulminacion = DateTime.Now;
            }
            else
            {
                // Opcional: limpiar la fecha si el usuario la desmarca
                tarea.FechaCulminacion = null;
            }

            // --- LAS LÍNEAS QUE FALTAN ---
            _context.Tareas.Update(tarea); // Le decimos al contexto que esta tarea cambió
            _context.SaveChanges();        // Le decimos a la base de datos: "¡Escribe los cambios ahora!"
                                           // -----------------------------
        }

        return RedirectToAction("Index");
    }
    // EDITAR REGISTROS
    // 1. Mostrar el formulario con los datos actuales (GET)
    public IActionResult Editar(int id)
    {
        var tarea = _context.Tareas.FirstOrDefault(t => t.Id == id);
        if (tarea == null) return NotFound();

        return View(tarea); // Le pasamos la tarea encontrada a la vista
    }

    // 2. Recibir los cambios y guardarlos (POST)
    [HttpPost]
    public IActionResult Editar(Tarea tareaEditada, IFormFile? nuevoAdjunto)
    {
        if (ModelState.IsValid)
        {
            // Buscamos la tarea actual en la DB para no perder la ruta del adjunto viejo si no sube uno nuevo
            var tareaEnDb = _context.Tareas.AsNoTracking().FirstOrDefault(t => t.Id == tareaEditada.Id);
            if (tareaEnDb == null) return NotFound();

            if (nuevoAdjunto != null && nuevoAdjunto.Length > 0)
            {
                // 1. Borrar la imagen vieja del disco si existe
                if (!string.IsNullOrEmpty(tareaEnDb.RutaAdjunto))
                {
                    string rutaVieja = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads", tareaEnDb.RutaAdjunto);
                    if (System.IO.File.Exists(rutaVieja))
                    {
                        System.IO.File.Delete(rutaVieja);
                    }
                }

                // 2. Guardar la nueva imagen (tu código actual)
                string nombreUnico = Guid.NewGuid().ToString() + "_" + nuevoAdjunto.FileName;
                string rutaNueva = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads", nombreUnico);
                using (var stream = new FileStream(rutaNueva, FileMode.Create))
                {
                    nuevoAdjunto.CopyTo(stream);
                }
                tareaEditada.RutaAdjunto = nombreUnico;
            }

            _context.Tareas.Update(tareaEditada); // EF actualiza todos los campos automáticamente
            _context.SaveChanges();

            return RedirectToAction("Index");
        }
        return View(tareaEditada);
    }
    public IActionResult Borrar(int id)
    {
        var tarea = _context.Tareas.Find(id); // Buscamos en DB

        if (tarea != null)
        {
            // Borrado de archivo físico (Se mantiene IGUAL)
            if (!string.IsNullOrEmpty(tarea.RutaAdjunto))
            {
                string rutaArchivo = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads", tarea.RutaAdjunto);
                if (System.IO.File.Exists(rutaArchivo)) System.IO.File.Delete(rutaArchivo);
            }

            _context.Tareas.Remove(tarea); // Borramos de la DB
            _context.SaveChanges();
        }

        return RedirectToAction("Index");
    }


}