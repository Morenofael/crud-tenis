<?php

require_once(__DIR__ . "/../controller/EsporteController.php");

$idEsporte = $_GET['idEsporte'];

$clubeCont = new ClubeController();
$clubes = $clubeCont->listarPorEsporte($idEsporte);

echo json_encode($clubes, JSON_UNESCAPED_UNICODE);
