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

    public function insert(Tenis $tenis) {
        $sql = "INSERT INTO tenis" . 
                " (nome, tamanho, preco, id_marca, sexo, id_esporte)" .
                " VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tenis->getNome(), $tenis->getTamanho(), 
                        $tenis->getPreco(), 
                        $tenis->getMarca()->getId(),
                        $tenis->getSexo(),
                        $tenis->getEsporte()->getId()]);
    }
}