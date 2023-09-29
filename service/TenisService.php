<?php 

require_once(__DIR__ . "/../model/Tenis.php");

class TenisService {

    public function validarDados(Tenis $tenis) {
        $erros = array();
        
        if(! $tenis->getNome()) {
            array_push($erros, "Informe o nome!");
        }

        if(! $tenis->getPreco()) {
            array_push($erros, "Informe o pre,co!");
        }

        if(! $tenis->getMarca()) {
            array_push($erros, "Informe a marca!");
        }

        if(! $tenis->getSexo()) {
            array_push($erros, "Informe o sexo!");
        }
        
        if(! $tenis->getEsporte()) {
            array_push($erros, "Informe o esporte!");
        }

        return $erros;
    }

}