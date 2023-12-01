<?php
require_once(__DIR__ . "/Clube.php");
Class Jogador{

    private ?int $id;
    private ?Clube $clube;
    private ?string $imgFoto;
    private ?string $nome;
    public function __construct(){
        $this->id = null;
        $this->Clube = null;
    }
    public function __toString(){
        return $this->nome;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of clube
     */ 
    public function getClube()
    {
        return $this->clube;
    }

    /**
     * Set the value of clube
     *
     * @return  self
     */ 
    public function setClube($clube)
    {
        $this->clube = $clube;

        return $this;
    }

    /**
     * Get the value of imgFoto
     */ 
    public function getImgFoto()
    {
        return $this->imgFoto;
    }

    /**
     * Set the value of imgFoto
     *
     * @return  self
     */ 
    public function setImgFoto($imgFoto)
    {
        $this->imgFoto = $imgFoto;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}