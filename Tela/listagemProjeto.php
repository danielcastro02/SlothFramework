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

?>
<main>
    <div class="row center">
        <h5>Projetos</h5>
    </div>
    <div class="row">
        <div class="col s12 l10 offset-l1">
            <table>
                <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Detalhes</th>
                <th>Editar</th>
                </tr>
                <?php
                $projetoPDO = new ProjetoPDO();
                $stmt = $projetoPDO->selectAll();
                if ($stmt->rowCount() > 0) {
                    while ($linha = $stmt->fetch()) {
                        $projeto = new Projeto($linha);
                        ?>
                        <tr>
                            <td><?php echo $projeto->getNomeProjeto() ?></td>
                            <td><?php echo $projeto->getDescricaoProjeto() ?></td>
                            <td><a class="btn corPadrao2" href="./detalheProjeto.php?id_projeto=<?php echo $projeto->getIdProjeto() ?>">Detalhes</a></td>
                            <td><a class="btn corPadrao2" href="./editarProjeto.php?id_projeto=<?php echo $projeto->getIdProjeto() ?>">Editar</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</main>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>

