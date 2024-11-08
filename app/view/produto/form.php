<?php
#Nome do arquivo: produto/form.php
#Objetivo: interface para inserir produtos no sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
    <link rel="stylesheet" href="<?=BASEURL?>/public/css/form.css" media="all">

<section class="main">
    <h3 class="text-center">
        <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?> 
        Produto
    </h3>
    
    <div class="row" style="margin-top: 10px;">
        
        <div class="form-container">
            <form id="frmProduto" method="POST" enctype='multipart/form-data'
                action="<?= BASEURL ?>/controller/ProdutoController.php?action=save" >
                <div class="input-wrapper">
                    <label for="txtNome">Nome:</label>
                    <input type="text" id="txtNome" name="nome" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php echo (isset($dados["produto"]) ? $dados["produto"]->getNome() : ''); ?>" />
                </div>
                
                <div class="input-wrapper">
                    <label for="txtDescricao">Descrição:</label>
                    <textarea type="text" id="txtDescricao" name="descricao"
                        maxlength="1000" placeholder="Descreva o produto" rows="15"
                        ><?php echo (isset($dados["produto"]) ? $dados["produto"]->getDescricao() : ''); ?></textarea>
                </div>

                <div class="input-wrapper">
                    <label for="numPreco">Preco:</label>
                    <input type="number" id="numPreco" name="preco" step="0.01" 
                        max="999999" placeholder="Informe o preço"
                        value="<?php echo (isset($dados["produto"]) ? $dados["produto"]->getPreco() : ''); ?>"/>
                </div>

                <div class="input-wrapper">
                    <label for="selGenero">Gênero:</label>
                    <select type="number" id="numPreco" name="genero"
                        placeholder="Informe o gênero"
                        value="<?php echo (isset($dados["produto"]) ? $dados["produto"]->getGenero() : ''); ?>"/>
                    <option value="m">Masculino</option>
                    <option value="f">Feminino</option>
                    <option value="u">Unissex</option>
                    <option value="i">Infantil</option>
                    </select>
                </div>
                
                <div class="input-wrapper">
					          <label for="uplImagem">Selecione o arquivo:</label>
					          <input type="file" name="imagem[]" id="uplImagem" 
					          accept="image/*" required multiple />
                </div>

                <div class="input-wrapper">
                    <label for="txtTags">Escreva as palavras-chave do produto, separada por espaços</label>
                    <input type="text" name="tags" id="txtTags" placeholder="Insira as palavras-chave"
                        value="<?php echo (isset($dados["produto"]) ? $dados["produto"]->getTags() : ''); ?>"/>
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
                href="<?= BASEURL ?>/controller/HomeController.php?action=home">Voltar</a>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
