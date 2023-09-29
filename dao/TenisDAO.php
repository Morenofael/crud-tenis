<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Esporte.php");
include_once(__DIR__ . "/../model/Marca.php");
include_once(__DIR__ . "/../model/Tenis.php");
class TenisDAO{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function list() {
        $sql = "SELECT * FROM `tenis`"; 
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBancoParaObjeto($result);
    }

    public function insert(Tenis $tenis) {
        $sql = "INSERT INTO tenis" . 
                " (nome, preco, id_marca, sexo, id_esporte)" .
                " VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tenis->getNome(), 
                        $tenis->getPreco(), 
                        $tenis->getMarca()->getId(),
                        $tenis->getSexo(),
                        $tenis->getEsporte()->getId()]);
    }

    private function mapBancoParaObjeto($result) {
        $teniss = array();

        foreach($result as $reg) {
            $tenis = new Tenis();
            $tenis->setId($reg['id'])
                ->setNome($reg['nome'])
                ->setPreco($reg['preco']);

            $marca = new Marca();
            $marca->setId($reg['id_marca'])
                ->setNome($reg['nome']);
            $tenis->setMarca($marca)
                    ->setSexo($reg["sexo"]);
            $esporte = new Esporte();
            $esporte->setId($reg['id_esporte'])
                    ->setNome($reg['nome']);
            $tenis->setEsporte($esporte);
            array_push($teniss, $tenis);
        }

        return $teniss;
    }
}