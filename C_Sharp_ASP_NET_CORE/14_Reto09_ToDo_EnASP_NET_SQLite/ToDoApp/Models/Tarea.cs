using System.ComponentModel.DataAnnotations;

namespace ToDoApp.Models;

public class Tarea
{
    // El ID es vital para que C# sepa cuál tarea editar o borrar más adelante
    public int Id { get; set; }

    [Required(ErrorMessage = "El título es obligatorio")]
    [Display(Name = "Qué tarea es?")]
    public string Titulo { get; set; } = string.Empty;

    [Display(Name = "Para quién es?")]
     // el ? permite que sea nulo y = string.Empty evita errores de sistema):
    // Sino se coloca el ? asume que el campo es Requerido en el formulario de entrada de datos
    public string? AsignadoA { get; set; } = string.Empty;

    [Display(Name = "Fecha de Vencimiento")]
    [DataType(DataType.DateTime)]
    public DateTime FechaVencimiento { get; set; }

    [Display(Name = "Lugar")]
     // el ? permite que sea nulo y = string.Empty evita errores de sistema):
    // Sino se coloca el ? asume que el campo es Requerido en el formulario de entrada de datos
    public string? Lugar { get; set; } = string.Empty;

    [Display(Name = "Dirección")]
     // el ? permite que sea nulo y = string.Empty evita errores de sistema):
    // Sino se coloca el ? asume que el campo es Requerido en el formulario de entrada de datos
    public string? Direccion { get; set; } = string.Empty;

    [Display(Name = "Notas adicionales")]
    // el ? permite que sea nulo y = string.Empty evita errores de sistema):
    // Sino se coloca el ? asume que el campo es Requerido en el formulario de entrada de datos
    public string? Notas { get; set; } = string.Empty;



    [Display(Name = "¿Está terminada?")]
    public bool EstaCompletada { get; set; } = false;

    [Display(Name = "Fecha de Culminación")]
    public DateTime? FechaCulminacion { get; set; }

    // Guardaremos la ruta del archivo o foto en el servidor
    public string? RutaAdjunto { get; set; }

    // Este campo nos ayudará a saber si hay que generar aviso
    public bool RequiereRecordatorio { get; set; }
}