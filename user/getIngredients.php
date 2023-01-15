<?php
require_once('./controllers/PageAjoutRecetteController.php');

$controller = new PageAjoutRecetteController();
$ings = $controller->getIngredients();
$result = array();
foreach ($ings as $ing) {
    array_push($result, $ing);
}
echo json_encode($result);