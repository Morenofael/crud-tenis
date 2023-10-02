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
                " m.nome AS nome_marca, m.nacionalidade AS nacionalidade_marca, e.nome AS nome_esporte" . 
                " FROM tenis t" .
                " JOIN marcas m ON (m.id = t.id_marca) JOIN esportes e ON (e.id = t.id_esporte)" .
                " ORDER BY t.nome";
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

    public function update(Tenis $tenis) {
        $conn = Connection::getConnection();

        $sql = "UPDATE tenis SET nome = ?, preco = ?,". 
            " id_marca = ?, sexo = ?, id_esporte = ?".
            " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$tenis->getNome(), $tenis->getPreco(), 
                        $tenis->getMarca()->getId(), $tenis->getSexo(),
                        $tenis->getEsporte()->getId(), $tenis->getId()]);
    }

    public function deleteById(int $id) {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM tenis WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function findById(int $id) {
        $conn = Connection::getConnection();

        $sql = "SELECT t.*," . 
                " m.nome AS nome_marca, m.nacionalidade AS nacionalidade_marca, e.nome AS nome_esporte" . 
                " FROM tenis t" .
                " JOIN marcas m ON (m.id = t.id_marca) JOIN esportes e ON (e.id = t.id_esporte)" .
                " WHERE t.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();

        //Criar o objeto Aluno
        $alunos = $this->mapBancoParaObjeto($result);

        if(count($alunos) == 1)
            return $alunos[0];
        elseif(count($alunos) == 0)
            return null;

        die("AlunoDAO.findById - Erro: mais de um aluno".
                " encontrado para o ID " . $id);
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
                ->setNome($reg['nome_marca'])
                ->setNacionalidade(($reg['nacionalidade_marca']));
            $tenis->setMarca($marca)
                    ->setSexo($reg["sexo"]);
            $esporte = new Esporte();
            $esporte->setId($reg['id_esporte'])
                    ->setNome($reg['nome_esporte']);
            $tenis->setEsporte($esporte);
            array_push($teniss, $tenis);
        }

        return $teniss;
    }
}