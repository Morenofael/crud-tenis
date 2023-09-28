include_once(__DIR__ . "/../include/header.php");
<h2><?php echo (!$aluno || $aluno->getId() <= 0 ? 'Inserir' : 'Alterar') ?> Aluno</h2>

<form id="frmTenis" method="post"></form>