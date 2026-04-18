import express from 'express';
import { obtenerLibros, crearLibro, eliminarLibro, formularioEditar, actualizarLibro } from '../controllers/libroController.js';

const router = express.Router();

// Ruta para ver todos los libros (GET)
router.get('/', obtenerLibros);

// Ruta para recibir los datos del formulario (POST)
router.post('/agregar', crearLibro);

// Ruta para eliminar (Usamos GET para simplificar el enlace en el HTML por ahora)
router.get('/eliminar/:id', eliminarLibro);

// Ruta para editar un libro
router.get('/editar/:id', formularioEditar);

// Ruta para actualizar informacion de un libro
router.post('/editar/:id', actualizarLibro);

export default router;