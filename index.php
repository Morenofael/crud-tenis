<?php
include_once(__DIR__ . "/view/include/header.php");
?>

<div class="row mt-3 justify-content-center">
    <div class="col-3">
        <div class="card text-center">
            <img class="card-image-top mx-auto" src="img/giannis.jpg" 
                style="max-width: 200px; height: auto;" />
            <div class="card-body">
                <h5 class="card-title">Tenis</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="<?= BASE_URL ?>/view/tenis/listar.php" 
                        class="card-link">
                        Listagem de Tenis</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
include_once(__DIR__ . "/view/include/footer.php");
?>