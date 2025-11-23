<?php
// index.php
// Encaminador (Router) principal. Recibe todas las peticiones.
// Sección 4.1 - Implementación del Router MVC.

// LINK ENTRAR PÁGINA WEB https://tdiw-a7.deic-docencia.uab.cat/
// Definir el modo estricto para asegurar la comprobación de tipos
declare (strict_types=1);

// Inicialmente no haremos uso de sesiones, pero es buena práctica incluirlas aquí.
// session_start(); 

// Obtener el parámetro 'accio' (acción) de la URL
// Usamos el operador de coalescencia ?? para un valor por defecto seguro (NULL).
$accio = $_GET['accio'] ?? NULL;

// Switch para enrutar las peticiones
switch ($accio) {
    case 'llistar-categories':
        // Carga el recurso que mostrará la lista de categorías
        require __DIR__ . '/resource_llistar_categories.php';
        break;
        
    case 'registro':
        // Carga el recurso para el formulario de registro (estático por ahora)
        require __DIR__ . '/resource_registro.php';
        // Usamos la portada por defecto hasta implementar el resto de recursos
        require __DIR__ . '/resource_portada.php';
        break;

    case 'login':
        // Carga el recurso para el formulario de login (estático por ahora)
        // require __DIR__ . '/resource_login.php';
        // Usamos la portada por defecto hasta implementar el resto de recursos
        require __DIR__ . '/resource_portada.php';
        break;

    case 'llistar-productes':
        // Esta es una acción futura (Sesión 3), redirigimos a portada por ahora
        require __DIR__ . '/resource_llistar_productes_ajax.php';
        require __DIR__ . '/resource_portada.php';
        break;

    default:
        // Carga el recurso de la página principal/portada si no se especifica ninguna acción.
        require __DIR__ . '/resource_portada.php';
        break;
}
?>