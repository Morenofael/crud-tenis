<?php 
#Nome do arquivo: Endereco.php
#Objetivo: classe Model para Endereco 

class Endereco implements JsonSerializable {

    private ?int $id;
    private ?string $cep;
    private ?string $logradouro;
    private ?string $complemento;
    private ?string $bairro;
    private ?string $municipio;
    private ?string $uf;
    private ?string $numero;
    private ?int $idUsuario;

    public function jsonSerialize(): array {
        return array("id" => $this->id,
                     "numero" => $this->numero,
                     "cep" => $this->cep,
                     "logradouro" => $this->logradouro,
                     "complemento" => $this->complemento,
                     "bairro" => $this->bairro,
                     "municipio" => $this->municipio,
                     "uf" => $this->uf,
                     "idUsuario" => $this->idUsuario);
    } 

    /**
     * Get the value of logradouro
     */
    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    /**
     * Set the value of logradouro
     */
    public function setLogradouro(?string $logradouro): self
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get the value of complemento
     */
    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     */
    public function setComplemento(?string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get the value of bairro
     */
    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     */
    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of municipio
     */
    public function getMunicipio(): ?string
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     */
    public function setMunicipio(?string $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get the value of uf
     */
    public function getUf(): ?string
    {
        return $this->uf;
    }

    /**
     * Set the value of uf
     */
    public function setUf(?string $uf): self
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get the value of numero
     */
    public function getNumero(): ?string
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     */
    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     */
    public function setIdUsuario(?int $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of cep
     */
    public function getCep(): ?string
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     */
    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
