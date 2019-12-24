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
?>
<?php
include_once '../Controle/projetoPDO.php';
include_once '../Controle/versaoPDO.php';
include_once '../Modelo/Projeto.php';
include_once '../Modelo/Versao.php';
$projetoPDO = new ProjetoPDO();
$versaoPDO = new VersaoPDO();
$stmt = $projetoPDO->selectId_projeto($_GET['id_projeto']);
$projeto = new Projeto($stmt->fetch());
?>
<main>
    <div class="row" style="margin-top: 3vh;">
        <div class="col s12 l1 offset-l1">
            <div class="row card center">
                <h5><?php $projeto->getNomeProjeto() ?></h5>
                <p><?php $projeto->getDescricaoProjeto() ?></p>
                <div class="row">
                    <p>Versões</p>
                    <div class="col s12">
                        <table>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Nível</th>
                                <th>Download</th>
                            </tr>
                            <?php
                            $stmtVersao = $versaoPDO->selectId_projeto($projeto->getIdProjeto());
                            if ($stmtVersao) {
                                while ($linha = $stmtVersao->fetch()) {
                                    $versao = new Versao($linha);
                                    ?><?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>

