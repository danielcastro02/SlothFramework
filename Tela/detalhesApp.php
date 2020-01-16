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

        $aplicativo = new Aplicativo($aplicativoPDO->selectAplicativoId_aplicativo($_GET['id_app'])->fetch());
    ?>
<body class="homeimg">
<?php
    include_once '../Base/navBar.php';
?>
<main>
    <div class="row" style="margin-top: 10vh;">
        <div class="card col s8 offset-s2">
            <h5 class="center">Detalhes do aplicativo <?php echo $aplicativo->getNomePacote() ?></h5>
            <div class="horizontal-divider"></div>
            <div class="row">
                <div class="col s8 offset-s2">
                    <?php
                    $site = new Site($sitePDO->selectSiteIdSite($aplicativo->getIdSite())->fetch());
                    $versao = new Versao($versaoPDO->selectId_versao($aplicativo->getIdVersao())->fetch());
                    $projeto = new Projeto($projetoPDO->selectId_projeto($versao->getIdProjeto())->fetch());
                    $cliente = new Cliente($clientePDO->selectClienteId_cliente($aplicativo->getIdCliente())->fetch());
                    ?>
                    <div class="collection">
                        <a href="#!" class="collection-item"><span class="badge"><?php echo $site->getDominio() != '' ? $site->getDominio() : '-' ?></span>Dominio</a>
                        <a href="#!" class="collection-item"><span class="badge"><?php echo $projeto->getNomeProjeto() != '' ? $projeto->getNomeProjeto() : '-' ?></span>Projeto</a>
                        <a href="#!" class="collection-item"><span class="badge"><?php echo $cliente->getNomeCliente() != '' ? $cliente->getNomeCliente() : '-' ?></span>Projeto</a>
                        <a href="#!" class="collection-item"><span class="badge"><?php echo $versao->getNomeVersao() != '' ? $versao->getNomeVersao() : '-' ?></span>Versão</a>
                        <a href="#!" class="collection-item"><span class="badge"><?php echo $aplicativo->getNomePacote() != '' ? $aplicativo->getNomePacote() : '-' ?></span>Pacote</a>
                    </div>
                </div>
            </div>
            <div class="row center">
                <a href="listagemAplicativo.php" class="btn corPadrao3">Voltar</a>
            </div>
        </div>
    </div>
</main>
<?php
    include_once '../Base/footer.php';
?>
</body>
</html>

