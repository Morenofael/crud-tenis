<?php
#Nome do arquivo: ProdutoDAO.php
#Objetivo: classe DAO para o model de Produto

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Produto.php");

class ProdutoDAO {

    //Método para listar os produtos a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produtos p ";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapProdutos($result);
    }

    public function listDisp() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produtos p WHERE disponivel = 1";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapProdutos($result);
    }

    public function listByGenero($genero) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produtos p WHERE genero = :genero AND disponivel = 1";
        $stm = $conn->prepare($sql);
        $stm->bindValue("genero", $genero); 
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapProdutos($result);
    }

    public function listByBrecho(int $idBrecho){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produtos p " . 
            " WHERE id_brecho = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$idBrecho]);
        $result = $stm->fetchAll();
        
        return $this->mapProdutos($result);

    }

    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produtos p" .
               " WHERE p.id = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $produtos = $this->mapProdutos($result);

        if(count($produtos) == 1)
            return $produtos[0];
        elseif(count($produtos) == 0)
            return null;

        die("ProdutoDAO.findById()" . 
            " - Erro: mais de um produto encontrado.");
    }



    //Método para inserir um Produto
    public function insert(Produto $produto) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO produtos (id_brecho, nome, preco, descricao, genero, tags)" .
               " VALUES (:id_brecho, :nome, :preco, :descricao, :genero, :tags)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_brecho", $produto->getIdBrecho());
        $stm->bindValue("nome", $produto->getNome());
        $stm->bindValue("preco", $produto->getPreco());
        $stm->bindValue("descricao", $produto->getDescricao());
        $stm->bindValue("genero", $produto->getGenero());
        $stm->bindValue("tags", $produto->getTags());
        $stm->execute();
    }

    //Método para atualizar um Produto
    public function update(Produto $produto) {
        $conn = Connection::getConn();

        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao," . 
               " preco = :preco, genero = :genero, tags = :tags" .   
               " WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $produto->getNome());
        $stm->bindValue("descricao", $produto->getDescricao());
        $stm->bindValue("preco", $produto->getPreco());
        $stm->bindValue("genero", $produto->getGenero());
        $stm->bindValue("tags", $produto->getTags());
        $stm->bindValue("id", $produto->getId());
        $stm->execute();
    }
    
    public function updateDisp(Produto $produto, int $disp){
        $conn = Connection::getConn();
        $sql = "UPDATE produtos SET disponivel = :disp " .
            " WHERE id = :id";
            
        $stm = $conn->prepare($sql);
        $stm->bindValue("disp", $disp);
        $stm->bindValue("id", $produto->getId());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM produtos WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function getLastProdutoFromBrecho($brechoId) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produtos WHERE id_brecho = :id_brecho " .
           "ORDER BY ID DESC LIMIT 1 ";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_brecho", $brechoId);
        $stm->execute();
        $result = $stm->fetchAll();

        $produtos = $this->mapProdutos($result);
        
        if(count($produtos) == 1)
            return $produtos[0];
        elseif(count($produtos) == 0)
            return null;

        die("ProdutoDAO.findById()" . 
            " - Erro: mais de um produto encontrado.");
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapProdutos($result) {
        $produtos = array();
        foreach ($result as $reg) {
            $produto = new Produto();
            $produto->setId($reg['id']);
            $produto->setIdBrecho($reg['id_brecho']);
            $produto->setNome($reg['nome']);
            $produto->setPreco($reg['preco']);
            $produto->setDescricao($reg['descricao']);
            $produto->setGenero($reg['genero']);
            $produto->setTags($reg['tags']);
            array_push($produtos, $produto);
        }

        return $produtos;
    }

}
