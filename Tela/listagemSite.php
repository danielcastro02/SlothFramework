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
include_once '../Controle/sitePDO.php';
include_once '../Controle/clientePDO.php';
include_once '../Controle/versaoPDO.php';
include_once '../Modelo/Projeto.php';
include_once '../Modelo/Cliente.php';
include_once '../Modelo/Versao.php';
include_once '../Modelo/Site.php';

?>
<main>
    <div class="row center">
        <h5>Sites</h5>
    </div>
    <div class="row">
        <div class="col s12 l10 offset-l1">
            <table>
                <tr>
                    <th>Domínio</th>
                    <th>Cliente</th>
                    <th>Projeto</th>
                    <th>Versão</th>
                    <th>Detalhes</th>
                    <th>Editar</th>
                </tr>
                <?php
                $sitePDO = new SitePDO();
                $projetoPDO = new ProjetoPDO();
                $clientePDO = new ClientePDO();
                $versaoPDO = new VersaoPDO();
                $stmt = $sitePDO->selectSite();
                if ($stmt->rowCount() > 0) {
                    while ($linha = $stmt->fetch()) {
                        $site = new Site($linha);
                        $versao = $versaoPDO->selectId_versao($site->getIdVersao());
                        $versao = new Versao($versao->fetch());
                        $projeto = $projetoPDO->selectId_projeto($versao->getIdProjeto());
                        $projeto = new Projeto($projeto->fetch());
                        $cliente = $clientePDO->selectClienteId_cliente($site->getIdCliente());
                        $cliente = new Cliente($cliente->fetch());
                        ?>
                        <tr>
                            <td><?php echo $site->getDominio() ?></td>
                            <td><?php echo $cliente->getNomeCliente() ?></td>
                            <td><?php echo $projeto->getNomeProjeto() ?></td>
                            <td><?php echo $versao->getNomeVersao() ?></td>
                            <td><a class="btn corPadrao2" href="./detalheSite.php?id_site=<?php echo $site->getIdSite() ?>">Detalhes</a></td>
                            <td><a class="btn corPadrao2" href="./editarSite.php?id_site=<?php echo $site->getIdSite() ?>">Editar</a></td>
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

