<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/BrechoDAO.php");
require_once(__DIR__ . "/../dao/ProdutoDAO.php");
require_once(__DIR__ . "/../dao/ImagemDAO.php");

class HomeController extends Controller {

    private BrechoDAO $brechoDao;
    private ProdutoDAO $produtoDao;
    private ImagemDAO $imagemDao;

    public function __construct() {
        //Testar se o usuário está logado
        if(! $this->usuarioLogado()) {
            exit;
        }

        //Criar o objeto do UsuarioDAO
        $this->brechoDao = new BrechoDAO();
        $this->produtoDao = new ProdutoDAO();
        $this->imagemDao = new ImagemDAO();

        $this->handleAction();       
    }

    protected function home() {
        $listaBrecho = $this->brechoDao->list();    
        $produtos = $this->produtoDao->listDisp();
        $imagens = Array();
        $dados["listaBrechos"] = $listaBrecho;
        $dados["produtos"] = $produtos;
        foreach($produtos as $p){
            $img = $this->imagemDao->findOneImageFromProduto($p->getId());
           array_push($imagens, $img); 
        }

        $dados["imagens"] = $imagens; 
        //echo "<pre>" . print_r($dados, true) . "</pre>";
        $this->loadView("home/home.php", $dados);
    }

}

//Criar o objeto da classe HomeController
new HomeController();
