<?php
require_once __DIR__.'/../model/connectaBD.php';
require_once __DIR__.'/../model/categories.php';

$categories = getCategories();

include __DIR__.'/../views/llistar_categories.php';
?>