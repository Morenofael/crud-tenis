<?php
include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Brecho.php");
include_once(__DIR__ . "/../model/Usuario.php");

class BrechoDAO{

    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT b.*, " .
                " u.nome AS nome_usuario , u.email AS email, u.cpf AS cpf, u.telefone AS telefone, u.data_nascimento AS data_nascimento, u.situacao AS situacao, u.foto_perfil AS foto_perfil " .
                " FROM brechos b " . 
                " JOIN usuarios u ON (u.id = b.id_usuario) "; 
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapBrechos($result);
    }

    public function insert(Brecho $brecho) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO brechos (nome, descricao, chave_pix, data_criacao, id_usuario)" .
               " VALUES (:nome, :descricao, :chave_pix, CURRENT_DATE, :id_usuario)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $brecho->getNome());
        $stm->bindValue("descricao", $brecho->getDescricao());
        $stm->bindValue("chave_pix", $brecho->getChavePix());
        //$stm->bindValue("data_criacao", $brecho->getDataCriacao());
        $stm->bindValue("id_usuario", $brecho->getId_usuario());
        $stm->execute();
    }
    
    public function update(Brecho $brecho) {
        $conn = Connection::getConn();

        $sql = "UPDATE brechos SET nome = :nome, descricao = :descricao, chave_pix = :chave_pix" . 
               " WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $brecho->getNome());
        $stm->bindValue("descricao", $brecho->getDescricao());
        $stm->bindValue("chave_pix", $brecho->getChavePix());
        $stm->bindValue("id", $brecho->getId());
        $stm->execute();
    }

    public function findByIdUsuario(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM brechos b" .
               " WHERE b.id_usuario = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $brechos = $this->mapBrechos($result);

        if(count($brechos) == 1)
            return $brechos[0];
        elseif(count($brechos) == 0)
            return null;

        die("BrechoDAO.findById()" . 
            " - Erro: mais de um brechó encontrado.");
    }
    
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT b.*, " .
                " u.nome AS nome_usuario , u.email AS email, u.cpf AS cpf, u.telefone AS telefone, u.data_nascimento AS data_nascimento, u.situacao AS situacao, u.foto_perfil AS foto_perfil " .
                " FROM brechos b " . 
                " JOIN usuarios u ON (u.id = b.id_usuario) " . 
                " WHERE b.id = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $brechos = $this->mapBrechos($result);

        if(count($brechos) == 1)
            return $brechos[0];
        elseif(count($brechos) == 0)
            return null;

        die("BrechoDAO.findById()" . 
            " - Erro: mais de um brechó encontrado.");
    }
    
    private function mapBrechos($result) {
        $brechos = array();
        foreach ($result as $reg) {
            /*echo "<pre>";
            print_r($reg);
            echo "</pre>";
            exit;
             */
            $brecho = new Brecho();
            $brecho->setId($reg['id']);
            $brecho->setNome($reg['nome']);
            $brecho->setDescricao($reg['descricao']);
            $brecho->setChavePix($reg['chave_pix']);
            $brecho->setDataCriacao($reg['data_criacao']);
            $brecho->setId_usuario($reg['id_usuario']);
            
            $usuario = new Usuario();
            $usuario->setId($reg['id_usuario']);
            $usuario->setNome($reg['nome_usuario']);
            $usuario->setEmail($reg['email']);
            $usuario->setCpf($reg['cpf']);
            $usuario->setTelefone($reg['telefone']);
            $usuario->setDataNascimento($reg['data_nascimento']);
            $usuario->setSituacao($reg['situacao']);
            $usuario->setFotoPerfil($reg['foto_perfil']);

            $brecho->setUsuario($usuario);
            array_push($brechos, $brecho);
        }

        return $brechos;
    }
}
