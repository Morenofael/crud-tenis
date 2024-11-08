<?php 
#Nome do arquivo: Brecho.php
#Objetivo: classe Model para Brechó 

require_once(__DIR__ . "/Usuario.php");

class Brecho implements JsonSerializable {

    private ?int $id;
    private ?string $nome;
    private ?string $descricao;
    private ?string $chavePix;
    private ?string $dataCriacao;
    private ?int $id_usuario;
    private ?Usuario $usuario;

    public function __construct() {
        $this->usuario = null;        
    }

    public function jsonSerialize(): array {
        return array("id" => $this->id,
                     "nome" => $this->nome,
                     "descricao" => $this->descricao,
                     "chavePix" => $this->chavePix,
                     "dataCriacao" => $this->dataCriacao,
                     "usuario" => $this->usuario,
                     "id_usuario" => $this->id_usuario);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    
     
     /**
      * Get descricao.
      *
      * @return descricao.
      */
     public function getDescricao()
     {
         return $this->descricao;
     }
     
     /**
      * Set descricao.
      *
      * @param descricao the value to set.
      */
     public function setDescricao($descricao)
     {
         $this->descricao = $descricao;
     }
    
     /**
     * Get the value of chavePix
     */
    public function getChavePix()
    {
        return $this->chavePix;
    }

    /**
     * Set the value of chavePix
     */
    public function setChavePix(?string $chavePix)
    {
        $this->chavePix = $chavePix;

        return $this;
    }

     /**
      * Get dataCriacao.
      *
      * @return dataCriacao.
      */
     public function getDataCriacao()
     {
         return $this->dataCriacao;
     }
     
     /**
      * Set dataCriacao.
      *
      * @param dataCriacao the value to set.
      */
     public function setDataCriacao($dataCriacao)
     {
         $this->dataCriacao = $dataCriacao;
     }
    
    /**
     * Get id_usuario.
     *
     * @return id_usuario.
     */
    public function getId_usuario()
    {
        return $this->id_usuario;
    }
    
    /**
     * Set id_usuario.
     *
     * @param id_usuario the value to set.
     */
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     */
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
