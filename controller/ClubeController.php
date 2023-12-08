<?php
require_once(__DIR__ . "/../dao/ClubeDAO.php");
class ClubeController{
    private ClubeDAO $clubeDAO;

    public function __construct()
    {
        $this->clubeDAO = new ClubeDAO();
    }
    public function listar(){
        return $this->clubeDAO->list();
    }
    public function listarPorEsporte(int $idEsporte){
    	return $this->clubeDAO->listByEsporte($idEsporte);
    }
}
