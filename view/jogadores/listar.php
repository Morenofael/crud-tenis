<?php 
//Página view para listagem de alunos
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/JogadorController.php");

$jogadorCont = new JogadorController();
$jogadores = $jogadorCont->listar();
?>

<?php 
require(__DIR__ . "/../include/header.php");
?>

<h4>Listagem de jogadores</h4>

<div>
    <a href="inserir.php" class="btn btn-success">Inserir</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
			<th>Imagem</th>
            <th>Nome</th>
            <th>Clube</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($jogadores as $j): ?>
            <tr>
				<td>
                    <?php if($j->getImgFoto()): ?>
                        <img src="<?= URL_ARQUIVOS . "/" . $j->getImgFoto() ?>"
                            style="height: 80px; width: auto;">
                    <?php endif; ?>
                </td>
                <td><?= $j->getNome(); ?></td>
                <td><?= $j->getClube()->getAbrev(); ?></td>
                <td><a href="alterar.php?idJogador=<?= $j->getId() ?>"> 
                        Editar 
                    </a>
                </td>
                <td><a href="excluir.php?idJogador=<?= $j->getId() ?>"
                       onclick="return confirm('Confirma a exclusão?');" > 
                        Excluir 
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php 
require(__DIR__ . "/../include/footer.php");
?>
