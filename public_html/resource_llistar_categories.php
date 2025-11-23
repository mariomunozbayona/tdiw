<?php
// estructura de la página para el listado de las categorías

// añadimos el Layout Header (inicio del HTML y de navegación)
require_once __DIR__ . '/resources/layout_header.php';
?>

        <h1>Explora nuestras Categorías</h1>
        <section id="catalogo" class="view active">
            <!-- incluimos el controller que obtiene los datos y luego llama a la vista -->
            <?php require_once __DIR__ . '/controller/llistar_categories.php'; ?>
        </section>

<?php
// añadimos el Layout Footer (cierre del HTML)
require_once __DIR__ . '/resources/layout_footer.php';
?>