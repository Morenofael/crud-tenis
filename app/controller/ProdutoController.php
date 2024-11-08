<?php
#Classe controller para Produto
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/ProdutoDAO.php");
require_once(__DIR__ . "/../model/Produto.php");
require_once(__DIR__ . "/../service/ProdutoService.php");
require_once(__DIR__ . "/../dao/BrechoDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/ImagemDAO.php");
require_once(__DIR__ . "/../service/ArquivoService.php");

class ProdutoController extends Controller {

    private ProdutoDAO $produtoDao;
    private ProdutoService $produtoService;
    private BrechoDAO $brechoDao;
    private UsuarioDAO $usuarioDao;
    private ImagemDAO $imagemDao;
    private ArquivoService $arquivoService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {
        if(! $this->usuarioLogado())
            exit;

        $this->produtoDao = new ProdutoDAO();
        $this->produtoService = new ProdutoService();
        $this->brechoDao = new BrechoDAO();
        $this->usuarioDao = new UsuarioDAO();
        $this->imagemDao = new ImagemDAO();
        $this->arquivoService = new ArquivoService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        if(! $this->usuarioLogado())
            header("location: HomeController.php?action=home");
        
        $dados["lista"] = $this->produtoDao->listDisp();
        $dados["imagens"] = Array();
        foreach($dados["lista"] as $p){
            array_push($dados["imagens"], $this->imagemDao->findOneImageFromProduto($p->getId()));
        } 
        $this->loadView("produto/list.php", $dados);
    }
    
    protected function listByGenero(){
        if($_GET["g"]){
            $genero = $_GET["g"];
        }else{
            echo "Gênero não encontrado";
            exit;
        }

        $dados["lista"] = $this->produtoDao->listByGenero($genero);
        $dados["imagens"] = Array();
        foreach($dados["lista"] as $p){
            array_push($dados["imagens"], $this->imagemDao->findOneImageFromProduto($p->getId()));
        } 
        $this->loadView("produto/list.php", $dados);
    }

    protected function listCurtidas(){

    }

    protected function display(){
        //DAR id depois do edit
        $id = $_GET['id'];
        $dados["produto"] = $this->produtoDao->findById($id);
        $dados["generoString"] = $this->produtoService->generoCharToString($dados["produto"]->getGenero());
        $dados["vendedor"] = $this->usuarioDao->findByIdBrecho($dados["produto"]->getIdBrecho());
        $dados["imagens"] = $this->imagemDao->listByProduto($id);
        $this->loadView("produto/produto.php", $dados);
    }

    protected function save() {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $preco = trim($_POST['preco']) ? trim($_POST['preco']) : NULL;
        $descricao = trim($_POST['descricao']) ? trim($_POST['descricao']) : NULL;
        $genero = trim($_POST['genero']) ? trim($_POST['genero']) : NULL;
        $tags = trim($_POST['tags']) ? trim($_POST['tags']) : NULL;
        $brecho = $this->brechoDao->findByIdUsuario($_SESSION[SESSAO_USUARIO_ID]);
		
        //Cria objeto Produto 
        $produto = new Produto();
        $produto->setNome($nome);
        $produto->setPreco($preco);
        $produto->setDescricao($descricao);
        $produto->setGenero($genero);
        $produto->setTags($tags);
        $produto->setIdBrecho($brecho->getId());
        //Validar dados
        $erros = $this->produtoService->validarDados($produto);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id"] == 0){  //Inserindo
                    if($_FILES["imagem"]['error'][0] != 4){
                        $this->produtoDao->insert($produto);
                    }else{
                        echo "Pelo menos uma imagem deve ser inserida.";
                        exit;
                    }
                        
                    $arquivoImg = $_FILES["imagem"]; //'imagem' é o 'name' do input
                    $totalArquivos = count($arquivoImg['name']);
                    for($i = 0; $i < $totalArquivos; $i++){
                        $arquivoNome = $this->arquivoService->salvarImagem($arquivoImg, $i);
                        $imagem = new Imagem();
                        $imagem->setIdProduto($this->produtoDao->getLastProdutoFromBrecho($brecho->getId())->getId()); 
                        $imagem->setArquivoNome($arquivoNome);
                        $this->imagemDao->insert($imagem);
                    }
                    header("location: ./BrechoController.php?action=display&id=" . $produto->getIdBrecho());
                }
                else { //Alterando
                    $produto->setId($dados["id"]);
                    $this->produtoDao->update($produto);
                    header("location: ./ProdutoController.php?action=display&id=" . $produto->getId());
                }

            } catch (PDOException $e) {
                print_r($e);
                array_push($erros, "[Erro ao salvar o produto na base de dados.]");                
            }
        }

        //Se há erros, volta para o formulário
        
        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["produto"] = $produto;
        
        $msgsErro = implode("<br>", $erros);
        $this->loadView("produto/form.php", $dados, $msgsErro);
     }

    //Método create
    protected function create() {
        //echo "Chamou o método create!";

        $dados["id"] = 0;
        $this->loadView("produto/form.php", $dados);
    }

    //Método edit
    protected function edit() {
        $produto = $this->findProdutoById();
        if(! $produto){
            $this->list("Produto não encontrado");
        }elseif($this->usuarioDao->findByIdBrecho($produto->getIdbrecho())->getId() == $_SESSION[SESSAO_USUARIO_ID]) {
            
            //Setar os dados
            $dados["id"] = $produto->getId();
            $dados["produto"] = $produto;

            $this->loadView("produto/form.php", $dados);
        }else{
            echo "405 Forbidden";
            exit;
        }
    }

    //Método para excluir
    protected function delete() {
        $produto = $this->findProdutoById();
        if($produto) {
            //Excluir
            $this->produtoDao->deleteById($produto->getId());
            $this->list("", "Usuário excluído com sucesso!");
            header("location: ./BrechoController.php?action=display&id=" . $produto->getIdBrecho());
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Usuário não encontrado!");

        }               
     }

   /* protected function listJson() {/*
        $listaUsuarios = $this->usuarioDao->list();
        $json = json_encode($listaUsuarios);
        echo $json;
     }

    //Método para buscar o usuário com base no ID recebido por parâmetro GET
     */ 
       private function findProdutoById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $produto = $this->produtoDao->findById($id);
        return $produto;
    }

}


#Criar objeto da classe para assim executar o construtor
new ProdutoController();
