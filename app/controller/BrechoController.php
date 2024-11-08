<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/BrechoDAO.php");
require_once(__DIR__ . "/../dao/ProdutoDAO.php");
require_once(__DIR__ . "/../model/Brecho.php");
require_once(__DIR__ . "/../service/BrechoService.php");

class BrechoController extends Controller {

    private BrechoDAO $brechoDao;
    private ProdutoDAO $produtoDao;
    private BrechoService $brechoService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {
        if(! $this->usuarioLogado())
            exit;

        $this->brechoDao = new BrechoDAO();
        $this->brechoService = new BrechoService();
        $this->produtoDao = new ProdutoDAO();
        //$this->usuarioService = new UsuarioService();

        $this->handleAction();
    }
    
    /*protected function list(string $msgErro = "", string $msgSucesso = "") {
        if(! $this->usuarioLogado() || $_SESSION[SESSAO_USUARIO_PAPEL] != 1)
            header("location: HomeController.php?action=home");
        $usuarios = $this->usuarioDao->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados, $msgErro, $msgSucesso);
    }*/
    protected function display(){
        //DAR id depois do edit
        $id = $_GET['id'];
        $dados["brecho"] = $this->brechoDao->findById($id);
        $dados["produtos"] = $this->produtoDao->listByBrecho($dados["brecho"]->getId());
        $this->loadView("brecho/brecho.php", $dados);
    }
    protected function save() {
            //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $descricao = trim($_POST['descricao']) ? trim($_POST['descricao']) : NULL;
        $chavePix = trim($_POST['chavePix']) ? trim($_POST['chavePix']) : NULL;
        $id_usuario = $_SESSION[SESSAO_USUARIO_ID];

        //Cria objeto Usuario
        $brecho = new Brecho();
        $brecho->setNome($nome);
        $brecho->setDescricao($descricao);
        $brecho->setChavePix($chavePix);
        $brecho->setId_usuario($id_usuario);
        //Validar os dados
        $erros = $this->brechoService->validarDados($brecho);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id"] == 0){  //Inserindo
                    $this->brechoDao->insert($brecho);
                    header("location: ./HomeController.php?action=home");

                }
                else { //Alterando
                    $brecho->setId($dados["id"]);
                    $this->brechoDao->update($brecho);
                    header("location: ./BrechoController.php?action=display&id=" . $brecho->getId());
                }

                header("location: ./HomeController.php?action=home");
            } catch (PDOException $e) {
                //print_r($e);
                array_push($erros, "[Erro ao salvar o brechó na base de dados.]");                
            }
        }

        //Se há erros, volta para o formulário
        
        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["brecho"] = $brecho;
        
        $msgsErro = implode("<br>", $erros);
        $this->loadView("brecho/form.php", $dados, $msgsErro);
     }

    //Método create
    protected function create() {
        //echo "Chamou o método create!";

        if($this->brechoService->verificarExistente($_SESSION[SESSAO_USUARIO_ID])){
            $brechoId = $this->brechoDao->findByIdUsuario($_SESSION[SESSAO_USUARIO_ID])->getId();
            header("location: ./BrechoController.php?action=display&id=" . $brechoId);
        }
        $dados["id"] = 0;
        $this->loadView("brecho/form.php", $dados);
    }

    //Método edit
    protected function edit() {
        $brecho = $this->findBrechoById();
        if(! $brecho){
            echo "Brechó não encontrado";
        }elseif($brecho->getId_usuario() == $_SESSION[SESSAO_USUARIO_ID]) {
            
            //Setar os dados
            $dados["id"] = $brecho->getId();
            $dados["nome"] = $brecho->getNome();
            $dados["descricao"] = $brecho->getDescricao();

            $this->loadView("brecho/form.php", $dados);
        }else{
            echo "405 Forbidden";
            exit;
        }
    }

    //Método para excluir
    protected function delete() {/*
        $usuario = $this->findUsuarioById();
        if($usuario) {
            //Excluir
            $this->usuarioDao->deleteById($usuario->getId());
            $this->list("", "Usuário excluído com sucesso!");
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Usuário não encontrado!");

        }               
     */}

    protected function listJson() {/*
        $listaUsuarios = $this->usuarioDao->list();
        $json = json_encode($listaUsuarios);
        echo $json;
     */}

    //Método para buscar o usuário com base no ID recebido por parâmetro GET
    private function findUsuarioById() {/*
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $usuario = $this->usuarioDao->findById($id);
        return $usuario;
     */}

     private function findBrechoById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $brecho = $this->brechoDao->findById($id);
        return $brecho;
    }

}


#Criar objeto da classe para assim executar o construtor
new BrechoController();
