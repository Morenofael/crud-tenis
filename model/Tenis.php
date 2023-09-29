<?php

require_once(__DIR__ . "/Esporte.php");
require_once(__DIR__ . "/Marca.php");

class Tenis{
    private ?int $id;
    private ?string $nome;
    private ?float $preco;
    private ?Marca $marca;
    private ?string $sexo;
    private ?Esporte $esporte;

    public function __construct()
    {
        $this->id = 0;
        $this->marca = null;
        $this->esporte = null;
    }
    
    // public function __toString() {
    //     return $this->nome; 
    // }
    
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

    public function setPreco($preco){
        $this->preco = $preco;
        return $this;
    }
    public function getPreco(){
        return $this->preco;
    }

    public function setMarca($marca){
        $this->marca = $marca;
        return $this;
    }
    public function getMarca(){
        return $this->marca;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
        return $this;
    }
    public function getSexo(){
        return $this->sexo;
    }

    public function setEsporte($esporte){
        $this->esporte = $esporte;
        return $this;
    }
    public function getEsporte(){
        return $this->esporte;
    }

}