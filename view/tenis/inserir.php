<?php 
//View para inserir alunos

require_once(__DIR__ . "/../../controller/TenisController.php");
require_once(__DIR__ . "/../../model/Tenis.php");
require_once(__DIR__ . "/../../model/Marca.php");
require_once(__DIR__ . "/../../model/Esporte.php");

$msgErro = '';
$aluno = null;

if(isset($_POST['submetido'])) {
    //echo "clicou no gravar";
    //Captura os campo do formulário
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $tamanho = $_POST['tamanho'] ? $_POST['tamanho'] : null;
    $preco = is_numeric($_POST['preco']) ? $_POST['preco'] : null;
    $idMarca = is_numeric($_POST['marca']) ? $_POST['marca'] : null;
    $sexo = trim($_POST['sexo']) ? trim($_POST['sexo']) : null;
    $idEsporte = is_numeric($_POST['esporte']) ? $_POST['esporte'] : null;
    
    //para persistencia
    $tenis = new Tenis();
    $tenis->setNome($nome);
    $tenis->setTamanho($tamanho);
    $tenis->setPreco($preco);
    if($idMarca) {
        $marca = new Marca();
        $marca->setId($idMarca);
        $tenis->setMarca($marca);
    }
    $tenis->setSexo($sexo);
    if($idEsporte) {
        $esporte = new Esporte();
        $esporte->setId($idEsporte);
        $tenis->setEsporte($esporte);
    }

    $tenisCont = new TenisController();
    $erros = $tenisCont->inserir($tenis);

    if(! $erros) { //Caso não tenha erros
        //Redirecionar para o listar
        header("location: listar.php");
        exit;
    } else { //Em caso de erros, exibí-los
        $msgErro = implode("<br>", $erros);
        //print_r($erros);
    }
}


//Inclui o formulário
include_once(__DIR__ . "/form.php");