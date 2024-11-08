<?php
#Nome do arquivo: PedidoDAO.php
#Objetivo: classe DAO para o model de Pedido 

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Pedido.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../model/Produto.php");
include_once(__DIR__ . "/../model/Endereco.php");

class PedidoDAO{

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT p.*, " .
                " uv.nome AS nome_vendedor , uv.email AS email_vendedor, uv.cpf AS cpf_vendedor, uv.telefone AS telefone_vendedor, uv.data_nascimento AS data_nascimento_vendedor, uv.situacao AS situacao_vendedor, uv.foto_perfil AS foto_perfil_vendedor,  " .
                " uc.nome AS nome_comprador , uc.email AS email_comprador, uc.cpf AS cpf_comprador, uc.telefone AS telefone_comprador, uc.data_nascimento AS data_nascimento_comprador, uc.situacao AS situacao_comprador, uc.foto_perfil AS foto_perfil_comprador,  " .
                " prod.id_brecho AS id_brecho_produto , prod.nome AS nome_produto, prod.descricao AS descricao_produto, prod.preco AS preco_produto, prod.genero AS genero_produto " .
                " FROM pedidos p " .
                " JOIN usuarios uv ON (uv.id = p.id_vendedor) JOIN usuarios uc ON (uc.id = p.id_comprador) JOIN produtos prod ON (prod.id = p.id_produto) " . 
               " WHERE p.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $pedidos = $this->mapPedidos($result);

        if(count($pedidos) == 1)
            return $pedidos[0];
        elseif(count($pedidos) == 0)
            return null;

        die("PedidoDAO.findById()" . 
            " - Erro: mais de um pedido encontrado.");
    }
    
    public function listFromComprador(){
        $conn = Connection::getConn();

        $sql = "SELECT p.*, " .
                " uv.nome AS nome_vendedor , uv.email AS email_vendedor, uv.cpf AS cpf_vendedor, uv.telefone AS telefone_vendedor, uv.data_nascimento AS data_nascimento_vendedor, uv.situacao AS situacao_vendedor, uv.foto_perfil AS foto_perfil_vendedor,  " .
                " uc.nome AS nome_comprador , uc.email AS email_comprador, uc.cpf AS cpf_comprador, uc.telefone AS telefone_comprador, uc.data_nascimento AS data_nascimento_comprador, uc.situacao AS situacao_comprador, uc.foto_perfil AS foto_perfil_comprador,  " .
                " prod.id_brecho AS id_brecho_produto , prod.nome AS nome_produto, prod.descricao AS descricao_produto, prod.preco AS preco_produto " .
                " FROM pedidos p " .
                " JOIN usuarios uv ON (uv.id = p.id_vendedor) JOIN usuarios uc ON (uc.id = p.id_comprador) JOIN produtos prod ON (prod.id = p.id_produto) " . 
               " WHERE p.id_comprador = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$_SESSION[SESSAO_USUARIO_ID]]);
        $result = $stm->fetchAll();
       
        $pedidos = $this->mapPedidos($result);
        return $pedidos;
    }

    public function findLastPedidoFromUser(int $idUsuario){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM pedidos WHERE id_comprador = ? ORDER BY id DESC" .
            " LIMIT 1";
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario]);
        $result = $stm->fetchAll();
       
        $pedidos = $this->mapPedidos($result);

        if(count($pedidos) == 1)
            return $pedidos[0];
        elseif(count($pedidos) == 0)
            return null;

        die("PedidoDAO.findById()" . 
            " - Erro: mais de um pedido encontrado.");
    }
   
    public function insert(Pedido $pedido) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO pedidos (data, id_vendedor, id_comprador, id_produto, valor_total)" .
               " VALUES (CURRENT_DATE, :id_vendedor, :id_comprador, :id_produto, :preco)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_vendedor", $pedido->getVendedor()->getId());
        $stm->bindValue("id_comprador", $pedido->getComprador()->getId());
        $stm->bindValue("id_produto", $pedido->getProduto()->getId());
        $stm->bindValue("preco", $pedido->getPreco());
        $stm->execute();
    }
    
    public function updateCaminhoComprovante($caminhoComprovante, $idPedido) {
        $conn = Connection::getConn();

        $sql = "UPDATE pedidos SET caminho_comprovante = :caminho_comprovante " .
               " WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("caminho_comprovante", $caminhoComprovante);
        $stm->bindValue("id", $idPedido);
        $stm->execute();
    }
    public function updateIdEndereco($idEndereco, $idPedido){
        $conn = Connection::getConn();

        $sql = "UPDATE pedidos SET id_endereco = :id_endereco" .
               " WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_endereco", $idEndereco);
        $stm->bindValue("id", $idPedido);
        $stm->execute();
    } 

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM pedidos WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapPedidos($result) {
        $pedidos = array();
        foreach ($result as $reg) {
            $pedido = new Pedido();
            $pedido->setId($reg['id']);
            $pedido->setData($reg['data']);
            $pedido->setStatus($reg['status']);

            $vendedor = new Usuario();
            $vendedor->setId($reg['id_vendedor']);
            $vendedor->setNome($reg['nome_vendedor']);
            $vendedor->setEmail($reg['email_vendedor']);
            $vendedor->setCpf($reg['cpf_vendedor']);
            $vendedor->setTelefone($reg['telefone_vendedor']);
            $vendedor->setDataNascimento($reg['data_nascimento_vendedor']);
            $vendedor->setSituacao($reg['situacao_vendedor']);
            $vendedor->setFotoPerfil($reg['foto_perfil_vendedor']);

            $pedido->setVendedor($vendedor);

            $comprador = new Usuario();
            $comprador->setId($reg['id_comprador']);
            $comprador->setNome($reg['nome_comprador']);
            $comprador->setEmail($reg['email_comprador']);
            $comprador->setCpf($reg['cpf_comprador']);
            $comprador->setTelefone($reg['telefone_comprador']);
            $comprador->setDataNascimento($reg['data_nascimento_comprador']);
            $comprador->setSituacao($reg['situacao_comprador']);
            $comprador->setFotoPerfil($reg['foto_perfil_comprador']);
            
            $pedido->setComprador($comprador);

            $produto = new Produto();
            $produto->setId($reg['id_produto']);
            $produto->setNome($reg['nome_produto']);
            $produto->setDescricao($reg['descricao_produto']);
            $produto->setPreco($reg['preco_produto']);
            $produto->setGenero($reg['genero_produto']);

            $pedido->setProduto($produto);
            
            $pedido->setidEnderecoEntrega($reg['id_endereco']);
             
            $pedido->setCaminhoComprovante($reg["caminho_comprovante"]);
            $pedido->setPreco($reg["valor_total"]); 
            
            array_push($pedidos, $pedido);
        }

        return $pedidos;
    }

}
