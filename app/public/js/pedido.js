const BASE_URL = document.getElementById('ipnBaseUrl').value;
const selEndereco = document.getElementById('selEndereco');
const btnSalvarEndereco = document.getElementById('btnSalvarEndereco');
const fileComprovante = document.getElementById('fileComprovante');
const idPedido = document.getElementById('pedidoId').value;
let idEnderecoEntrega = document.getElementById('idEnderecoEntrega').value;
let idCaminhoComprovante = document.getElementById('idCaminhoComprovante').value;

function salvarEndereco() {
    let idEndereco = selEndereco.value; 
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST",
                BASE_URL + "/controller/PedidoController.php?action=updateIdEndereco");
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhttp.onload = function() {
        idEnderecoEntrega = idEndereco;
        checarCampos();
    }

    xhttp.send("idEndereco=" + encodeURIComponent(idEndereco) +  "&idPedido=" + encodeURIComponent(idPedido));
}

//TODO finalizar salvarComprovante
function salvarComprovante() {
    let caminhoComprovante = fileComprovante.files[0].name; 
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST",
                BASE_URL + "/controller/PedidoController.php?action=updateCaminhoComprovante");
    xhttp.setRequestHeader("Content-Type", "multipart/formdata");

    xhttp.onload = function() {
        idCaminhoComprovante = caminhoComprovante;
        checarCampos();
    }

    xhttp.send("idEndereco=" + encodeURIComponent(idEndereco) +  "&idPedido=" + encodeURIComponent(idPedido));
}

function checarCampos(){
    if(idEnderecoEntrega){
        selEndereco.setAttribute("disabled", "disabled");
        btnSalvarEndereco.setAttribute("disabled", "disabled");
    }
    if(idEnderecoEntrega && !idCaminhoComprovante){
        fileComprovante.removeAttribute("disabled"); 
    }
}
checarCampos();