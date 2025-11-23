// Logica Frontend (FETCH y jQuery)
// Este script maneja la navegación dinámica (FETCH) y el menú de usuario (jQuery).

// ====================================================================
// 1. Menú Desplegable con jQuery (Sección 4.4)
// ====================================================================
$(document).ready(function() {
    
    // Función para mostrar/ocultar el menú
    $('#user-menu-link').on('click', function(e) {
        // Si el enlace es a '#' (simulando que el usuario ha iniciado sesión),
        // evitamos la navegación y mostramos el menú.
        if ($(this).attr('href') === '#') { 
            e.preventDefault(); 
            $('#user-menu-dropdown').slideToggle(200);
        }
    });
    
    // Cerrar menú al hacer click fuera del contenedor
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#user-menu-container').length) {
            $('#user-menu-dropdown').slideUp(200);
        }
    });

    // -------------------------------------------------------------
    // 2. Inicialización de Eventos para Categorías
    // -------------------------------------------------------------
    
    // Si estamos en la página de categorías, inicializamos los eventos
    // Esta parte debe ejecutarse DESPUÉS de que la vista de categorías se haya cargado.
    initializeCategoryEvents();
});

// Inicializa los eventos de click en las tarjetas de categoría
function initializeCategoryEvents() {
    const categoryLinks = document.querySelectorAll('.category-card');
    categoryLinks.forEach(link => {
        // Buscamos el ID de la categoría que el enlace de PHP generó originalmente.
        const categoryIdMatch = link.href.match(/category_id=(\d+)/);
        if (categoryIdMatch) {
            const categoryId = categoryIdMatch[1];
            
            // Sobreescribimos el comportamiento por defecto (que era navegar)
            link.href = "#"; // Evita la navegación por defecto
            link.onclick = function(e) {
                e.preventDefault();
                // Llama a la función JS que usa FETCH
                loadProductsByCategory(categoryId);
                return false;
            };
        }
    });
}


// ====================================================================
// 3. Funciones FETCH y Renderizado de Vistas (Sección 4.1 y 4.2)
// ====================================================================

/**
 * Genera el HTML para el listado de productos
 * @param {Array} products - Array de objetos de producto.
 */
function renderProductsList(products) {
    let html = `<h2>Listado de Productos</h2><div class="category-grid">`;
    
    if (products.error) {
        html += `<p style="grid-column: 1 / -1; color: red;">Error: ${products.error}</p>`;
    } else if (products.length === 0) {
         html += `<p style="grid-column: 1 / -1;">No hay productos activos en esta categoría.</p>`;
    } else {
        products.forEach(p => {
            // Al hacer click, llama a loadProductDetail con el ID
            html += `
                <a href="#" class="product-card" onclick="loadProductDetail(${p.id}); return false;">
                    <img src="https://placehold.co/400x300/F00/FFF?text=${encodeURIComponent(p.name)}" alt="${p.name}">
                    <div class="product-card-content">
                        <h3>${p.name}</h3>
                        <p class="price">${p.price} €</p>
                        <button class="btn-primary" style="width: 100%; font-size: 0.9em; margin-top: 10px;">Afegir al Cabàs</button>
                    </div>
                </a>
            `;
        });
    }

    html += `</div>`;
    return html;
}

/**
 * Genera el HTML para el detalle del producto
 * @param {Object} product - Objeto de producto.
 */
function renderProductDetail(product) {
    if (product.error) {
        return `<p style="color: red; text-align: center;">Error: ${product.error}</p>`;
    }

    // El botón 'Tornar' ahora llama a loadProductsByCategory, pero necesitamos el ID de la categoría.
    // Asumimos que el producto incluye el category_id para poder volver al listado correcto.
    const backButton = `<button onclick="window.history.back();" class="btn-primary" style="background-color: #555;">Tornar</button>`;
    
    return `
        <div id="product-detail-container">
            <img src="https://placehold.co/600x600/000/FFF?text=${encodeURIComponent(product.name)}" alt="${product.name}">
            <div id="product-info">
                <h2>${product.name}</h2>
                <p style="color: #666;">Categoria: ${product.category_name}</p>
                <p>${product.description}</p>
                
                <div class="price">${product.price} €</div>
                
                <!-- Botón de añadir al cabás con cantidad (Sección 4.2) -->
                <form class="add-to-cart-form">
                    <label for="quantity">Quantitat:</label>
                    <input type="number" id="quantity" value="1" min="1" max="99" required>
                    <button type="submit" class="btn-primary">Afegir al Cabàs</button>
                </form>
                ${backButton}
            </div>
        </div>
    `;
}


/**
 * Llama al controlador de la API para listar productos de una categoría (FETCH)
 * @param {number} categoryId - ID de la categoría a listar.
 */
function loadProductsByCategory(categoryId) {
    $('#dynamic-content').html('<h2 style="text-align: center;">Carregant productes...</h2>');
    
    // Llama al controlador de la API: index.php?accio=api_llistar_productes
    fetch(`index.php?accio=api_llistar_productes&category_id=${categoryId}`)
        .then(response => response.json())
        .then(products => {
            // Renderiza la vista de productos
            $('#dynamic-content').html(renderProductsList(products));
        })
        .catch(error => {
            console.error('Error al cargar productos:', error);
            $('#dynamic-content').html('<h2 style="color: red; text-align: center;">Error al carregar els productes.</h2>');
        });
}

/**
 * Llama al controlador de la API para obtener el detalle de un producto (FETCH)
 * @param {number} productId - ID del producto.
 */
function loadProductDetail(productId) {
    $('#dynamic-content').html('<h2 style="text-align: center;">Carregant detall...</h2>');

    // Llama al controlador de la API: index.php?accio=api_detall_producte
    fetch(`index.php?accio=api_detall_producte&product_id=${productId}`)
        .then(response => response.json())
        .then(product => {
            // Renderiza la vista del detalle
            $('#dynamic-content').html(renderProductDetail(product));
        })
        .catch(error => {
            console.error('Error al cargar detalle:', error);
            $('#dynamic-content').html('<h2 style="color: red; text-align: center;">Error al carregar el detall del producte.</h2>');
        });
}