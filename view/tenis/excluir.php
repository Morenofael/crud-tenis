<?php

require_once(__DIR__ . '/../../controller/TenisController.php');

//Receber o parâmetro
$idTenis = 0;
if(isset($_GET['idTenis']))
    $idTenis = $_GET['idTenis'];

$tenisCont = new TenisController();   
$tenis = $tenisCont->buscarPorId($idTenis); //TODO implementar método buscar por id

if(! $tenis) {
    echo "Tenis não encontrado!<br>";
    echo "<a href='listar.php'>Voltar</a>";
    exit;
}

$tenisCont->excluirPorId($tenis->getId()); //TODO implementar exlusão por id

//Redirecionar para a listar
header("location: listar.php");