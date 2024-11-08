<?php 
#Nome do arquivo: Curtida.php
#Objetivo: classe Model para Curtida 

require_once(__DIR__ . "/Curtida.php");
require_once(__DIR__ . "/Produto.php");

class Curtida implements JsonSerializable {

    private ?int $id;
    private ?int $idUsuario;
    private ?Produto $produto;

    public function jsonSerialize(): array {
        return array("id" => $this->id,
                     "idUsuario" => $this->idUsuario,
                     "produto" => $this->produto);
    }

    
    
    /**
     * Get id.
     *
     * @return id.
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set id.
     *
     * @param id the value to set.
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Get idUsuario.
     *
     * @return idUsuario.
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    
    /**
     * Set idUsuario.
     *
     * @param idUsuario the value to set.
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    
    /**
     * Get produto.
     *
     * @return produto.
     */
    public function getProduto()
    {
        return $this->produto;
    }
    
    /**
     * Set produto.
     *
     * @param produto the value to set.
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;
    }
}
