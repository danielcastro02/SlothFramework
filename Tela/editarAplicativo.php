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
        include_once '../Controle/projetoPDO.php';
        include_once '../Controle/sitePDO.php';
        include_once '../Controle/versaoPDO.php';
        include_once '../Modelo/Cliente.php';
        include_once '../Modelo/Site.php';
        include_once '../Modelo/Projeto.php';
        include_once '../Modelo/Versao.php';
        ?>
    <body class="homeimg">
        <?php
        include_once '../Base/navBar.php';
        ?>
        <?php
        include_once '../Controle/aplicativoPDO.php';
        $Aplicativo = new aplicativoPDO();
            $stmt = $Aplicativo->selectAplicativoId_aplicativo($_GET['id']);
                $aplicativo = new Aplicativo($stmt->fetch());
        ?>
        <main>
            <div class="row" style="margin-top: 10vh;">
                <form action="../Controle/aplicativoControle.php?function=editar" enctype="multipart/form-data"
                      class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
                    <input value="<?php echo $_GET['id'] ?>" name="id_aplicativo" hidden/>
                    <div class="row center">
                        <h4 class="textoCorPadrao2">Cadastrar Aplicativo</h4>
                        <div class="input-field col s6">
                            <?php
                                $clientePDO = new ClientePDO();
                                $stmtCliente = $clientePDO->selectCliente();
                            ?>
                            <select id="id_cliente" name="id_cliente">
                                <?php
                                    if($stmtCliente){
                                        while($linha = $stmtCliente->fetch()) {
                                            $cliente = new Cliente($linha);
                                            ?>
                                            <option value='<?php echo $cliente->getIdCliente() ?>' <?php echo $cliente->getIdCliente() == $aplicativo->getIdCliente() ? "seleceted" : "" ?>><?php echo $cliente->getNomeCliente() ?></option>";
                                            <?php
                                        }
                                    }else{
                                        echo "<option value='0'>Nenhum Cliente</option>";
                                    }

                                ?>
                            </select>
                            <label for="id_cliente">Cliente</label>
                        </div>
                        <div class="input-field col s6">
                            <?php
                                $projetoPDO = new ProjetoPDO();
                                $stmtProjeto = $projetoPDO->selectAll();
                            ?>
                            <select id="id_projeto" name="id_projeto">
                                <option value="0" selected disabled>Selecione</option>
                                <?php
                                    if($stmtProjeto){
                                        while($linha = $stmtProjeto->fetch()) {
                                            $projeto = new Projeto($linha);
                                            $versaoPDO = new VersaoPDO();
                                            $versao = new Versao($versaoPDO->selectId_versao($aplicativo->getIdVersao())->fetch());
                                            ?>
                                            <option value='<?php echo $projeto->getIdProjeto() ?>' <?php echo $projeto->getIdProjeto() == $versao->getIdProjeto() ? "selected" : "" ?>><?php echo $projeto->getNomeProjeto() ?></option>";
                                <?php
                                        }
                                    }else{
                                        echo "<option value='0'>Nenhum Projeto</option>";
                                    }
                                ?>
                            </select>

                            <label for="id_projeto">Projeto</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="id_versao" name="id_versao">
                            </select>

                            <label for="id_versao">Versão</label>
                        </div>
                        <div class="input-field col s6">
                            <?php
                                $sitePDO = new SitePDO();
                                $stmtSite = $sitePDO->selectSite();
                            ?>
                            <select id="id_site" name="id_site">
                                <option value="0" selected disabled>Selecione</option>
                                <?php
                                    if($stmtSite){
                                        while($linha = $stmtSite->fetch()) {
                                            $site = new Site($linha);
                                            ?>
                                            <option value='<?php echo $site->getIdSite() ?>'<?php echo $site->getIdSite() == $aplicativo->getIdSite() ? "selected" : "" ?>><?php echo $site->getDominio() ?></option>";
                                <?php
                                        }
                                    }else{
                                        echo "<option value='0'>Nenhum Site</option>";
                                    }
                                ?>
                            </select>

                            <label for="id_site">Site</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="nome_pacote" id="nome_pacote" value="<?php echo $aplicativo->getNomePacote() ?>">
                            <label for="nome_pacote">Nome do Pacote</label>
                        </div>
                        <div class="input-field col s6">
                            Chave
                            <input type="file" name="chave">
                        </div>
                        <div class="input-field col s6">
                            Fire Base
                            <input type="file" name="arquivo_firebase">
                        </div>
                        <div class="row center">
                            <a href="../index.php" class="corPadrao3 btn">Voltar</a>
                            <input type="submit" class="btn corPadrao2" value="Cadastrar">
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    <script>
        $(document).ready(function(){
            $("#id_versao").load("../Tela/loadSelectVersao.php?id_projeto="+$("#id_projeto").val(), function () {
                $('select').formSelect();
            });
        });
        $('select').formSelect();
    </script>
    </body>
</html>

