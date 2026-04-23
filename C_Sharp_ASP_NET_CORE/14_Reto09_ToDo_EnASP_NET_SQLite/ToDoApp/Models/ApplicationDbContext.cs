using Microsoft.EntityFrameworkCore;

namespace ToDoApp.Models
{
    public class ApplicationDbContext : DbContext
    {
        public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options)
            : base(options)
        {
        }

        // Esta propiedad se convertirá en nuestra tabla de Base de Datos
        public DbSet<Tarea> Tareas { get; set; }
    }
}