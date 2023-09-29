<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Esporte.php");

class EsporteDAO{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }
    public function list() {
        $sql = "SELECT * FROM esportes";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBancoParaObjeto($result);
    }
    private function mapBancoParaObjeto($result) {
        $esportes = array();
        foreach($result as $reg) {
            $e = new Esporte();
            $e->setId($reg['id'])
                ->setNome($reg['nome']);
            array_push($esportes, $e);
        }
        return $esportes;
}
}