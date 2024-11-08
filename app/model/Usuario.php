<?php 
#Nome do arquivo: Usuario.php
#Objetivo: classe Model para Usuario

require_once(__DIR__ . "/enum/UsuarioPapel.php");

class Usuario implements JsonSerializable {

    private ?int $id;
    private ?string $nome;
    private ?string $email;
    private ?string $login;
    private ?string $senha;
    private ?string $cpf;
    private ?string $telefone;
    private ?string $data_nascimento;
    private ?int $nivelAcesso;
    private ?int $situacao;
    private ?string $fotoPerfil;

    public function jsonSerialize(): array {
        return array("id" => $this->id,
                     "nome" => $this->nome,
                     "email" => $this->email,
                     "login" => $this->login,
                     "senha" => $this->senha,
                     "cpf" => $this->cpf,
                     "telefone" => $this->telefone,
                     "dataNascimento" => $this->data_nascimento,
                     "nivelAcesso" => $this->nivelAcesso,
                    "situacao" => $this->situacao);
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): self
    {
        $this->telefone= $telefone;

        return $this;
    }

    public function getDataNascimento(): ?string
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(?string $data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;

        return $this;
    }
    public function getNivelAcesso(): ?int
    {
        return $this->nivelAcesso;
    }

    public function setNivelAcesso(?int $nivelAcesso): self
    {
        $this->nivelAcesso = $nivelAcesso;

        return $this;
    }
    
    public function getSituacao(): ?int
    {
        return $this->situacao;
    }

    public function setSituacao(?int $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }
     
     /**
      * Get fotoPerfil.
      *
      * @return fotoPerfil.
      */
     public function getFotoPerfil()
     {
         return $this->fotoPerfil;
     }
     
     /**
      * Set fotoPerfil.
      *
      * @param fotoPerfil the value to set.
      */
     public function setFotoPerfil($fotoPerfil)
     {
         $this->fotoPerfil = $fotoPerfil;
     }
}
