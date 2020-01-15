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
include_once '../Controle/sitePDO.php';
include_once '../Controle/versaoPDO.php';
include_once '../Controle/projetoPDO.php';
include_once '../Controle/clientePDO.php';
include_once '../Modelo/Site.php';
include_once '../Modelo/Cliente.php';
include_once '../Modelo/Projeto.php';
include_once '../Modelo/Versao.php';
$projetoPDO = new ProjetoPDO();
$sitePDO = new SitePDO();
$versaoPDO = new VersaoPDO();
$clientePDO = new ClientePDO();
$stmt = $sitePDO->selectSiteIdSite($_GET['id_site']);
$site = new Site($stmt->fetch());
$versao = $versaoPDO->selectId_versao($site->getIdVersao());
$versao = new Versao($versao->fetch());
$projeto = $projetoPDO->selectId_projeto($versao->getIdProjeto());
$projeto = new Projeto($projeto->fetch());
$cliente = $clientePDO->selectClienteId_cliente($site->getIdCliente());
$cliente = new Cliente($cliente->fetch());
?>
<main>
    <div class="row" style="margin-top: 3vh;">
        <div class="col s12 l10 offset-l1">
            <div class="row card center">
                <h5><?php echo $site->getDominio() ?></h5>
                <p>Projeto: <?php echo $projeto->getNomeProjeto(); ?> Versão: <?php echo $versao->getNomeVersao(); ?></p>
                <h5>Cliente: <?php echo $cliente->getNomeCliente(); ?></h5>
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

