<?php 

require_once(__DIR__ . "/../model/Tenis.php");

class TenisService {

    public function validarDados(Tenis $tenis) {
        $erros = array();
        
        if(! $tenis->getNome()) {
            array_push($erros, "Informe o nome!");
        }else if(strlen($tenis ->getNome()) > 40) array_push($erros, "Nome n~ao pode ser maior que 40 caracteres");

        if(! $tenis->getPreco()) {
            array_push($erros, "Informe o pre,co!");
        }else if(is_numeric($tenis->getPreco()) == false){
            array_push($erros, "Valor do pre,co deve ser numerico!");
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