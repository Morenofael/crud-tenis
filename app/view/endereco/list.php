<?php
#Nome do arquivo: endereco/list.php
#Objetivo: interface para listagem de endereços do usuário

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">Seus endereços</h3>

<div class="container">
    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="tabEnderecos" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CEP</th>
                        <th>Número</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['lista'] as $en): ?>
                        <tr>
                            <td><?php echo $en->getId(); ?></td>
                            <td><?= $en->getCep(); ?></td>
                            <td><?= $en->getNumero(); ?></td>
                            <td><a class="btn btn-primary" 
                                href="<?= BASEURL ?>/controller/EnderecoController.php?action=edit&id=<?= $en->getId() ?>">
                                Alterar</a> 
                            </td>
                            <td><a class="btn btn-danger" 
                                onclick="return confirm('Confirma a exclusão do endereço?');"
                                href="<?= BASEURL ?>/controller/EnderecoController.php?action=delete&id=<?= $en->getId() ?>">
                                Excluir</a> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
