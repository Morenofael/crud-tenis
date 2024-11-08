<?php
#View para a home do sistema

require_once __DIR__ . "/../include/header.php";
require_once __DIR__ . "/../include/menu.php";
$produtos = array_reverse($dados["produtos"]);
$imagens = array_reverse($dados["imagens"]);
?>
<link rel="stylesheet" href="<?= BASEURL ?>/public/css/home.css">
<span id="sidebar-togler" onclick="togleSidebar()">☰</span>
<div class="main">
    <div class="sidebar">
        <ul class="no-decoration">
            <li id="sidebar-untogler" onclick="untogleSidebar()"><img src="<?= BASEURL ?>/view/img/svg/x.svg" alt="Fechar" class="icon">Fechar</li>
            <li><img src="<?= BASEURL ?>/view/img/svg/home.svg" alt="Home" class="icon"><a href="<?= HOME_PAGE ?>">Home</a></li>
            <li><img src="<?= BASEURL ?>/view/img/svg/bussola.svg" alt="Bússola" class="icon"><a href="<?=BASEURL?>/controller/ProdutoController.php?action=list">Explorar</a></li>
            <li><img src="<?= BASEURL ?>/view/img/svg/coracao.svg" alt="Coração" class="icon"><a href="<?= BASEURL ?>/controller/CurtidaController.php?action=list">Curtido</a></li>
            <li><img src="<?= BASEURL ?>/view/img/svg/carrinho.svg" alt="Carrinho" class="icon"><a href="<?=BASEURL?>/controller/PedidoController.php?action=listForComprador">Meus pedidos</a></li>
            <li><img src="<?= BASEURL ?>/view/img/svg/porquinho.svg" alt="Cofre de porquinho" class="icon"><a href="<?= BASEURL ?>/controller/BrechoController.php?action=create">Vendendo</a></li>
            <li><img src="<?= BASEURL ?>/view/img/svg/perfil.svg" alt="Perfil" class="icon"><a href="<?= BASEURL ?>/controller/UsuarioController.php?action=display&id=<?= $_SESSION[SESSAO_USUARIO_ID] ?>">Perfil</a></li>
            <li><img src="<?= BASEURL ?>/view/img/svg/engrenagem.svg" alt="Engrenagem" class="icon"><a href="">Configurações</a></li>
        </ul>
        <a href="<?=BASEURL?>/controller/BrechoController.php?action=create">
            <div id="venda-conosco">
                <h4>Venda conosco</h4>
                <p>Mussum Ipsum, cacilds vidis litro abertis.  Ainda é segunda-feris e já tô sem paciêncis!</p>
            </div>
        </a>
    </div>

    <div class="main-content">
        <div id="main-produto"> 
            <a href="<?=BASEURL?>/controller/ProdutoController.php?action=display&id=<?=$produtos[0]->getId()?>"><img src="<?=BASEURL?>/view/img/upl_img/<?=$imagens[0][0]->getArquivoNome()?>" alt=""></a>
            <div class="main-produto-info-wrapper">
                <a href="<?=BASEURL?>/controller/ProdutoController.php?action=display&id=<?=$produtos[0]->getId()?>"><h4><?=$produtos[0]->getNome()?></h4></a>
                <span><?=$produtos[0]->getDescricao()?></span> 
                <h5>Preço: <?=$produtos[0]->getPrecoReais()?></h5>
                <div class="flex botoes-produto-wrapper">
                    <button onclick="curtir(this)" data-idProduto="<?=$produtos[0]->getId()?>"><img class="icon" src="<?=BASEURL?>/view/img/svg/coracao.svg" alt="coração"><span>Curtir</span></button>
                    <a href="<?=BASEURL?>/controller/ProdutoController.php?action=display&id=<?=$produtos[0]->getId()?>"><span>Comprar</span>
                </div>
            </div>
         </div>

        <div class="sec-produtos flex">
            <a href="<?=BASEURL?>/controller/ProdutoController.php?action=display&id=<?=$produtos[1]->getId()?>">
                <div>
                     <img src="<?=BASEURL?>/view/img/upl_img/<?=$imagens[1][0]->getArquivoNome()?>" alt="" class="sec-produto-img">
                    <h5><?=$produtos[1]->getNome()?></h5>
                    <span>Preço: <?=$produtos[1]->getPreco()?></span>
                </div>
            </a>

            <a href="<?=BASEURL?>/controller/ProdutoController.php?action=display&id=<?=$produtos[2]->getId()?>">
                <div>
                     <img src="<?=BASEURL?>/view/img/upl_img/<?=$imagens[2][0]->getArquivoNome()?>" alt="" class="sec-produto-img">
                    <h5><?=$produtos[2]->getNome()?></h5>
                    <span>Preço: <?=$produtos[2]->getPreco()?></span>
                </div>
            </a>

            <a href="<?=BASEURL?>/controller/ProdutoController.php?action=display&id=<?=$produtos[3]->getId()?>">
                <div>
                     <img src="<?=BASEURL?>/view/img/upl_img/<?=$imagens[3][0]->getArquivoNome()?>" alt="" class="sec-produto-img">
                    <h5><?=$produtos[3]->getNome()?></h5>
                    <span>Preço: <?=$produtos[3]->getPreco()?></span>
                </div>
            </a>
        </div>
        <div class="flex cat-princ">
            <h5>Categorias principais</h5>
            <a id="ver-tudo" href="<?=BASEURL?>/controller/ProdutoController.php?action=list">Ver tudo</a>
        </div>
    </div>

</div>

<input id="ipnBaseUrl" type="hidden" value="<?= BASEURL ?>">
<script src="<?= BASEURL ?>/public/js/home.js"></script>
<script src="<?= BASEURL ?>/public/js/curtida.js"></script>

<?php require_once __DIR__ . "/../include/footer.php";
?>
