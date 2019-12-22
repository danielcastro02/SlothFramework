<?php
include_once '../Base/requerLogin.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php
    include_once '../Base/header.php';
    ?>
<body class="homeimg">
<?php
include_once '../Base/navBar.php';
include_once '../Controle/projetoPDO.php';
include_once '../Modelo/Projeto.php';
$projetoPDO = new ProjetoPDO();
$projeto = $projetoPDO->selectId_projeto($_GET['id_projeto']);
?>
<main>
    <div class="row" style="margin-top: 10vh;">
        <form action="../Controle/projetoControle.php?function=editar" class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
            <div class="row center">
                <h4 class="textoCorPadrao2">Cadastrar Projeto</h4>
                <div class="input-field col s6">
                    <input type="text" name="nome_projeto" id="nome_projeto" value="<?php echo $projeto->getNomeProjeto() ?>">
                    <input type="text" name="id_projeto" value="<?php echo $projeto->getIdProjeto() ?>" hidden>
                    <label for="nome_projeto">Nome do projeto</label>
                </div>
                <div class="input-field col s6">
                    <textarea type="text" name="descricao_projeto" id="descricao_projeto" class="materialize-textarea"  value="<?php echo $projeto->getDescricaoProjeto() ?>"></textarea>
                    <label for="descricao_projeto">Descrição</label>
                </div>
                <div class="row center">
                    <a href="../index.php" class="corPadrao3 btn">Voltar</a>
                    <input type="submit" class="btn corPadrao2" value="Confirmar">
                </div>
            </div>
        </form>
    </div>
</main>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>

