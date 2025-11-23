<?php

require_once __DIR__ . '/connectaBD.php';

/**
 * llistat de productes per a una categoria específica
 * @param int $category_id el id de la categoria
 * @return array llistat de productes
 */
function getProductesByCategoria(int $category_id): array
{
    $conn = connectaBD();
    
    // utilitzem $1 com a placeholder
    $sql = 'SELECT id, name, price, image, description FROM product 
            WHERE category_id = $1 AND is_active = TRUE 
            ORDER BY id ASC';

    $params = [$category_id];
    
    // utilitzem pg_query_params per a la consulta per parametres
    $result = pg_query_params($conn, $sql, $params);
    
    if ($result) {
        $products = pg_fetch_all($result); // obté tots els resultats per la llista
        pg_free_result($result);
    } else {
        error_log("Error en consulta de productes: " . pg_last_error($conn));
        $products = [];
    }
    
    pg_close($conn);
    return $products ?: [];
}

/**
 * obté el detall d'un únic producte
 * @param int $product_id el id del producte
 * @return array array associatiu amb el detall del producte o un array buit
 */
function getDetallProducte(int $product_id): array
{
    $conn = connectaBD();
    
    // AÑADIMOS category_id A LA SELECT
    $sql = 'SELECT id, name, description, price, image, category_id FROM product 
            WHERE id = $1 AND is_active = TRUE';

    $params = [$product_id];
    
    $result = pg_query_params($conn, $sql, $params);
    
    if ($result) {
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