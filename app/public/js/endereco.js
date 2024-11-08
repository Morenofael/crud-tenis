const inputCep = document.getElementById("txtCep");
const inputLogradouro = document.getElementById("txtLogradouro");
const inputComplemento= document.getElementById("txtComplemento");
const inputBairro= document.getElementById("txtBairro");
const inputMunicipio = document.getElementById("txtMunicipio");
const inputUf = document.getElementById("txtUf");
const inputNumero = document.getElementById("txtNumero");
inputCep.addEventListener("input", ()=>checkCepLength());
function checkCepLength(){
    if(inputCep.value.length == 8){
        getDadosEndereco();
    }
}
function getDadosEndereco(){
    let cep = inputCep.value;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET",
        "https://viacep.com.br/ws/" + cep + "/json/");
    xhttp.onload = function(){
        var json = xhttp.responseText;
        var endereco = JSON.parse(json);
        populateInputs(endereco);
    }
    xhttp.send();
}
function populateInputs(endereco){
    inputLogradouro.value = endereco.logradouro ? endereco.logradouro : "";
    inputComplemento.value = endereco.complemento ? endereco.complemento : "";
    inputBairro.value = endereco.bairro ? endereco.bairro : "";
    inputMunicipio.value = endereco.localidade ? endereco.localidade : "";
    inputUf.value = endereco.uf ? endereco.uf : "";
}
