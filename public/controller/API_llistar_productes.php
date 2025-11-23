<?php
// controller/api_llistar_productes.php
// Controlador que obtiene la lista de productos y devuelve JSON para FETCH.
header('Content-Type: application/json');
require_once __DIR__ . '/../model/productes.php';

$category_id = $_GET['category_id'] ?? null;
$productes = [];

if (!is_numeric($category_id) || (int)$category_id <= 0) {
    // Retorna un error si l'ID no és vàlid
    echo json_encode(['error' => 'ID de categoría no válido.']);
    exit;
}

// Cridar al Model per obtenir els productes.
// Utilitzem un try-catch o verificació bàsica per a l'error
try {
    $productes = getProductesByCategoria((int)$category_id);
    echo json_encode($productes);
} catch (\Throwable $e) {
    error_log("Error API llistar productes: " . $e->getMessage());
    echo json_encode(['error' => 'Error al obtener productos de la base de datos.']);
}
?>