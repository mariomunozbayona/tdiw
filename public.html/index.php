<?php

$accio = $_GET['accio'] ?? null;
// Switch per enrutar les peticions
switch ($accio) {
    case 'llistar-categories':
        // Carga el recurso que mostrará la lista de categorías
        require __DIR__ . '/resource_llistar_categories.php';
        break;
        
    case 'registro':
        // Carga el recurso para el formulario de registro
        require __DIR__ . '/resource_registro.php';
        break;

    case 'login':
        // Carga el recurso para el formulario de login (estático por ahora)
        // require __DIR__ . '/resource_login.php';
        require __DIR__ . '/resource_portada.php'; // Pots canviar aquesta línia quan tinguis el recurs de login
        break;

    // NOVES ACCIONS API (Han de coincidir amb les cridades de js/script.js)
    case 'api_llistar_productes':
        // El controlador s'encarrega d'obtenir les dades i retornar JSON
        require __DIR__ . '/controller/API_llistar_productes.php';
        break;

    case 'api_detall_producte':
        // El controlador s'encarrega d'obtenir les dades i retornar JSON
        require __DIR__ . '/controller/detall_producte.php';
        break;
        
    // L'acció original 'llistar-productes' ja no és necessària amb el model API. 
    // La deixo com estava, però el JS de views/llistar_categories.php hauria de canviar.

    default:
        // Carga el recurso de la página principal/portada si no se especifica ninguna acción.
        require __DIR__ . '/resource_portada.php';
        break;
}
?>