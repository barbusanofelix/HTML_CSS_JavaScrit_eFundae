import Libro from '../models/libroModel.js';

// GET - Obtener todos los libros
export const obtenerLibros = async (req, res) => {
    try {
        // Buscamos todos los libros en la BD
        const libros = await Libro.find();
        // Renderizamos la vista 'index' pasándole los libros encontrados
        res.render('index', { 
            title: 'Mi Biblioteca Personal',
            libros: libros 
        });
    } catch (error) {
        res.status(500).send('Error al obtener los libros');
    }
};

// POST - Crear un nuevo libro
export const crearLibro = async (req, res) => {
    try {
        // Extraemos los datos del formulario (req.body)
        const { titulo, autor, genero, fechaPublicacion } = req.body;
        
        // Creamos una nueva instancia del modelo
        const nuevoLibro = new Libro({
            titulo,
            autor,
            genero,
            fechaPublicacion
        });

        // Guardamos en MongoDB
        await nuevoLibro.save();
        
        // Al terminar, volvemos a la página principal
        res.redirect('/');
    } catch (error) {
        res.status(400).send('Error al guardar el libro: ' + error.message);
    }
};

// DELETE - Eliminar un libro por ID
export const eliminarLibro = async (req, res) => {
    try {
        const { id } = req.params; // Obtenemos el ID de la URL
        await Libro.findByIdAndDelete(id); // Borramos en MongoDB
        res.redirect('/'); // Refrescamos la página
    } catch (error) {
        res.status(500).send('Error al eliminar el libro');
    }
};

// GET - Mostrar formulario de edición
export const formularioEditar = async (req, res) => {
    try {
        const libro = await Libro.findById(req.params.id);
        res.render('editar', { title: 'Editar Libro', libro });
    } catch (error) {
        res.status(500).send('Error al buscar el libro');
    }
};

// POST - Guardar cambios del libro
export const actualizarLibro = async (req, res) => {
    try {
        const { id } = req.params;
        await Libro.findByIdAndUpdate(id, req.body);
        res.redirect('/');
    } catch (error) {
        res.status(500).send('Error al actualizar');
    }
};