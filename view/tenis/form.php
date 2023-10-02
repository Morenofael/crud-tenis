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
<h2><?php echo (!$tenis || $tenis->getId() <= 0 ? 'Inserir' : 'Alterar') ?> Tenis</h2>
<div class="row">
<div class="col-6">

<form id="frmTenis" method="POST">
    <div class="form-group">
    <label for="txtNome" class="form-label">Nome: </label><br>
    <input type="text" class="form-control col-" name="nome" id="txtNome" value="<?php echo $tenis ? $tenis->getNome() : ""?>"><br>
    </div>

    <div class="form-group">
    <label for="txtPreco" class="form-label">Pre,co: </label><br>
    <input type="number" class="form-control" name="preco" id="txtPreco" value="<?php echo $tenis ? $tenis->getPreco() : ""?>"><br>
    </div>
</div>
    <div class="col-6">
    <div class="form-group">
    <label for="selMarca" class="form-label">Marca: </label><br>
    <select name="marca" class="form-control" id="selMarca">
        <option value="">Selecione</option>
        <?php foreach($marcas as $marca): ?>
                        <option value="<?= $marca->getId(); ?>"
                            <?php 
                                if($tenis && $tenis->getMarca() && 
                                    $tenis->getMarca()->getId() == $marca->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $marca->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
    </select><br>
    </div>

    <div class="form-group">
    <label for="selSexo" class="form-label">Sexo: </label><br>
    <select name="sexo" class="form-control" id="selSexo">
        <option value="">Selecione</option>
        <option value="M"
        <?php 
            if($tenis && $tenis->getSexo() && 
            $tenis->getSexo() == "M")
            echo 'selected';
                            ?>
        >Masculino</option>
        <option value="F"
        <?php 
            if($tenis && $tenis->getSexo() && 
            $tenis->getSexo() == "F")
            echo 'selected';
                            ?>
        >Feminino</option>
        <option value="U"
        <?php 
            if($tenis && $tenis->getSexo() && 
            $tenis->getSexo() == "U")
            echo 'selected';
                            ?>>Unisex</option>
    </select><br>
    </div>

    <div class="form-group">
    <label for="selEsporte" class="form-label">Esporte: </label><br>
    <select name="esporte" class="form-control" id="selEsporte">
        <option value="">Selecione</option>
        <?php foreach($esportes as $esporte): ?>
                        <option value="<?= $esporte->getId(); ?>"
                            <?php 
                                if($tenis && $tenis->getEsporte() && 
                                    $tenis->getEsporte()->getId() == $esporte->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $esporte->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
    </select><br>
    </div>
    </div>
    <input type="hidden" name="id" 
                value="<?php echo ($tenis ? $tenis->getId() : 0); ?>" />
            
            <input type="hidden" name="submetido" value="1" />

            <button type="submit" class="btn btn-success col-2 m-4">Gravar</button>
            <button type="reset" class="btn btn-danger col-2 m-4">Limpar</button>
</form>
</div>
<?php if($msgErro): ?>
            <div class="alert alert-danger">
                <?php echo $msgErro; ?>
            </div>
        <?php endif; ?> 
<?php require_once(__DIR__ . "/../include/footer.php")?>