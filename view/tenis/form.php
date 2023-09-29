<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once(__DIR__ . "/../../controller/EsporteController.php");
include_once(__DIR__ . "/../../controller/MarcaController.php");
include_once(__DIR__ . "/../include/header.php");

$esporteCont = new EsporteController();
$esportes = $esporteCont->listar();
$marcaCont = new MarcaController();
$marcas = $marcaCont->listar();
?>
<h2><?php echo (!$aluno || $aluno->getId() <= 0 ? 'Inserir' : 'Alterar') ?> Tenis</h2>

<form id="frmTenis" method="POST">
    <label for="txtNome">Nome: </label><br>
    <input type="text" name="nome" id="txtNome"><br>

    <label for="selTamanho">Tamanho: </label><br>
    <select name="tamanho" id="selTamanho">
        <?php
            for($i = 1; $i<50; $i++){
                echo "<option value='" . $i . "'>" . $i . "</option>";
            }
        ?>
    </select><br>

    <label for="txtPreco">Pre,co: </label><br>
    <input type="number" name="preco" id="txtPreco"><br>
    
    <label for="selMarca">Marca: </label><br>
    <select name="marca" id="selMarca">
        <option value="">Selecione</option>
        <?php foreach($marcas as $marca): ?>
                        <option value="<?= $marca->getId(); ?>"
                            <?php 
                                if($tenis && $tenis->getMarca() && 
                                    $tenis->getMarca()->getId() == $tenis->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $marca->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
    </select><br>
    
    <label for="selSexo">Sexo: </label><br>
    <select name="sexo" id="selSexo">
        <option value="">Selecione</option>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
    </select><br>

    <label for="selEsporte">Esporte: </label><br>
    <select name="esporte" id="selEsporte">
        <option value="">Selecione</option>
        <?php foreach($esportes as $esporte): ?>
                        <option value="<?= $esporte->getId(); ?>"
                            <?php 
                                if($tenis && $tenis->getEsporte() && 
                                    $tenis->getEsporte()->getId() == $tenis->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $esporte->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
    </select><br>

    <input type="hidden" name="id" 
                value="<?php echo ($tenis ? $tenis->getId() : 0); ?>" />
            
            <input type="hidden" name="submetido" value="1" />

            <button type="submit">Gravar</button>
            <button type="reset">Limpar</button>
</form>
<?php require_once(__DIR__ . "/../include/footer.php")?>