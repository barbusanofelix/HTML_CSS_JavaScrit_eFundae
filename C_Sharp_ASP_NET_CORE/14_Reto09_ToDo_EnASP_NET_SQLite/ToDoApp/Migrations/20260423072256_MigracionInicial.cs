using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ToDoApp.Migrations
{
    /// <inheritdoc />
    public partial class MigracionInicial : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Tareas",
                columns: table => new
                {
                    Id = table.Column<int>(type: "INTEGER", nullable: false)
                        .Annotation("Sqlite:Autoincrement", true),
                    Titulo = table.Column<string>(type: "TEXT", nullable: false),
                    AsignadoA = table.Column<string>(type: "TEXT", nullable: true),
                    FechaVencimiento = table.Column<DateTime>(type: "TEXT", nullable: false),
                    Lugar = table.Column<string>(type: "TEXT", nullable: true),
                    Direccion = table.Column<string>(type: "TEXT", nullable: true),
                    Notas = table.Column<string>(type: "TEXT", nullable: true),
                    EstaCompletada = table.Column<bool>(type: "INTEGER", nullable: false),
                    FechaCulminacion = table.Column<DateTime>(type: "TEXT", nullable: true),
                    RutaAdjunto = table.Column<string>(type: "TEXT", nullable: true),
                    RequiereRecordatorio = table.Column<bool>(type: "INTEGER", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Tareas", x => x.Id);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Tareas");
        }
    }
}
