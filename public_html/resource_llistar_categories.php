<?php
// resource_llistar_categories.php
// Estructura de la página para el listado de categorías.

// 1. Incluimos el Layout Header (inicio del HTML y navegación)
require_once __DIR__ . '/resources/layout_header.php';
?>

        <h1>Explora nuestras Categorías</h1>
        <section id="catalogo" class="view active">
            <!--
                2. Incluimos el Controlador
                El controlador obtiene los datos y luego llama a la Vista.
            -->
            <?php require_once __DIR__ . '/controller/llistar_categories.php'; ?>
        </section>

<?php
// 3. Incluimos el Layout Footer (cierre del HTML)
require_once __DIR__ . '/resources/layout_footer.php';
?>