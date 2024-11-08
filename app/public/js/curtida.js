const BASE_URL = document.getElementById('ipnBaseUrl').value;
console.log(BASE_URL);

function curtir(button) {
    var idProduto = button.getAttribute('data-idProduto');
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST",
                BASE_URL + "/controller/CurtidaController.php?action=save");
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhttp.onload = function() {
        var json = xhttp.responseText;
        if(json == "")
            checkButtonCurtir(button); 
    }

    xhttp.send("idProduto=" + encodeURIComponent(idProduto));
}

function descurtir(button) {
    var idProduto = button.getAttribute('data-idProduto');
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST",
                BASE_URL + "/controller/CurtidaController.php?action=delete");
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhttp.onload = function() {
        var json = xhttp.responseText;
        if(json == "")
            checkButtonCurtir(button); 
    }

    xhttp.send("idProduto=" + encodeURIComponent(idProduto));
}

function checkButtonCurtir(button){
    var idProduto = button.getAttribute('data-idProduto');
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET",
        BASE_URL + "/controller/CurtidaController.php?action=listJsonFromUsuario");

    xhttp.onload = function() {
        var json = xhttp.responseText;
        curtidas = JSON.parse(json);
        if(curtidas.some(c => c.produto.id == idProduto)){
            button.setAttribute('onclick','descurtir(this)');
            botaoImagem = document.querySelector("button>img");
            botaoImagem.src = "http://localhost:8080/app/view/img/svg/coracao-preenchido.svg";
            botaoTexto = document.querySelector("button>span");
            botaoTexto.innerText = "Descurtir";
        }else{
            button.setAttribute('onclick','curtir(this)');
            botaoImagem = document.querySelector("button>img");
            botaoImagem.src = "http://localhost:8080/app/view/img/svg/coracao.svg";
            botaoTexto = document.querySelector("button>span");
            botaoTexto.innerText = "Curtir";
        }
    }
    
    xhttp.send();
}
checkButtonCurtir(document.querySelector("button"));
