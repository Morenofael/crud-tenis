<?php
#Nome do arquivo: brecho/form.php
#Objetivo: interface para inserção dos brechós do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
    <link rel="stylesheet" href="<?=BASEURL?>/public/css/form.css" media="all">

<section class="main">
<h3 class="text-center">
    <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?>
   Endereco 
</h3>

    <div class="row" style="margin-top: 10px;">

        <div class="form-container">
            <form id="frmUsuario" method="POST"
                action="<?= BASEURL ?>/controller/EnderecoController.php?action=save" >
                <div class="input-wrapper">
                    <label for="txtCep">CEP:</label>
                    <input type="text" id="txtCep" name="cep"
                        maxlength="8" placeholder="Informe o cep"
                        value="<?php echo (isset($dados["endereco"]) ? $dados["endereco"]->getCep() : ''); ?>" />
                </div>
                <div class="input-wrapper">
                    <label for="txtLogradouro">Logradouro:</label>
                    <input type="text" id="txtLogradouro" name="logradouro"
                        maxlength="64" placeholder="Informe o logradouro"
                        value="<?php echo (isset($dados["endereco"]) ? $dados["endereco"]->getLogradouro() : ''); ?>" />
                </div>
               <div class="input-wrapper">
                    <label for="txtComplemento">Complemento:</label>
                    <input type="text" id="txtComplemento" name="complemento"
                        maxlength="64" placeholder="Informe o complemento"
                        value="<?php echo (isset($dados["endereco"]) ? $dados["endereco"]->getComplemento() : ''); ?>" />
                </div>
                <div class="input-wrapper">
                    <label for="txtBairro">Bairro:</label>
                    <input type="text" id="txtBairro" name="bairro"
                        maxlength="64" placeholder="Informe o bairro"
                        value="<?php echo (isset($dados["endereco"]) ? $dados["endereco"]->getBairro() : ''); ?>" />
                </div>
                <div class="input-wrapper">
                    <label for="txtCep">Município:</label>
                    <input type="text" id="txtMunicipio" name="municipio"
                        maxlength="32" placeholder="Informe o municipio"
                        value="<?php echo (isset($dados["endereco"]) ? $dados["endereco"]->getMunicipio() : ''); ?>" />
                </div>
                <div class="input-wrapper">
                    <label for="txtCep">UF:</label>
                    <input type="text" id="txtUf" name="uf"
                        maxlength="2" placeholder="Informe a Unidade Federativa"
                        value="<?php echo (isset($dados["endereco"]) ? $dados["endereco"]->getUf() : ''); ?>" />
                </div>
                <div class="input-wrapper">
                    <label for="txtNumero">Numero:</label>
                    <input type="text" id="txtNumero" name="numero"
                        maxlength="6" placeholder="Informe o número"
                        value="<?php echo (isset($dados["endereco"]) ? $dados["endereco"]->getNumero() : ''); ?>" />
                </div>
                
                <input type="hidden" id="hddId" name="id"
                    value="<?= $dados['id']; ?>" />

                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
            </form>
        </div>
</section>
        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary"
                href="<?= BASEURL ?>/../">Voltar</a>
        </div>
    </div>
</div>
<script src="<?=BASEURL?>/public/js/endereco.js"></script>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>
