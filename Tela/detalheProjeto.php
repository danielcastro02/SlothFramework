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
        <div class="col s12 l10 offset-l1">
            <div class="row card center">
                <h5><?php echo $projeto->getNomeProjeto() ?></h5>
                <p><?php echo $projeto->getDescricaoProjeto() ?></p>
                <div class="row">
                    <p>Versões</p>
                    <div class="col s12">
                        <table>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Nível</th>
                                <th>Download</th>
                                <th>Editar</th>
                            </tr>
                            <?php
                            $stmtVersao = $versaoPDO->selectId_projeto($projeto->getIdProjeto());
                            if ($stmtVersao) {
                                while ($linha = $stmtVersao->fetch()) {
                                    $versao = new Versao($linha);
                                    ?>
                                    <tr>
                                        <td><?php echo $versao->getNomeVersao(); ?></td>
                                        <td><?php echo $versao->getDescricaoVersao(); ?></td>
                                        <td><?php echo $versao->getTextNivel(); ?></td>
                                        <td><a href="<?php echo '..'.VersaoPDO::REPO_PATH.$versao->getZipFile(); ?>" download>Download</a></td>
                                        <td><a href="<?php echo './editarVersao.php?id_versao='.$versao->getIdVersao(); ?>">Editar</a></td>
                                    </tr><?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row center">
                <a id='excluir' class="btn red darken-3" href="../Controle/projetoPDO.php?function=excluir&id_projeto=<?php echo $projeto->getIdProjeto() ?>">Excluir</a>
            </div>
        </div>
    </div>
    <script>
        $("#excluir").click(function () {
            if(confirm("Você tem certeza do que está fazendo??")){
                return confirm("Esta ação só é recomendada em caso de erro, ainda assim encorajamos que edite o projeto ao invés de excluilo!\n" +
                    "Clique em cancelar para ir para a tela de edição!");
            }else{
                return false;
            }
        });
    </script>
</main>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>

