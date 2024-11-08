<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/EnderecoDAO.php");
require_once(__DIR__ . "/../model/Endereco.php");
require_once(__DIR__ . "/../service/EnderecoService.php");

class EnderecoController extends Controller {

    private EnderecoDAO $enderecoDao;
    private EnderecoService $enderecoService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {
        if(! $this->usuarioLogado())
            exit;

        $this->enderecoDao = new EnderecoDAO();
        $this->enderecoService = new EnderecoService();

        $this->handleAction();
    }
    
    protected function list() {
        $enderecos = $this->enderecoDao->listFromUsuario($_SESSION[SESSAO_USUARIO_ID]);
        //print_r($usuarios);
        $dados["lista"] = $enderecos;

        $this->loadView("endereco/list.php", $dados);
    }
    /*
    protected function display(){
        //DAR id depois do edit
        $id = $_GET['id'];
        $dados["brecho"] = $this->brechoDao->findById($id);
        $dados["produtos"] = $this->produtoDao->listByBrecho($dados["brecho"]->getId());
        $this->loadView("brecho/brecho.php", $dados);
    }*/
    protected function save() {
            //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $numero = trim($_POST['numero']) ? trim($_POST['numero']) : NULL;
        $cep = trim($_POST['cep']) ? trim($_POST['cep']) : NULL;
        $logradouro = trim($_POST['logradouro']) ? trim($_POST['logradouro']) : NULL;
        $complemento = trim($_POST['complemento']) ? trim($_POST['complemento']) : NULL;
        $bairro = trim($_POST['bairro']) ? trim($_POST['bairro']) : NULL;
        $municipio = trim($_POST['municipio']) ? trim($_POST['municipio']) : NULL;
        $uf = trim($_POST['uf']) ? trim($_POST['uf']) : NULL;
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];

        //Cria objeto Endereco 
        $endereco = new Endereco();
        $endereco->setCep($cep);
        $endereco->setNumero($numero);
        $endereco->setLogradouro($logradouro);
        $endereco->setComplemento($complemento);
        $endereco->setBairro($bairro);
        $endereco->setMunicipio($municipio);
        $endereco->setUf($uf);
        $endereco->setIdUsuario($idUsuario);
        //Validar os dados
        $erros = $this->enderecoService->validarDados($endereco);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id"] == 0){  //Inserindo
                    $this->enderecoDao->insert($endereco);
                    header("location: ./HomeController.php?action=home");

                }
                else { //Alterando
                    $endereco->setId($dados["id"]);
                    $this->enderecoDao->update($endereco);
                    header("location: ./HomeController.php?action=home");
                }

                header("location: ./HomeController.php?action=home");
            } catch (PDOException $e) {
                print_r($e);
                array_push($erros, "[Erro ao salvar o endereco na base de dados.]");                
            }
        }

        //Se há erros, volta para o formulário
        
        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["endereco"] = $endereco;
        
        $msgsErro = implode("<br>", $erros);
        $this->loadView("endereco/form.php", $dados, $msgsErro);
     }

    //Método create
    protected function create() {
        //echo "Chamou o método create!";
        $dados["id"] = 0;
        $this->loadView("endereco/form.php", $dados);
    }

    //Método edit
    protected function edit() {
        $endereco = $this->findEnderecoById();
        if(! $endereco){
            echo "Endereco não encontrado";
        }elseif($endereco->getIdUsuario() == $_SESSION[SESSAO_USUARIO_ID]) {
            
            //Setar os dados
            $dados["id"] = $endereco->getId();
            $dados["endereco"] = $endereco;

            $this->loadView("endereco/form.php", $dados);
        }else{
            echo "405 Forbidden";
            exit;
        }
    }

    //Método para excluir
    protected function delete() {
        $endereco = $this->findEnderecoById();
        if($endereco) {
            if($endereco->getIdUsuario() == $_SESSION[SESSAO_USUARIO_ID]){
                $this->enderecoDao->deleteById($endereco->getId());
                $this->list("", "Usuário excluído com sucesso!");
            }else{
                echo "405 forbidden";
            }
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Endereco não encontrado!");

        }               
     }

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

     private function findEnderecoById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $endereco = $this->enderecoDao->findById($id);
        return $endereco;
    }

}


#Criar objeto da classe para assim executar o construtor
new EnderecoController();
