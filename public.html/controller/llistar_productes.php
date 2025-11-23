<?php
// controla la lògica per obtenir i mostrar el llistat de productes d'una categoria

require_once __DIR__ . '/../model/productes.php';

// obtenir el paràmetre d'id de la categoria
$category_id = $_GET['category_id'] ?? NULL; 

$productes = [];

if ($category_id !== NULL) {
    // cridar a model per obtenir els productes
    $productes = getProductesByCategoria((int)$category_id);
}

// afegir la vista per renderitzar els productes
require_once __DIR__ . '/../views/llistar_productes.php';
?>