<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/CurtidaDAO.php");
require_once(__DIR__ . "/../dao/ProdutoDAO.php");
require_once(__DIR__ . "/../dao/ImagemDAO.php");
require_once(__DIR__ . "/../model/Curtida.php");

class CurtidaController extends Controller {

    private CurtidaDAO $curtidaDao;
    private ProdutoDAO $produtoDao;
    private ImagemDAO $imagemDao;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {
        if(! $this->usuarioLogado())
            exit;

        $this->curtidaDao = new CurtidaDAO();
        $this->produtoDao = new ProdutoDAO();
        $this->imagemDao = new ImagemDAO();
        //$this->usuarioService = new UsuarioService();

        $this->handleAction();
    }
    
    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $curtidas = $this->curtidaDao->listFromUsuario();
        $dados["lista"] = $curtidas;
        $dados["imagens"] = Array();
        foreach($dados["lista"] as $c){
            array_push($dados["imagens"], $this->imagemDao->findOneImageFromProduto($c->getProduto()->getId()));
        } 

        $this->loadView("curtida/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function save(){
        $idProduto = $_POST['idProduto'];
        $produto = $this->produtoDao->findById($idProduto);

        //Cria objeto Curtida
        $curtida = new Curtida();
        $curtida->setIdUsuario($_SESSION[SESSAO_USUARIO_ID]);
        $curtida->setProduto($produto);
        try {
            $this->curtidaDao->insert($curtida);
        }
        catch (PDOException $e) {
                print_r($e);
            }
        }
     

    //Método para excluir
    protected function delete() {
        $idProduto = $_POST['idProduto'];

        if($idProduto) {
            //Excluir
            $this->curtidaDao->deleteByProduto($idProduto);
        }     
     }

    private function findCurtidaById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $curtida = $this->curtidaDao->findById($id);
        return $curtida;
    }

    protected function listJsonFromUsuario() {
        $listaCurtidas = $this->curtidaDao->listFromUsuario();
        $json = json_encode($listaCurtidas);
        echo $json;
    }

}


#Criar objeto da classe para assim executar o construtor
new CurtidaController();
