<?php
// views/llistar_categories.php
// Esta vista recibe la variable $categories del controlador.
// Contiene HTML y PHP para renderizar los datos.
<div class="category-grid">
    <?php if (empty($categories)): ?>
        <p>No se encontraron categorías. Por favor, revisa la base de datos.</p>
    <?php else: ?>
        <?php foreach ($categories as $category): ?>
            <!--
                Implementación de la tarjeta de categoría.
                El enlace debe llevar al listado de productos de esta categoría,
                pasando el ID como parámetro GET: ?accio=llistar-productes&category_id=X
                (Funcionalidad para Sesión 3, pero se deja el placeholder de URL)
            -->
            <a href="index.php?accio=llistar-productes&category_id=<?php echo $category['id']; ?>" 
               class="category-card" 
               title="<?php echo htmlspecialchars($category['description']); ?>">
                
                <!-- URL de imagen de placeholder temporalmente. Reemplazar por imagen real. -->
                <img src="https://placehold.co/800x600/000000/FFFFFF?text=<?php echo urlencode(strtoupper($category['name'])); ?>" 
                     alt="<?php echo htmlspecialchars($category['name']); ?>">
                
                <div class="category-card-content">
                    <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars(substr($category['description'], 0, 50)) . '...'; ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
?>

<div class="category-grid">
    <?php if (empty($categories)): ?>
        <p>No se encontraron categorías. Por favor, revisa la base de datos.</p>
    <?php else: ?>
        <?php foreach ($categories as $category): ?>
            <div class="category-card" 
                 data-category-id="<?php echo $category['id']; ?>"
                 data-category-name="<?php echo htmlspecialchars($category['name']); ?>"
                 onclick="fetchProductList(<?php echo $category['id']; ?>)">
                
                <img src="https://placehold.co/800x600/000000/FFFFFF?text=<?php echo urlencode(strtoupper($category['name'])); ?>" 
                     alt="<?php echo htmlspecialchars($category['name']); ?>">
                
                <div class="category-card-content">
                    <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars(substr($category['description'], 0, 50)) . '...'; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<h2 id="product-list-title" style="display: none; text-align: center; margin-top: 40px;"></h2>

<div id="product-list-target" style="margin-top: 20px;">
    </div>


<script>
    function fetchProductList(categoryId) {
        // 1. Indicar que s'està carregant
        $('#product-list-target').html('<p style="text-align: center;">Carregant productes...</p>');
        $('#product-list-title').hide();

        // 2. Crida FETCH a l'Encaminador
        const url = `index.php?accio=llistar-productes&category_id=${categoryId}`;
        
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return response.text(); // Esperem l'HTML de la vista
            })
            .then(html => {
                // 3. Injectar l'HTML rebut al contenidor
                $('#product-list-target').html(html);
                
                // 4. Actualitzar el títol
                const categoryName = $(`[data-category-id="${categoryId}"]`).data('category-name');
                $('#product-list-title').text(`Productes de: ${categoryName}`).show();
            })
            .catch(error => {
                console.error('Error durant la càrrega de productes amb FETCH:', error);
                $('#product-list-target').html(`<p style="color: red; text-align: center;">No s'ha pogut carregar el llistat de productes.</p>`);
            });
    }
</script>