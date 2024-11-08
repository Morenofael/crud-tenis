<?php
class Imagem implements JsonSerializable{
    private ?int $id;
    private ?int $idProduto;
    private ?string $arquivoNome;

    public function jsonSerialize(): array{
        return array(
            "id" => $this->id,
            "idProduto" => $this->idProduto,
            "arquivoNome" => $this->arquivoNome
        );
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

    /**
     * Get the value of idProduto
     */
    public function getIdProduto(): ?int
    {
        return $this->idProduto;
    }

    /**
     * Set the value of idProduto
     */
    public function setIdProduto(?int $idProduto): self
    {
        $this->idProduto = $idProduto;

        return $this;
    }

    /**
     * Get the value of arquivoNome
     */
    public function getArquivoNome(): ?string
    {
        return $this->arquivoNome;
    }

    /**
     * Set the value of arquivoNome
     */
    public function setArquivoNome(?string $arquivoNome): self
    {
        $this->arquivoNome = $arquivoNome;

        return $this;
    }
}