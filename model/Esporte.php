<?php

Class Esporte {
    private ?int $id;
    private ?string $nome;

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
}