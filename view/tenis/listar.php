<?php 
//Página view para listagem de alunos
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/TenisController.php");

$tenisCont = new TenisController();
$tenis = $tenisCont->listar();
?>

<?php 
require(__DIR__ . "/../include/header.php");
?>

<h4>Listagem de tenis</h4>

<div>
    <a href="inserir.php" class="btn btn-success">Inserir</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preco</th>
            <th>Marca</th>
            <th>Sexo</th>
            <th>Esporte</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tenis as $t): ?>
            <tr>
                <td><?= $t->getNome(); ?></td>
                <td>R$<?= $t->getPreco(); ?></td>
                <td><?= $t->getMarca(); ?></td>
                <td><?= $t->getSexoTexto(); ?></td>
                <td><?= $t->getEsporte(); ?></td>
                <td><a href="alterar.php?idTenis=<?= $t->getId() ?>"> 
                        Editar 
                    </a>
                </td>
                <td><a href="excluir.php?idTenis=<?= $t->getId() ?>"
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