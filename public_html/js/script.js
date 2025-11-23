// navegación dinámica (FETCH) y menú de usuario (jQuery)

// menú desplegable con jQuery 
$(document).ready(function() {
    
    // función para mostrar/ocultar el menú
    $('#user-menu-link').on('click', function(e) {
        // si el enlace es a '#' evitamos la navegación y mostramos el menú
        if ($(this).attr('href') === '#') { 
            e.preventDefault(); 
            $('#user-menu-dropdown').slideToggle(200);
        }
    });
    
    // cerrar el menú al hacer click fuera del contenedor
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#user-menu-container').length) {
            $('#user-menu-dropdown').slideUp(200);
        }
    });

    
    // inicialización de los eventos para categorías
    // si estamos en la página de categorías, inicializamos los eventos
    initializeCategoryEvents();
});

// inicializa los eventos de click en las tarjetas de categoría
function initializeCategoryEvents() {
    const categoryLinks = document.querySelectorAll('.category-card');
    categoryLinks.forEach(link => {
        // se busca el id de la categoría que el enlace de PHP generó originalmente
        const categoryIdMatch = link.href.match(/category_id=(\d+)/);
        if (categoryIdMatch) {
            const categoryId = categoryIdMatch[1];
            
            link.href = "#"; 
            link.onclick = function(e) {
                e.preventDefault();
                // llama a la función JS que usa FETCH
                loadProductsByCategory(categoryId);
                return false;
            };
        }
    });
}

// funciones FETCH y renderizado de vistas 

/**
 * Genera el HTML para el listado de productos
 * @param {Array} products (array de objetos de producto)
 */
function renderProductsList(products, categoryId) {
    // Botón para volver al catálogo de categorías
    let html = `
        <button onclick="showCategoryList()" class="btn-primary" style="margin-bottom: 20px; background-color: #555;">&larr; Volver a Categorías</button>
        <h2>Listado de Productos</h2>
        <div class="category-grid">`;
    
    if (products.error) {
        html += `<p style="grid-column: 1 / -1; color: red;">Error: ${products.error}</p>`;
    } else if (products.length === 0) {
         html += `<p style="grid-column: 1 / -1;">No hay productos activos en esta categoría.</p>`;
    } else {
        products.forEach(p => {
            // AHORA USAMOS p.image (la ruta real de la BD)
            // Si la imagen falla, ponemos un placeholder por seguridad
            let imagePath = p.image ? p.image : 'https://placehold.co/400x300?text=Sin+Imagen';

            html += `
                <a href="#" class="product-card" onclick="loadProductDetail(${p.id}); return false;">
                    <img src="${imagePath}" alt="${p.name}" style="width: 100%; height: 200px; object-fit: contain; background-color: #fff; padding: 10px;">
                    <div class="product-card-content">
                        <h3>${p.name}</h3>
                        <p class="price">${p.price} €</p>
                        <button class="btn-primary" style="width: 100%; font-size: 0.9em; margin-top: 10px;">Ver Detalle</button>
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
 */
function renderProductDetail(product) {
    if (product.error) {
        return `<p style="color: red; text-align: center;">Error: ${product.error}</p>`;
    }

    // Usamos product.category_id (que añadimos al modelo) para volver a la lista correcta
    const backButton = `<button onclick="loadProductsByCategory(${product.category_id})" class="btn-primary" style="background-color: #555;">&larr; Volver al Listado</button>`;
    
    let imagePath = product.image ? product.image : 'https://placehold.co/600x600?text=Sin+Imagen';

    return `
        <div id="product-detail-container">
            <img src="${imagePath}" alt="${product.name}"
                style="width: 50%; height: 400px; object-fit: contain; background-color: #fff; border-radius: 8px;">
            <div id="product-info">
                <h2>${product.name}</h2>
                <p>${product.description}</p>
                <div class="price">${product.price} €</div>
                
                <form class="add-to-cart-form" onsubmit="event.preventDefault(); alert('Añadido al carrito (Simulado)');">
                    <label for="quantity">Quantitat:</label>
                    <input type="number" id="quantity" value="1" min="1" max="99" required>
                    <button type="submit" class="btn-primary">Afegir al Cabàs</button>
                </form>
                <br>
                ${backButton}
            </div>
        </div>
    `;
}

/**
 * Función auxiliar para restaurar la vista de categorías
 */
function showCategoryList() {
    $('#dynamic-content').hide();
    $('#category-list-container').fadeIn();
}

/**
 * Carga productos y gestiona la visibilidad
 */
function loadProductsByCategory(categoryId) {
    // 1. Ocultar categorías y mostrar cargando
    $('#category-list-container').hide();
    $('#dynamic-content').show().html('<h2 style="text-align: center;">Carregant productes...</h2>');
    
    fetch(`index.php?accio=api_llistar_productes&category_id=${categoryId}`)
        .then(response => response.json())
        .then(products => {
            // Pasamos categoryId para poder recargar la lista si hiciera falta
            $('#dynamic-content').html(renderProductsList(products, categoryId));
        })
        .catch(error => {
            console.error('Error al cargar productos:', error);
            $('#dynamic-content').html('<h2 style="color: red; text-align: center;">Error al carregar els productes.</h2><button onclick="showCategoryList()">Volver</button>');
        });
}

function loadProductDetail(productId) {
    $('#dynamic-content').html('<h2 style="text-align: center;">Carregant detall...</h2>');

    fetch(`index.php?accio=api_detall_producte&product_id=${productId}`)
        .then(response => response.json())
        .then(product => {
            $('#dynamic-content').html(renderProductDetail(product));
        })
        .catch(error => {
            console.error('Error al cargar detalle:', error);
            $('#dynamic-content').html('<h2 style="color: red; text-align: center;">Error al carregar el detall.</h2>');
        });
}