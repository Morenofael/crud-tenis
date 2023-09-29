<?php
require_once(__DIR__ . "/../dao/EsporteDAO.php");
class EsporteController{
    private EsporteDAO $esporteDAO;

    public function __construct()
    {
        $this->esporteDAO = new EsporteDAO();
    }
    public function listar(){
        return $this->esporteDAO->list();
    }
}