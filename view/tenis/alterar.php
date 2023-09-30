<?php 

require_once(__DIR__ . "/../../controller/TenisController.php");
require_once(__DIR__ . "/../../model/Tenis.php");
require_once(__DIR__ . "/../../model/Marca.php");
require_once(__DIR__ . "/../../model/Esporte.php");

$msgErro = '';
$tenis = null;

$tenisCont = new TenisController();

if(isset($_POST['submetido'])) {
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $preco = is_numeric($_POST['preco']) ? $_POST['preco'] : null;
    $idMarca = is_numeric($_POST['marca']) ? $_POST['marca'] : null;
    $sexo = trim($_POST['sexo']) ? trim($_POST['sexo']) : null;
    $idEsporte = is_numeric($_POST['esporte']) ? $_POST['esporte'] : null;
    
    //para persistencia
    $tenis = new Tenis();
    $tenis->setNome($nome);
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
    $erros = $tenisCont->atualizar($tenis);

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
    $idTenis = 0;
    if(isset($_GET['idTenis']))
        $idTenis = $_GET['idTenis'];
    
    $tenis = $tenisCont->buscarPorId($idTenis);
    if(! $tenis) {
        echo "Tenis não encontrado!<br>";
        echo "<a href='listar.php'>Voltar</a>";
        exit;
    }

}

//Inclui o formulário
include_once(__DIR__ . "/form.php");