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
        $sql = "SELECT t.*," . 
                " m.nome AS nome_marca, m.nacionalidade AS nacionalidade_marca" . 
                " FROM tenis t" .
                " JOIN marcas m ON (m.id = t.id_marca)" .
                " e.nome AS nome_esporte" . 
                " FROM tenis t" .
                " JOIN esportes e ON (e.id = t.id_esporte)" . 
                " ORDER BY a.nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBancoParaObjeto($result);
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

    private function mapBancoParaObjeto($result) {
        $teniss = array();

        foreach($result as $reg) {
            $tenis = new Tenis();
            $tenis->setId($reg['id'])
                ->setNome($reg['nome'])
                ->setTamanho($reg['tamanho'])
                ->setPreco($reg['preco']);

            $marca = new Marca();
            $marca->setId($reg['id_marca'])
                ->setNome($reg['nome_curso'])
                ->setNacionalidade($reg['nacionalidade_marca']);            
            $tenis->setMarca($marca)
                    ->setSexo($reg["sexo"]);
            $esporte = new Esporte();
            $esporte->setId($reg['id_esporte'])
                    ->setNome($reg['nome_esporte']);
            $tenis->setEsporte($esporte);
            array_push($alunoss, $tenis);
        }

        return $teniss;
    }
}