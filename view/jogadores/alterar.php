<?php 
require_once(__DIR__ . "/../../controller/JogadorController.php");
require_once(__DIR__ . "/../../model/Jogador.php");
require_once(__DIR__ . "/../../model/Clube.php");

$msgErro = '';
$jogador = null;

$jogadorCont = new JogadorController();
if(isset($_POST['submetido'])) {
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $idClube = is_numeric($_POST['clube']) ? $_POST['clube'] : null;
    
    $arquivoFoto = $_FILES['foto'];
    $nomeArquivoFotoAtual = $_POST['fotoAntiga'];
    
    $idJogador = $_POST['id'];
    //para persistencia
    $jogador = new Jogador();
    $jogador->setId($idJogador);
    $jogador->setNome($nome);
    if($idClube) {
        $clube = new Clube();
        $clube->setId($idClube);
        $jogador->setClube($clube);
    }
     $jogador->setImgFoto($nomeArquivoFotoAtual);
    
    $jogadorCont = new JogadorController();
    $erros = $jogadorCont->atualizar($jogador);
    if(! $erros) { //Caso não tenha erros
        //Redirecionar para o listar
        header("location: listar.php");
        exit;
    } else { //Em caso de erros, exibí-los
        $msgErro = implode("<br>", $erros);
        //print_r($erros);
    }

} else {
    //Usuário apenas entrou na página para alterar
    $idJogador = 0;
    if(isset($_GET['idJogador']))
        $idJogador = $_GET['idJogador'];
    
    $jogador = $jogadorCont->buscarPorId($idJogador);
    if(! $jogador) {
        echo "Jogador não encontrado!<br>";
        echo "<a href='listar.php'>Voltar</a>";
        exit;
    }

}

//Inclui o formulário
include_once(__DIR__ . "/form.php");
