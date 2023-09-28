<?php
include_once(__DIR__ . "/../include/header.php");
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