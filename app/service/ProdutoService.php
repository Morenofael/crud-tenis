<?php
    
require_once(__DIR__ . "/../model/Produto.php");

class ProdutoService{

    public function __construct(){
    }

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Produto $produto) {
        $erros = array();

        //Validar campos vazios
        if(! $produto->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if(! $produto->getDescricao())
            array_push($erros, "O campo [Descrição] é obrigatório.");

        if(! $produto->getPreco())
            array_push($erros, "O campo [Email] é obrigatório.");
        
        return $erros;
        
    }

    public function generoCharToString(?string $genero){
        switch ($genero){
            case "m":
                return "Masculino";
                break;
            case "f":
                return "Feminino";
                break;
            case "u":
                return "Unissex";
                break;
            case "i":
                return "Infantil";
                break;
            default:
                return "Unissex";
        }
                
    }
}
