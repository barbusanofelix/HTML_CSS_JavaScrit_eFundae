
<?php
// funciones.php
// Modulo para funciones a reusar
/*
 En el archivo php que las queremos usar , iniciando el script de php colocamos:
        // Importar el módulo
        require_once 'funciones.php';

 */       

/* Para asegurar que la funcion no se ejecute hasta cargar todo se usa:
document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({Aqui la parte interna del script})

Abajo podemos ver la aplicacion en la funcion alerta() y mas abajo, comentado la version 
original de la funcion sin document.addEventListener('DOMContentLoaded', function() {}
*/            

function alerta($mensaje) {
    return "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Mensaje',
                text: '$mensaje',
                icon: 'info',
                confirmButtonText: 'Entendido'
            });
        });
    </script>";
}
?>

<!--    ESTA ES LA FORMA TRADICIONAL QUE RETORNA EL SCRIPT PARA LA ALERTA     
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
?> -->