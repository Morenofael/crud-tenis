<?php

require_once(__DIR__ . '/../../controller/JogadorController.php');

//Receber o parâmetro
$idJogador = 0;
if(isset($_GET['idJogador']))
    $idJogador = $_GET['idJogador'];

$jogadorCont = new JogadorController();   
$jogador = $jogadorCont->buscarPorId($idJogador); //TODO implementar método buscar por id

if(! $jogador) {
    echo "Jogador não encontrado!<br>";
    echo "<a href='listar.php'>Voltar</a>";
    exit;
}

$jogadorCont->excluirPorId($jogador->getId()); //TODO implementar exlusão por id

//Redirecionar para a listar
header("location: listar.php");
