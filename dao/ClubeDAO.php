<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Esporte.php");
include_once(__DIR__ . "/../model/Clube.php");

class ClubeDAO{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }
    public function list() {
        $sql = "SELECT * FROM clubes";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBancoParaObjeto($result);
    }
    private function mapBancoParaObjeto($result) {
        $clubes = array();
        foreach($result as $reg) {
            $c = new Clube();
            $c->setId($reg['id'])
                ->setNome($reg['nome'])
                ->setAbrev($reg['abrev']);
                $esporte = new Esporte();
                $esporte->setId($reg['id_esporte']);
                
            $c->setEsporte($esporte);
            array_push($clubes, $c);
        }
        return $clubes;
}
}
