<?php
// estructura de la página de inicio (Home)

// incluimos el Layout Header
require_once __DIR__ . '/resources/layout_header.php';
?>

        <h1>Bienvenido a Basketball Shop</h1>
        <p style="text-align: center; font-size: 1.2em; color: #666;">Tu tienda de equipamiento de baloncesto. Usa el menú superior para navegar por el catálogo.</p>
        
        <div style="text-align: center; margin-top: 50px;">
            <a href="index.php?accio=llistar-categories" style="background-color: var(--color-primary); color: var(--color-accent); padding: 15px 30px; border-radius: 5px; font-weight: bold; text-transform: uppercase;">Ver Catálogo Ahora</a>
        </div>

<?php
// incluimos el Layout Footer (cierre del HTML)
require_once __DIR__ . '/resources/layout_footer.php';
?>