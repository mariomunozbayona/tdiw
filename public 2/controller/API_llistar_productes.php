<?php
// controller que obtiene la lista de productos y devuelve JSON para FETCH
header('Content-Type: application/json');
require_once __DIR__ . '/../model/productes.php';

$category_id = $_GET['category_id'] ?? null;
$productes = [];

if (!is_numeric($category_id) || (int)$category_id <= 0) {
    // return un error si l'id no és vàlid
    echo json_encode(['error' => 'ID de categoría no válido.']);
    exit;
}

// cridar a model per obtenir els productes
try {
    $productes = getProductesByCategoria((int)$category_id);
    echo json_encode($productes);
} catch (\Throwable $e) {
    error_log("Error API llistar productes: " . $e->getMessage());
    echo json_encode(['error' => 'Error al obtener productos de la base de datos.']);
}
?>