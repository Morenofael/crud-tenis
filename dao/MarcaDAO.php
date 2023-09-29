<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Marca.php");

class MarcaDAO{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }
    public function list() {
        $sql = "SELECT * FROM marcas";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBancoParaObjeto($result);
    }
    private function mapBancoParaObjeto($result) {
        $marcas = array();
        foreach($result as $reg) {
            $m = new Marca();
            $m->setId($reg['id'])
                ->setNome($reg['nome'])
                ->setNacionalidade($reg['nacionalidade']);
            array_push($marcas, $m);
        }
}
}