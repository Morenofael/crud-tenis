<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/UsuarioPapel.php");

class UsuarioController extends Controller {

    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;
    private ArquivoService $arquivoService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {
        //if(! $this->usuarioLogado())
        //    exit;

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->arquivoService = new ArquivoService();

        $this->handleAction();
    }

    protected function display(){
        //DAR id depois do edit
        if(! $this->usuarioLogado())
            exit;
        $id = $_GET['id'];
        $dados["usuario"] = $this->usuarioDao->findById($id);
        $this->loadView("usuario/usuario.php", $dados);
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        if(! $this->usuarioLogado() || $_SESSION[SESSAO_USUARIO_PAPEL] != 1)
            header("location: HomeController.php?action=home");
        $usuarios = $this->usuarioDao->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function save() {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $email = trim($_POST['email']) ? trim($_POST['email']) : NULL;
        $login = trim($_POST['email']) ? trim($_POST['email']) : NULL;
        $senha = trim($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $confSenha = trim($_POST['conf_senha']) ? trim($_POST['conf_senha']) : NULL;
        $cpf = trim($_POST['cpf']) ? trim($_POST['cpf']) : NULL;
        $telefone = trim($_POST['telefone']) ? trim($_POST['telefone']) : NULL;
        $dataNascimento = trim($_POST['data_nascimento']) ? trim($_POST['data_nascimento']) : NULL;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setLogin($login);
        $usuario->setSenha($senha);
        $usuario->setCpf($cpf);
        $usuario->setTelefone($telefone);
        $usuario->setDataNascimento($dataNascimento);
        $usuario->setNivelAcesso(0); //usuário comum
        $usuario->setSituacao(1); //usuário ativo
        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id"] == 0)  //Inserindo
                    $this->usuarioDao->insert($usuario);
                else { //Alterando
                    $usuario->setId($dados["id"]);
                    $this->usuarioDao->update($usuario);
                }

                $msg = "Usuário salvo com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                print_r($e);
                array_push($erros, "[Erro ao salvar o usuário na base de dados.]");                
            }
        }

        //Se há erros, volta para o formulário
        
        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["confSenha"] = $confSenha;
        $dados["papeis"] = UsuarioPapel::getAllAsArray();
        
        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/form.php", $dados, $msgsErro);
    }
    
    public function insertAlterPfP(){
        if(! $this->usuarioLogado())
            exit;
        $dados = [];
        $arquivoImg = $_FILES["imagem"];
        if($arquivoImg){
            $arquivoNome = $this->arquivoService->salvarImagem($arquivoImg, 0);
            $this->usuarioDao->editPfP($arquivoNome);
            header("location: ./UsuarioController.php?action=display&id=" . $_SESSION[SESSAO_USUARIO_ID]);
        }
        $this->loadView("usuario/foto-perfil-form.php", $dados);
    }
    //Método create
    protected function create() {
        //echo "Chamou o método create!";
        
        $dados["id"] = 0;
        $dados["papeis"] = UsuarioPapel::getAllAsArray(); 
        $this->loadView("usuario/form.php", $dados);
    }

    //Método edit
    protected function edit() {
        $usuario = $this->findUsuarioById();
        
        if($usuario) {
            $usuario->setSenha("");
            
            //Setar os dados
            $dados["id"] = $usuario->getId();
            $dados["usuario"] = $usuario;
            $dados["papeis"] = UsuarioPapel::getAllAsArray(); 

            $this->loadView("usuario/form.php", $dados);
        } else 
            $this->list("Usuário não encontrado");
    }

    //Método para excluir
    protected function delete() {
        $usuario = $this->findUsuarioById();
        if($usuario) {
            //Excluir
            $this->usuarioDao->deleteById($usuario->getId());
            $this->list("", "Usuário excluído com sucesso!");
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Usuário não encontrado!");

        }               
    }

    protected function listJson() {
        $listaUsuarios = $this->usuarioDao->list();
        $json = json_encode($listaUsuarios);
        echo $json;
    }

    //Método para buscar o usuário com base no ID recebido por parâmetro GET
    private function findUsuarioById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $usuario = $this->usuarioDao->findById($id);
        return $usuario;
    }

}


#Criar objeto da classe para assim executar o construtor
new UsuarioController();
