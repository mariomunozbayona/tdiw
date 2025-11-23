<?php

require_once __DIR__ . '/connectaBD.php';

/**
 * llistat de productes per a una categoria específica.
 * @param int $category_id L'ID de la categoria.
 * @return array Llistat de productes.
 */
function getProductesByCategoria(int $category_id): array
{
    $conn = connectaBD();
    
    // Utilitzem $1 com a placeholder.
    $sql = 'SELECT id, name, price, image, description FROM product 
            WHERE category_id = $1 AND is_active = TRUE 
            ORDER BY id ASC';

    $params = [$category_id];
    
    // Utilitzem pg_query_params per a la consulta parametritzada.
    $result = pg_query_params($conn, $sql, $params);
    
    if ($result) {
        $products = pg_fetch_all($result); // Obté tots els resultats per al llistat.
        pg_free_result($result);
    } else {
        error_log("Error en consulta de productes: " . pg_last_error($conn));
        $products = [];
    }
    
    pg_close($conn);
    return $products ?: [];
}

/**
 * Obté el detall d'un únic producte.
 * @param int $product_id L'ID del producte.
 * @return array Un array associatiu amb el detall del producte o un array buit.
 */
function getDetallProducte(int $product_id): array
{
    $conn = connectaBD();
    
    $sql = 'SELECT id, name, description, price, image FROM product 
            WHERE id = $1 AND is_active = TRUE';

    $params = [$product_id];
    
    $result = pg_query_params($conn, $sql, $params);
    
    if ($result) {
        // Utilitzem pg_fetch_assoc() per obtenir directament un únic registre.
        $product = pg_fetch_assoc($result); 
        pg_free_result($result);
    } else {
        error_log("Error en consulta de detall de producte: " . pg_last_error($conn));
        $product = [];
    }
    
    pg_close($conn);
    return $product ?: [];
}
?>