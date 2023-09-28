<?php

class Marca{

    private ?int $id;
    private ?string $nome;
    private ?string $nacionalidade;

    public function __toString() {
        return $this->nome; 
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function getId(){
        return $this->id;
    }

    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }
    public function getNome(){
        return $this->nome;
    }

    public function setNacionalidade($nacionalidade){
        $this->nacionalidade = $nacionalidade;
        return $this;
    }
    public function getNacionalidade(){
        return $this->nacionalidade;
    }
}