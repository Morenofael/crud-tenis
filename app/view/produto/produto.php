<?php
#Nome do arquivo: produto/produto.php
#Objetivo: interface para vizualização de produtos

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
$produto = $dados["produto"];
$vendedor = $dados["vendedor"];
$imagens = $dados["imagens"];
?>
<link rel="stylesheet" href="<?=BASEURL?>/public/css/produto.css" media="all">
<section class="main">
    <div class="esquerda">
        <img src="<?=BASEURL?>/view/img/upl_img/<?=$imagens[0]->getArquivoNome()?>" id="main-img">
        <h4><?= $produto->getDescricao()?></h4>
        <h4>Gênero:<?= $dados["generoString"]?></h4> 
    </div>
    <div class="direita">
        <h3><?=$produto->getNome()?></h3>
        <h4>R$<?= $produto->getPreco()?></h4> 
        <?php if($vendedor->getId() != $_SESSION[SESSAO_USUARIO_ID]) : ?>
        <div class="flex botoes-produto-wrapper">
            <button onclick="curtir(this)" data-idProduto="<?=$produto->getId()?>"><img class="icon" src="<?=BASEURL?>/view/img/svg/coracao.svg" alt="coração"><span>Curtir</span></button>
            <a href="<?=BASEURL?>/controller/PedidoController.php?action=save&id=<?=$produto->getId()?>">Comprar</a>
        </div>
        <?php endif; ?>
        <div class="sec-imagens-wrapper">
            <span class="muda-index mouse-pointer" onclick="mudarIndex(-1)"><-</span>
            <?php foreach($imagens as $i):?>
                <img src="<?=BASEURL?>/view/img/upl_img/<?=$i->getArquivoNome()?>" onclick="mudarMainImagem(<?= array_search($i, $imagens)?>)" class="sec-img mouse-pointer">
            <?php endforeach;?>
            <span class="muda-index mouse-pointer" onclick="mudarIndex(1)">-></span>
        </div>
    </div>
    
</div>


</section>
<div class="row" style="margin-top: 30px;">
    <div class="col-12">
    <a class="btn btn-secondary"
        href="<?= BASEURL ?>/../">Voltar</a>
    <?php if($vendedor->getId() == $_SESSION[SESSAO_USUARIO_ID]):?>
    <a class="btn btn-success"
        href="<?= BASEURL ?>/controller/ProdutoController.php?action=edit&id=<?=$produto->getId()?>">Editar</a>
    <a class="btn btn-danger" onclick="confirm('deseja excluir?')"
        href="<?= BASEURL ?>/controller/ProdutoController.php?action=delete&id=<?=$produto->getId()?>">Excluir</a>
    <?php endif;?>
    </div>     
</div>
<input id="ipnBaseUrl" type="hidden" value="<?= BASEURL ?>">
<input id="numImg" type="hidden" value="<?= count($imagens) ?>">
<script src="<?= BASEURL ?>/public/js/curtida.js"></script>
<script src="<?= BASEURL ?>/public/js/produto.js"></script>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>
