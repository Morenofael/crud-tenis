<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u ORDER BY u.nome";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }


    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
               " WHERE u.id = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }
   
   //Método para buscar um usuário por seu Email 
    public function findByEmail(string $email) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
               " WHERE u.email = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$email]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByEmail()" . 
            " - Erro: mais de um usuário encontrado.");
    }


    //Método para buscar um usuário por seu login e senha
    public function findByLoginSenha(string $login, string $senha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
               " WHERE BINARY u.login = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$login]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1) {
            //Tratamento para senha criptografada
            if(password_verify($senha, $usuarios[0]->getSenha()))
                return $usuarios[0];
            else
                return null;
        } elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByLoginSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    public function findByIdBrecho(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT u.* FROM usuarios u" .
                " JOIN brechos b ON (u.id = b.id_usuario)" .
               " WHERE b.id = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByBrecho()" . 
            " - Erro: mais de um usuario encontrado.");
    }


    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO usuarios (nome, email, login, senha, cpf, telefone, data_nascimento, nivel_acesso, situacao)" .
               " VALUES (:nome, :email, :login, :senha, :cpf, :telefone, :data_nascimento, :nivel_acesso, :situacao)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("login", $usuario->getLogin());
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("data_nascimento", $usuario->getDataNascimento());
        $stm->bindValue("nivel_acesso", $usuario->getNivelAcesso());
        $stm->bindValue("situacao", $usuario->getSituacao());
        $stm->execute();
    }

    public function editPfP(String $pfp){
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET foto_perfil = :pfp " .
            "WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("pfp", $pfp);
        $stm->bindValue("id", $_SESSION[SESSAO_USUARIO_ID]);
        $stm->execute();
    }

    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET nome = :nome, login = :login," . 
               " senha = :senha, nivel_acesso = :nivel_acesso" .   
               " WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("login", $usuario->getLogin());
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("nivel_acesso", $usuario->getNivelAcesso());
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM usuarios WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function count() {
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) total FROM usuarios";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id'])
                    ->setNome($reg['nome'])
                    ->setEmail($reg['email'])
                    ->setLogin($reg['login'])
                    ->setSenha($reg['senha'])
                    ->setCpf($reg['cpf'])
                    ->setTelefone($reg['telefone'])
                    ->setDataNascimento($reg['data_nascimento'])
                    ->setNivelAcesso($reg['nivel_acesso'])
                    ->setSituacao($reg['situacao'])
                    ->setFotoPerfil($reg['foto_perfil']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

}
