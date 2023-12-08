<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__ . "/../../controller/JogadorController.php");
require_once(__DIR__ . "/../../model/Jogador.php");
require_once(__DIR__ . "/../../model/Clube.php");

$msgErro = '';
$jogador = null;

if(isset($_POST['submetido'])) {
    //echo "clicou no gravar";
    //Captura os campo do formulário
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $idClube = is_numeric($_POST['clube']) ? $_POST['clube'] : null;
    $arquivoFoto = $_FILES['foto'];
    
    //para persistencia
    $jogador = new Jogador();
    $jogador->setNome($nome);
    if($idClube) {
        $clube = new Clube();
        $clube->setId($idClube);
        $jogador->setClube($clube);
    }

    $jogadorCont = new JogadorController();
    $erros = $jogadorCont->inserir($jogador, $arquivoFoto);
    if(! $erros) { //Caso não tenha erros
        //Redirecionar para o listar
        echo "nao tem erros";
        header("location: listar.php");
        exit;
    } else { //Em caso de erros, exibí-los
        //echo "tem erros";
        $msgErro = implode("<br>", $erros);
        //echo $msgErro;
    }
}


//Inclui o formulário
include_once(__DIR__ . "/form.php");
