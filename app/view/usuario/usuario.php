<?php
#Nome do arquivo: usuario/usuario.php
#Objetivo: interface para vizualização de usuarios; 

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
$usuario = $dados["usuario"];
?>
    <link rel="stylesheet" href="<?=BASEURL?>/public/css/usuario.css" media="all">
<h3 class="text-center">
    USUÁRIO
</h3>
<div class="container">

    <div class="row" style="margin-top: 10px;">
        <div class="col-6">
            <img src="<?= PATH_ARQUIVOS . $usuario->getFotoPerfil()?>" alt="Foto de perfil" class="img-fluid foto-perfil">
        </div>

        <div class="col-6">
           <h4>Nome: <?= $usuario->getNome()?></h4>
           <h4>Email: <?= $usuario->getEmail()?></h4>
           <h4>CPF: <?= $usuario->getCpf()?></h4>
           <h4>Telefone: <?= $usuario->getTelefone()?></h4>
           <h4>Data de Nascimento: <?= $usuario->getDataNascimento()?></h4>
        </div>

    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary"
                href="<?= BASEURL ?>/../">Voltar</a>
        <?php if($usuario->getId() == $_SESSION[SESSAO_USUARIO_ID]): ?>
        <a class="btn btn-info"
                href="<?= BASEURL ?>/controller/EnderecoController.php?action=create">Adicionar endereço</a>
        <a class="btn btn-info"
                href="<?= BASEURL ?>/controller/EnderecoController.php?action=list">Meus endereços</a>
        <a class="btn btn-info"
                href="<?= BASEURL ?>/controller/UsuarioController.php?action=insertAlterPfp">Adicionar/alterar foto de perfil</a>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
