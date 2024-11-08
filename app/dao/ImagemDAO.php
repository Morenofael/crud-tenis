<?php

include_once (__DIR__ . "/../connection/Connection.php");
include_once (__DIR__ . "/../model/Imagem.php");

class ImagemDAO
{
    public function insert(Imagem $imagem)
    {
        $conn = Connection::getConn();

        $sql =
            "INSERT INTO imagens (id_produto, arquivo)" .
            "VALUES (:id_produto, :arquivo_nome)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_produto", $imagem->getIdProduto());
        $stm->bindValue("arquivo_nome", $imagem->getArquivoNome());
        $stm->execute();
    }

    public function listByProduto($idProduto)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM imagens WHERE id_produto = :id_produto ";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_produto", $idProduto);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapImagens($result);
    }

    public function findOneImageFromProduto($idProduto)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM imagens WHERE id_produto = :id_produto LIMIT 1";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_produto", $idProduto);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapImagens($result);
    }
    private function mapImagens($result)
    {
        $imagens = [];
        foreach ($result as $reg) {
            $imagem = new Imagem();
            $imagem->setId($reg["id"]);
            $imagem->setIdProduto($reg["id_produto"]);
            $imagem->setArquivoNome($reg["arquivo"]);

            array_push($imagens, $imagem);
        }

        return $imagens;
    }
}
