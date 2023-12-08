<?php 

require_once(__DIR__ . "/../model/Jogador.php");

class JogadorService {

    public function validarDados(Jogador $jogador) {
		print_r($jogador);
        $erros = array();
        
        if(! $jogador->getNome()) {
            array_push($erros, "Informe o nome!");
        }else if(strlen($jogador ->getNome()) > 40) array_push($erros, "Nome n~ao pode ser maior que 40 caracteres");

        if(! $jogador->getClube()) {
            array_push($erros, "Informe o Clube!");
        }

        return $erros;
    }

}
