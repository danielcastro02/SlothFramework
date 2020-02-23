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
$nextVersions = $versaoPDO->selectNextVersions($projeto->getIdProjeto() , $versao->getIdVersao());
?>
<main>
    <div class="row" style="margin-top: 3vh;">
        <div class="col s12 l10 offset-l1">
            <div class="row card center">
                <h4>Domínio <?php echo $site->getDominio() ?></h4>
                <h5>Cliente: <?php echo $cliente->getNomeCliente(); ?></h5>
                <h5>Projeto: <?php echo $projeto->getNomeProjeto(); ?>
                    Versão: <?php echo $versao->getNomeVersao(); ?></h5>
            </div>
            <h5>Atualizar</h5>
            <form action="../Controle/siteControle.php?function=atualizar&id_site=<?php echo $_GET['id_site']; ?>" method="post">
                <select name="id_versao" id="id_versao">
                    <option selected disabled value="0">Selecione</option>
                    <?php
                        if($nextVersions){
                            while($linha = $nextVersions->fetch()){
                                $vers = new Versao($linha);
                                echo "<option value='".$vers->getIdVersao()."'>".$vers->getNomeVersao()." / ".$vers->getTextNivel()."</option>";
                            }
                        }
                    ?>
                </select>
                <input type="submit" value="Atualizar" class="btn corPadrao2"/>
                <input hidden name="versao_anterior" value="<?php echo $site->getIdVersao()?>">
            </form>
            <div class="row center">
                <a id='excluir' class="btn red darken-3"
                   href="../Controle/siteControle.php?function=excluir&id_site=<?php echo $_GET['id_site'] ?>">Excluir</a>
            </div>
        </div>
    </div>
    <script>
        $("#excluir").click(function () {
            if (confirm("Você tem certeza do que está fazendo??")) {
                return confirm("Esta ação só é recomendada em caso de erro, ainda assim encorajamos que edite o projeto ao invés de excluilo!\n" +
                    "Clique em cancelar para ir para a tela de edição!");
            } else {
                return false;
            }
        });
        $("select").formSelect();
    </script>
</main>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>

