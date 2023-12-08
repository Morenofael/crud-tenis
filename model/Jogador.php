<?php

require_once(__DIR__ . "/Clube.php");

class Jogador{
    private ?int $id;
    private ?string $nome;
    private ?Clube $clube;
    private ?string $clubeAbrev;
    
    private ?string $imgFoto;

    public function __construct()
    {
        $this->id = 0;
        $this->clube = null;
    }
    
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

    public function setClube($clube){
        $this->clube = $clube;
        return $this;
    }
    public function getClube(){
        return $this->clube;
    }
    
    public function getImgFoto()
    {
        return $this->imgFoto;
    }

    public function setImgFoto($imgFoto)
    {
        $this->imgFoto = $imgFoto;

        return $this;
    }
}
