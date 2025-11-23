<?php

require_once __DIR__ . '/connectaBD.php';

function getCategories() {
    // conexión a la base de datos
    $conn = connectaBD();
    
    // consulta SQL
    $sql = 'SELECT id, name, description FROM category WHERE is_active = TRUE ORDER BY id ASC';
    
    // ejecutamos la consulta
    $result = pg_query($conn, $sql);
    
    // cogemos todos los resultados
    if ($result) {
        $categories = pg_fetch_all($result);
        pg_free_result($result);
    } else {
        error_log("Error en consulta de categorías: " . pg_last_error($conn));
        $categories = []; // return array vacío en caso de error
    }
    
    pg_close($conn);
    return $categories ?: []; // return el array de categorías o un array vacío si = false
}
?>