<?php
#Nome do arquivo: brecho/brecho.php
#Objetivo: interface para vizualização de brechós

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
$brecho = $dados["brecho"];
$produtos = $dados["produtos"];
?>
<h3 class="text-center">
    <?= $brecho->getNome()?>
</h3>
<div class="container">

    <div class="row" style="margin-top: 10px;">

        <div class="col-6">
           <h4><?= $brecho->getDescricao()?></h4> 
        </div>

    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary"
                href="<?= BASEURL ?>/../">Voltar</a>
        <?php if($brecho->getId_usuario() == $_SESSION[SESSAO_USUARIO_ID]):?>
        <a class="btn btn-success"
                href="<?= BASEURL ?>/controller/BrechoController.php?action=edit&id=<?=$brecho->getId()?>">Editar</a>
        <a class="btn btn-primary"
                href="<?= BASEURL ?>/controller/ProdutoController.php?action=create">Adicionar produto</a>
        <?php endif;?>
        <ul>
            <?php foreach($produtos as $p): ?>
                <li>
                    <a href="<?=BASEURL?>/controller/ProdutoController.php?action=display&id=<?=$p->getId()?>">
                        <?=$p->getNome()?>
                    </a>
                </li> 
            <?php endforeach; ?>
        </ul>
        
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
