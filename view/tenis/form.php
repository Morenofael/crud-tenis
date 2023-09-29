<?php
include_once(__DIR__ . "/../../controller/EsporteController.php");
include_once(__DIR__ . "/../../controller/MarcaController.php");
include_once(__DIR__ . "/../include/header.php");

$esporteCont = new EsporteController();
$esportes = $esporteCont->listar();
$marcaCont = new MarcaController();
$marcas = $marcaCont->listar();
print_r($esportes);
?>
<h2><?php echo (!$aluno || $aluno->getId() <= 0 ? 'Inserir' : 'Alterar') ?> Aluno</h2>

<form id="frmTenis" method="POST">
    <label for="txtNome">Nome: </label><br>
    <input type="text" name="nome" id="txtNome"><br>

    <label for="selEsporte">Esporte: </label><br>
    <select name="esporte" id="selEsporte">
        <option value="">Selecione</option>
        <?php foreach($esportes as $esporte): ?>
            <!-- TODO terminar formulario -->
        <?php endforeach;?>
    </select>
</form>