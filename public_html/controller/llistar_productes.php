<?php
// controller/llistar_productes.php
// Controla la lògica per obtenir i mostrar el llistat de productes d'una categoria.

require_once __DIR__ . '/../model/productes.php';

// Obtenir el paràmetre d'ID de categoria.
$category_id = $_GET['category_id'] ?? NULL; 

$productes = [];

if ($category_id !== NULL) {
    // Cridar al Model per obtenir els productes.
    $productes = getProductesByCategoria((int)$category_id);
}

// Incloure la vista per renderitzar els productes.
require_once __DIR__ . '/../views/llistar_productes.php';
?>