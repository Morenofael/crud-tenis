<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class UsuarioPapel {

    public static string $SEPARADOR = "|";

    const USUARIO = 0;
    const ADMINISTRADOR = 1;

    public static function getAllAsArray() {
        return [UsuarioPapel::USUARIO, UsuarioPapel::ADMINISTRADOR];
    }

}

