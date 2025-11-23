<?php
// llista de productes d'una categoria.

// La variable $productes prové de controller
?>

<div class="product-grid" id="product-list-container">
    <?php if (empty($productes)): ?>
        <p>No hi ha productes actius en aquesta categoria.</p>
    <?php else: ?>
        <?php foreach ($productes as $product): ?>
            <div class="product-card" 
                 data-product-id="<?php echo $product['id']; ?>"
                 onclick="fetchProductDetail(<?php echo $product['id']; ?>)">
                
                <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                
                <div class="product-card-content">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="price"><?php echo number_format((float)$product['price'], 2, ',', '.') . ' €'; ?></p>
                    <button class="add-to-cart-btn">Afegir al Cabàs</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
    // Funció placeholder per al detall del producte (el cridarà la vista de categories)
    function fetchProductDetail(productId) {
        // Aquesta funció s'implementarà més tard per a mostrar el detall.
        console.log('Funció detall de producte cridada per ID: ' + productId);
        // Aquí hauria d'anar el FETCH per a l'acció 'detall-producte'
    }
</script>