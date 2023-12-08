<?php 
//Controller para Aluno

require_once(__DIR__ . "/../dao/JogadorDAO.php");
require_once(__DIR__ . "/../model/Jogador.php");
require_once(__DIR__ . "/../service/JogadorService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");

class JogadorController {

    private $jogadorDAO;
    private $jogadorService;
    private $arquivoService;

    public function __construct() {
        $this->jogadorDAO = new JogadorDAO();        
        $this->jogadorService = new JogadorService();
        $this->arquivoService = new ArquivoService();
    }

    public function listar() {
        return $this->jogadorDAO->list();    
    }

    public function atualizar(Jogador $jogador){
        $erros = $this->jogadorService->validarDados($jogador);
        if($erros){return $erros;}
        
        
        $this->jogadorDAO->update($jogador);
        return array();
        
    }

    public function excluirPorId(int $id){
        return $this->jogadorDAO->deleteById($id);
    }

    public function buscarPorId(int $id) {
        return $this->jogadorDAO->findById($id);
    }

    public function inserir(Jogador $jogador, $arquivoFoto) {
        //Valida e retorna os erros caso existam
        $erros = $this->jogadorService->validarDados($jogador);
        if($erros) 
            return $erros;
		
		//salva foto
		$nomeArquivo = $this->arquivoService->salvarArquivo($arquivoFoto);
        $jogador->setImgFoto($nomeArquivo);
        
        //Persiste o objeto e retorna um array vazio
        $this->jogadorDAO->insert($jogador);
        return array();
    }
}
