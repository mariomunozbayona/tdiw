<?php
?>

<div id="category-list-container">
    <div class="category-grid">
        <?php if (empty($categories)): ?>
            <p>No se encontraron categorías.</p>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <?php
                    // imagenes categorias
                    $imgSrc = 'https://placehold.co/400x300?text=No+Image';
                    switch ($category['id']) {
                        case 1: $imgSrc = 'img/img/jordan.jpg'; break;
                        case 2: $imgSrc = 'img/img/pantalon-negro.jpg'; break;
                        case 3: $imgSrc = 'img/img/lakers-equipacion.jpg'; break;
                        case 4: $imgSrc = 'img/img/balón.jpg'; break;
                        case 5: $imgSrc = 'img/img/hyperdunk.jpg'; break;
                    }
                ?>
                <a href="index.php?accio=llistar-productes&category_id=<?php echo $category['id']; ?>" 
                   class="category-card" 
                   title="<?php echo htmlspecialchars($category['description']); ?>">
                    
                    <img src="<?php echo $imgSrc; ?>" 
                         alt="<?php echo htmlspecialchars($category['name']); ?>"
                         style="object-fit: contain; background: #fff;">
                    
                    <div class="category-card-content">
                        <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div id="dynamic-content" style="margin-top: 20px; display:none;"></div>