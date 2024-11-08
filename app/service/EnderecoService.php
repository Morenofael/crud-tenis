<?php
    
require_once(__DIR__ . "/../model/Endereco.php");

class EnderecoService {
    
    public function validarDados(Endereco $endereco) {
        $erros = array();

        //Validar campos vazios
        if(! $endereco->getCep())
            array_push($erros, "O campo [CEP] é obrigatório.");
        
        if(! $endereco->getNumero())
            array_push($erros, "O campo [Número] é obrigatório");
        
        return $erros;
        
    }

}
