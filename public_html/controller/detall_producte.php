<?php
// controller que obtiene el detalle de un producto y devuelve JSON para FETCH
header('Content-Type: application/json');
require_once __DIR__ . '/../model/productes.php';

$productId = $_GET['product_id'] ?? null;

if (!is_numeric($productId) || (int)$productId <= 0) {
    echo json_encode(['error' => 'ID de producto no válido.']);
    exit;
}

$product = getDetallProducte((int)$productId);

if ($product) {
    echo json_encode($product);
} else {
    echo json_encode(['error' => 'Producto no encontrado o inactivo.']);
}
?>