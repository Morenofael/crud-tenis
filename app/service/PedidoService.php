<?php
    
class PedidoService{

    public function __construct(){
    } 

    public function statusEnumToString(?string $status){
        switch ($status){
            case "NV":
                return "Não visto";
                break;
            case "P":
                return "Sendo preparado";
                break;
            case "ENV":
                return "Enviado";
                break;
            case "ENT":
                return "Entregue";
                break;
            default:
                return "Não visto";
        }
                
    }
}
