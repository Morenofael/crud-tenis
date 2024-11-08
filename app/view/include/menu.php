<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

$nome = "(Sessão expirada)";
if(isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
?>
<link rel="stylesheet" href="<?=BASEURL?>/public/css/menu.css" media="all">
<nav class="">
    <div class="" id="conteudoNavbarSuportado">
        <ul class="nav-list nav-preto">
            <li class="menu-logo-wrapper">
                <img src="<?=BASEURL?>/view/img/logo.png" alt="sacola de compras com uma bola de basquete desenhada" id="menu-logo">
                <span class="">MySports</span>
            </li>
            <li class="">
                <a class="" href="<?= HOME_PAGE ?>">Home</a>
            </li>
            <li class="">
            <a class="" href="<?=BASEURL?>/controller/ProdutoController.php?action=listByGenero&g=m">Masculino</a>
            </li>
            <li class="">
                <a class="" href="<?=BASEURL?>/controller/ProdutoController.php?action=listByGenero&g=f">Feminino</a>
            </li>
            <li class="">
                <a class="" href="<?=BASEURL?>/controller/ProdutoController.php?action=listByGenero&g=u">Unissex</a>
            </li>
            <li class="">
                <a class="" href="<?=BASEURL?>/controller/ProdutoController.php?action=listByGenero&g=i">Infantil</a>
            </li>
            <li class="">
                <a class="" href="#">Ofertas</a>
            </li>

        </ul>

        <ul class="nav-list">
            <li class="">
                <a class="" href="<?= LOGOUT_PAGE ?>">Sair</a>
            </li>
            <li class="">
                <?php if($_SESSION[SESSAO_USUARIO_ID]):?>
                <a href="<?=BASEURL?>/controller/UsuarioController.php?action=display&id=<?=$_SESSION[SESSAO_USUARIO_ID]?>"><?= $nome?></a>
                <?php endif;?>
            </li>
            <li class="">
                <a href="<?=BASEURL?>/controller/BrechoController.php?action=create">Meu Brecho</a>
            </li>
        </ul>
    </div>
</nav>
