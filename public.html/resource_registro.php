<?php

// 1. Incluimos el Layout Header (inicio del HTML y navegación)
require_once __DIR__ . '/resources/layout_header.php';
?>

        <h1>Registra't</h1>
        <section id="registro" class="view active">
            <?php require_once __DIR__ . '/controller/registre_usuari.php'; ?>
        </section>

<?php
// 3. Incluimos el Layout Footer (cierre del HTML)
require_once __DIR__ . '/resources/layout_footer.php';
?>