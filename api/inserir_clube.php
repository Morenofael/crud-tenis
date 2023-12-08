<?php

require_once(__DIR__ . "/../model/Esporte.php");
require_once(__DIR__ . "/../model/Clube.php");
require_once(__DIR__ . "/../controller/ClubeController.php");

//Capturar os parâmetros POST
$nome = $_POST['nome'] ? $_POST['nome'] : 0;
$idEsporte = is_numeric($_POST['idEsporte']) ? 
                $_POST['idEsporte'] : 0;
$idClube = is_numeric($_POST['idClube']) ? 
                    $_POST['idClube'] : 0;

$clube = new Clube();

//Sets dos valores da turma
$clube->setNome($nome);
if($idEsporte) {
    $esp = new Esporte();
    $esp->setId($idEsporte);
    $clube->setEsporte($esp);
}

//Chamar o controller para salvar a turma
$clubeCont = new ClubeController();
$erros = $clubeCont->salvar($clube);

//Retornar os erros ou 
//uma string vazia se não houverem erros
$msgErro = "";
if($erros)
    $msgErro = implode("<br>", $erros);

echo $msgErro;
