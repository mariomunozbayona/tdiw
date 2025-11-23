<?php

require_once __DIR__ . '/connectaBD.php';

function getCategories() {
    // 1. Conexión a la BBDD
    $conn = connectaBD();
    
    // 2. Preparamos la consulta SQL. Solo mostramos categorías activas.
    $sql = 'SELECT id, name, description FROM category WHERE is_active = TRUE ORDER BY id ASC';
    
    // 3. Ejecutamos la consulta.
    $result = pg_query($conn, $sql);
    
    // 4. Cogemos todos los resultados.
    if ($result) {
        $categories = pg_fetch_all($result);
        pg_free_result($result);
    } else {
        // En caso de error en la consulta
        error_log("Error en consulta de categorías: " . pg_last_error($conn));
        $categories = []; // Retornar un array vacío en caso de fallo
    }
    
    pg_close($conn);
    return $categories ?: []; // Retorna el array de categorías o un array vacío si es FALSE
}
?>