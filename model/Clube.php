<?php
require_once(__DIR__ . "/Esporte.php");

class Clube{
    private ?int $id;
    private ?string $abrev;
    private ?Esporte $esporte;
    private ?string $nome;

    public function __construct(){
        $this->id = null;
        $this->esporte = null;
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
     * Get the value of abrev
     */ 
    public function getAbrev()
    {
        return $this->abrev;
    }

    /**
     * Set the value of abrev
     *
     * @return  self
     */ 
    public function setAbrev($abrev)
    {
        $this->abrev = $abrev;

        return $this;
    }

    /**
     * Get the value of esporte
     */ 
    public function getEsporte()
    {
        return $this->esporte;
    }

    /**
     * Set the value of esporte
     *
     * @return  self
     */ 
    public function setEsporte($esporte)
    {
        $this->esporte = $esporte;

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