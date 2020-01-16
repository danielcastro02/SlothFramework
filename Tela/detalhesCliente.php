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
        include_once '../Controle/clientePDO.php';
        include_once '../Controle/sitePDO.php';
        include_once '../Controle/aplicativoPDO.php';
        include_once '../Controle/versaoPDO.php';
        include_once '../Controle/projetoPDO.php';
        include_once '../Modelo/Cliente.php';
        include_once '../Modelo/Site.php';
        include_once '../Modelo/Aplicativo.php';
        include_once '../Modelo/Versao.php';
        include_once '../Modelo/Projeto.php';

        $clientePDO = new ClientePDO();
        $sitePDO = new SitePDO();
        $aplicativoPDO = new AplicativoPDO();
        $versaoPDO = new VersaoPDO();
        $projetoPDO = new ProjetoPDO();

        $cliente = new Cliente($clientePDO->selectClienteId_cliente($_GET['id_cliente'])->fetch());
    ?>
<body class="homeimg">
<?php
    include_once '../Base/navBar.php';
?>
<main>
    <div class="row" style="margin-top: 10vh;">
        <div class="card col s10 offset-s1">
            <h5 class="center">Detalhes do cliente <?php echo $cliente->getNomeCliente() ?></h5>
            <div class="horizontal-divider"></div>
            <div class="row">
                <div class="col s6">
                    <h5 class="center">Site</h5>
                    <?php
                        $stmtSite = $sitePDO->selectSiteIdCliente($cliente->getIdCliente());
                        if($stmtSite){
                            $site = new Site($stmtSite->fetch());
                            $versao = new Versao($versaoPDO->selectId_versao($site->getIdVersao())->fetch());
                            $projeto = new Projeto($projetoPDO->selectId_projeto($versao->getIdProjeto())->fetch());
                            ?>
                            <div class="collection">
                                <a href="#!" class="collection-item"><span class="badge"><?php echo $site->getDominio() != '' ? $site->getDominio() : '-' ?></span>Dominio</a>
                                <a href="#!" class="collection-item"><span class="badge"><?php echo $projeto->getNomeProjeto() != '' ? $projeto->getNomeProjeto() : '-'?></span>Projeto</a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <h6 class="center">Nenhum site para esse cliente</h6>
                            <?php
                        }
                    ?>
                </div>
                <div class="left-divider"></div>
                <div class="col s6">
                    <h5 class="center">Aplicativo</h5>
                    <?php
                        $stmtaplicativo = $aplicativoPDO->selectAplicativoCliente($cliente->getIdCliente());
                        if($stmtaplicativo) {
                            $aplicativo = new Aplicativo($stmtaplicativo->fetch());
                            $site = new Site($sitePDO->selectSiteIdSite($aplicativo->getIdSite())->fetch());
                            $versao = new Versao($versaoPDO->selectId_versao($aplicativo->getIdVersao())->fetch());
                            $projeto = new Projeto($projetoPDO->selectId_projeto($versao->getIdProjeto())->fetch());
                            ?>
                            <div class="collection">
                                <a href="#!" class="collection-item"><span class="badge"><?php echo $site->getDominio() != '' ? $site->getDominio() : '-' ?></span>Dominio</a>
                                <a href="#!" class="collection-item"><span class="badge"><?php echo $projeto->getNomeProjeto() != '' ? $projeto->getNomeProjeto() : '-' ?></span>Projeto</a>
                                <a href="#!" class="collection-item"><span class="badge"><?php echo $versao->getNomeVersao() != '' ? $versao->getNomeVersao() : '-' ?></span>Versão</a>
                                <a href="#!" class="collection-item"><span class="badge"><?php echo $aplicativo->getNomePacote() != '' ? $aplicativo->getNomePacote() : '-' ?></span>Pacote</a>
                            </div>
                            <?php
                        } else {
                            ?>
                                <h6 class="center">Nenhum aplicativo para esse cliente</h6>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="row center">
                <a href="listagemCliente.php" class="btn corPadrao3">Voltar</a>
            </div>
        </div>
    </div>
</main>
<?php
    include_once '../Base/footer.php';
?>
</body>
</html>

