
<?php
// funciones.php
// Modulo para funciones a reusar
/*
 En el archivo php que las queremos usar , iniciando el script de php colocamos:
        // Importar el módulo
        require_once 'funciones.php';

 */       

function alerta($mensajeMostrar)
{
    return "
    <script>
        Swal.fire({
            title: '¡Aviso!',
            text: '$mensajeMostrar',
            icon: 'info',
            confirmButtonText: 'Aceptar'
        });
    </script>";
    
}
?>