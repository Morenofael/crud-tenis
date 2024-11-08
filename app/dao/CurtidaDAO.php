<?php

include_once (__DIR__ . "/../connection/Connection.php");
include_once (__DIR__ . "/../model/Curtida.php");
include_once (__DIR__ . "/../model/Produto.php");

class CurtidaDAO{
    public function insert(Curtida $curtida){
        $conn = Connection::getConn();

        $sql =
            "INSERT INTO curtidas (id_usuario, id_produto)" .
            "VALUES (:id_usuario, :id_produto)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_usuario", $_SESSION[SESSAO_USUARIO_ID]);
        $stm->bindValue("id_produto", $curtida->getProduto()->getId());
        $stm->execute();
    }

    public function listFromUsuario(){
        $conn = Connection::getConn();

        $sql = "SELECT c.*, " .
                " p.id_brecho AS id_brecho_produto , p.nome AS nome_produto, p.descricao AS descricao_produto, p.preco AS preco_produto, p.genero AS genero_produto, p.tags AS tags_produto " .
                " FROM curtidas c " .
                " JOIN produtos p ON (p.id = c.id_produto)" .
                "WHERE c.id_usuario = ? AND disponivel = 1";
        $stm = $conn->prepare($sql);
        $stm->execute([$_SESSION[SESSAO_USUARIO_ID]]);
        $result = $stm->fetchAll();
        $curtidas = $this->mapCurtidas($result);

        return $curtidas;
    }

    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT c.*, " .
                " p.id_brecho AS id_brecho_produto , p.nome AS nome_produto, p.descricao AS descricao_produto, p.preco AS preco_produto, p.genero AS genero_produto, p.tags AS tags_produto  " .
                " FROM curtidas c " .
                " JOIN produtos p ON (p.id = c.id_produto)" .
               " WHERE c.id = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $curtidas = $this->mapCurtidas($result);

        if(count($curtidas) == 1)
            return $curtidas[0];
        elseif(count($curtidas) == 0)
            return null;

        die("CurtidaDAO.findById()" . 
            " - Erro: mais de uma curtida encontrada.");
    }

    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM curtidas WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function deleteByProduto(int $idProduto){
        $conn = Connection::getConn();

        $sql = "DELETE FROM curtidas WHERE id_produto = :idProduto AND id_usuario = :idUsuario";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("idProduto", $idProduto);
        $stm->bindValue("idUsuario", $_SESSION[SESSAO_USUARIO_ID]);
        $stm->execute();
    }

    private function mapCurtidas($result){
        $curtidas = [];
        foreach ($result as $reg) {
            $curtida = new Curtida();
            $curtida->setId($reg["id"]);
            $curtida->setIdUsuario($reg["id_usuario"]);

            $produto = new Produto();
            $produto->setId($reg['id_produto']);
            $produto->setIdBrecho($reg["id_brecho_produto"]);
            $produto->setNome($reg['nome_produto']);
            $produto->setDescricao($reg['descricao_produto']);
            $produto->setPreco($reg['preco_produto']);
            $produto->setGenero($reg['genero_produto']);
            $produto->setTags($reg['tags_produto']);

            $curtida->setProduto($produto);

            array_push($curtidas, $curtida);
        }

        return $curtidas;
    }
}
