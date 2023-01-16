<?php
require_once('./controllers/GestionRecettesController.php');

$controller = new GestionRecettesController();
$ings = $controller->getIngredients();
$result = array();
foreach ($ings as $ing) {
    array_push($result, $ing);
}
echo json_encode($result);