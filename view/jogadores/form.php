<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once(__DIR__ . "/../../controller/ClubeController.php");
include_once(__DIR__ . "/../../controller/EsporteController.php");
include_once(__DIR__ . "/../include/header.php");

$clubeCont = new ClubeController();
$clubes = $clubeCont->listar();
$esporteCont = new EsporteController();
$esportes = $esporteCont->listar();
?>
<h2><?php echo (!$clube || $clube->getId() <= 0 ? 'Inserir' : 'Alterar') ?> Clubes</h2>
<div class="row">
<div class="col-6">

<form id="frmClubes" method="POST">
    <div class="form-group">
    <label for="txtNome" class="form-label">Nome: </label><br>
    <input type="text" class="form-control col-" name="nome" id="txtNome" value="<?php echo $jogador ? $jogador->getNome() : ""?>"><br>
    </div>

    <div class="form-group">
    <label for="selEsporte" class="form-label">Esporte: </label><br>
	<select name="esporte" class="form-control" id="selEsporte">
        <option value="">Selecione</option>
        <?php foreach($esportes as $esporte): ?>
                        <option value="<?= $esporte->getId(); ?>"
                            <?php
                                if($esporte &&
                                    $esporte->getId() == $esporte->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $esporte->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
    </select><br>
   
  </div>
	</div>
    <div class="col-6">
    <div class="form-group">
    <label for="selClube" class="form-label">Clube: </label><br>
    <select name="clube" class="form-control" id="selClube">
        <option value="">Selecione</option>
        <?php foreach($clubes as $clube): ?>
                        <option value="<?= $clube->getId(); ?>"
                            <?php 
                                if($clube && $clube->getEsporte() && 
                                    $clube->getEsporte()->getId() == $clube->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $clube->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
    </select><br>
    </div>

    <div class="form-group">
    <label for="aplFoto" class="form-label">Foto: </label><br>
	 <input type="file" class="form-control" 
                    id="uplFoto" name="foto"
                    accept="image/*" />	   
    </div>
	<?php if($jogador && $jogador->getImgFoto()): ?>
                <div class="mb-3">
                    <img src="<?= URL_ARQUIVOS . "/" . $jogador->getImgFoto() ?>"
                        style="height: 80px; width: auto;">
                </div>
            <?php endif; ?>
            <input type="hidden" name="fotoAntiga"
                value="<?php echo ($jogador ? $jogador->getImgFoto() : ""); ?>">

    </div>
    <input type="hidden" name="id" 
                value="<?php echo ($jogador ? $jogador->getId() : 0); ?>" />
            
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
