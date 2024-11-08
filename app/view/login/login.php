<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>
<!-- TODO perguntar para o professor se não é melhor não usar o BASEURL-->
<link rel="stylesheet" href="<?=BASEURL?>/public/css/form.css" media="all">
<link rel="stylesheet" href="<?=BASEURL?>/public/css/login.css" media="all">

<section class="main">
<h4>LOGIN</h4>
    <div class="form-container">
                <!-- Formulário de login -->
                <form id="frmLogin" action="./LoginController.php?action=logon" method="POST" >
                    <div class="input-wrapper">
                        <label for="txtLogin">Email:</label>
                        <input type="text" class="" name="login" id="txtLogin"
                            placeholder="Email"
                            value="<?php echo isset($dados['login']) ? $dados['login'] : '' ?>" />        
                    </div>

                    <div class="input-wrapper">
                        <label for="txtSenha">Senha:</label>
                        <input type="password" class="" name="senha" id="txtSenha"
                            maxlength="15" placeholder="Senha"
                            value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />        
                    </div>

                    <button type="submit" class="">Logar</button>
                </form>
                <div class="form-link-wrapper">
                    <a href="#">Esqueceu sua senha?</a>
                    <a href="/app/controller/UsuarioController.php?action=create" class="">Cadastre-se</a>
                </div>

        <div class="col-12">
            <?php include_once(__DIR__ . "/../include/msg.php") ?>
        </div>
    </div>
</section>
<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
