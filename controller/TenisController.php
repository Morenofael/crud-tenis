<?php 
//Controller para Aluno

require_once(__DIR__ . "/../dao/TenisDAO.php");
require_once(__DIR__ . "/../model/Tenis.php");
require_once(__DIR__ . "/../service/TenisService.php");

class TenisController {

    private $tenisDAO;
    private $tenisService;

    public function __construct() {
        $this->tenisDAO = new TenisDAO();        
        $this->tenisService = new TenisService();
    }

    public function listar() {
        return $this->tenisDAO->list();        
    }

    public function atualizar(Tenis $tenis){
        $erros = $this->tenisService->validarDados($tenis);
        if($erros){return $erros;}
            
        $this->tenisDAO->update($tenis);
        return array();
        
    }

    public function excluirPorId(int $id){
        return $this->tenisDAO->deleteById($id);
    }

    public function buscarPorId(int $id) {
        return $this->tenisDAO->findById($id);
    }

    public function inserir(Tenis $tenis) {
        //Valida e retorna os erros caso existam
        $erros = $this->tenisService->validarDados($tenis);
        if($erros) 
            return $erros;

        //Persiste o objeto e retorna um array vazio
        $this->tenisDAO->insert($tenis);
        return array();
    }
}