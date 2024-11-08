<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>
<link rel="stylesheet" href="<?=BASEURL?>/public/css/form.css" media="all">
<link rel="stylesheet" href="<?=BASEURL?>/public/css/cadastro-usuario.css" media="all">

<section class="main">
<h4 class="text-center">
    <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?> 
    Usuário
</h4>

<div class="form-container">
            <form id="frmUsuario" method="POST" 
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=save" >
                <div class="input-wrapper">
                    <label for="txtNome">Nome:</label>
                    <input type="text" id="txtNome" name="nome" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNome() : ''); ?>" />
                </div>
                
                <div class="input-wrapper">
                    <label for="txtEmail">Email:</label>
                    <input type="email" id="txtEmail" name="email" 
                        maxlength="345" placeholder="Informe o email"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>"/>
                </div>

                <div class="input-wrapper">
                    <label for="txtSenha">Senha:</label>
                    <input type="password" id="txtSenha" name="senha" 
                        maxlength="15" placeholder="Informe a senha"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>"/>
                </div>

                <div class="input-wrapper">
                    <label for="txtConfSenha">Confirmação da senha:</label>
                    <input type="password" id="txtConfSenha" name="conf_senha" 
                        maxlength="15" placeholder="Informe a confirmação da senha"
                        value="<?php echo isset($dados['confSenha']) ? $dados['confSenha'] : '';?>"/>
                </div>
                
                <div class="input-wrapper">
                    <label for="txtCpf">CPF:</label>
                    <input type="text" id="txtCpf" name="cpf" 
                        maxlength="11" placeholder="Informe o CPF"
                        value="<?php echo isset($dados['usuario']) ? $dados['usuario']->getCpf() : '';?>"/>
                </div>

                <div class="input-wrapper">
                    <label for="txtTelefone">Telefone:</label>
                    <input type="text" id="txtTelefone" name="telefone" 
                        maxlength="13" placeholder="Informe o telefone"
                        value="<?php echo isset($dados['usuario']) ? $dados['usuario']->getTelefone() : '';?>"/>
                </div>

                <div class="input-wrapper">
                    <label for="dateNascimento">Data de Nascimento:</label>
                    <input type="date" id="dateNascimento" name="data_nascimento" 
                        value="<?php echo isset($dados['usuario']) ? $dados['usuario']->getDataNascimento() : '';?>"/>
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
