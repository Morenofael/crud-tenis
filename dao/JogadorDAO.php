<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Jogador.php");
include_once(__DIR__ . "/../model/Clube.php");
class JogadorDAO{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function list() {
        $sql = "SELECT j.*," . 
                " c.nome AS nome_clube " . 
                " FROM jogadores j " .
                " JOIN clubes c ON (c.id = j.id_clube) " .
                " ORDER BY j.nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBancoParaObjeto($result);
    }

    public function insert(Jogador $jogador) {
        $sql = "INSERT INTO jogadores" . 
                " (id_clube, img_foto, nome)" .
                " VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$jogador->getClube()->getId(), 
                        $jogador->getImgFoto(), 
                        $jogador->getNome()]);
    }

    public function update(Jogador $jogador){
        $conn = Connection::getConnection();

        $sql = "UPDATE jogadores SET id_clube = ?, img_foto = ?,". 
            " nome = ?".
            " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$jogador->getClube()->getId(), $jogador->getImgFoto(), 
                        $jogador->getNome(), $jogador->getId()]);
    }

    public function deleteById(int $id) {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM jogadores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function findById(int $id) {
        $conn = Connection::getConnection();

        $sql = "SELECT j.*," . 
                " c.nome AS nome_clube " . 
                " FROM jogadores j " .
                " JOIN clubes c ON (c.id = j.id_clube) " .
                " WHERE j.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();

        //Criar o objeto Aluno
        $alunos = $this->mapBancoParaObjeto($result);

        if(count($alunos) == 1)
            return $alunos[0];
        elseif(count($alunos) == 0)
            return null;

        die("JogadorDAO.findById - Erro: mais de um aluno".
                " encontrado para o ID " . $id);
    }

    private function mapBancoParaObjeto($result) {
        $jogadores = array();

        foreach($result as $reg) {
            $jogador = new Jogador();
            $jogador->setId($reg['id']);

            $clube = new Clube();
            $clube->setId($reg['id_clube'])
                ->setAbrev($reg['abrev_clube'])
                ->setEsporte($reg['esporte_clube'])
                ->setNome($reg['nome_clube']);
            $jogador->setClube($clube)
                    ->setImgFoto($reg["imgFoto"])
                    ->setNome($reg["nome"]);
                    array_push($jogadores, $jogador);
        }

        return $jogadores;
    }
}
