<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>
<link rel="stylesheet" href="<?=BASEURL?>/public/css/form.css" media="all">

<section class="main">
<h4 class="text-center">
    Iserir foto de perfil
</h4>

<div class="form-container">
            <form id="frmUsuario" method="POST" enctype='multipart/form-data'
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=insertAlterPfP" >
             <div class="form-group">
					      <label for="uplImagem">Selecione o arquivo:</label>
					      <input type="file" name="imagem[]" id="uplImagem" 
					      accept="image/*" />
				        </div>
                <input type="hidden" id="hddId" name="id" 
                    value="<?= $dados['id']; ?>" />

                <button type="submit">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
            </form>            

        <div class="col-12">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary"
                href="<?= BASEURL ?>/controller/UsuarioController.php?action=list">Voltar</a>
        </div>
    </div>
</div>
</section>
<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
