import mongoose from 'mongoose';

// Definimos la estructura de un "Libro"
const libroSchema = new mongoose.Schema({
    titulo: {
        type: String,
        required: [true, 'El título es obligatorio'],
        trim: true
    },
    autor: {
        type: String,
        required: [true, 'El autor es obligatorio'],
        trim: true
    },
    genero: {
        type: String,
        default: 'Sin género'
    },
    leido: {
        type: Boolean,
        default: false
    },
    fechaPublicacion: {
        type: Number // Año
    }
}, {
    timestamps: true // Crea automáticamente campos "createdAt" y "updatedAt"
});

// Creamos el modelo basado en el esquema
const Libro = mongoose.model('Libro', libroSchema);

export default Libro;