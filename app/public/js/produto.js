maxImg = document.getElementById('numImg').value - 1;
mainImagem = document.getElementById("main-img");
secImagens = document.querySelectorAll('.sec-img');
imgIndex = 0;

function mudarIndex(num){
    imgIndex += num;
    if(imgIndex > secImagens.length - 1)
        imgIndex = 0;
    if(imgIndex < 0)
        imgIndex = secImagens.length - 1;
    mudarMainImagem(imgIndex);
}
function mudarMainImagem(num){   
    mainImagem.src = secImagens[num].src;
    imgIndex = num;
}