<?php
include_once '../Base/requerLogin.php';
include_once '../Controle/clientePDO.php';
include_once '../Controle/projetoPDO.php';
include_once '../Modelo/Cliente.php';
include_once '../Modelo/Projeto.php';
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
<main>
    <div class="row" style="margin-top: 10vh;">
        <form action="../Controle/siteControle.php?function=inserirSite" enctype="multipart/form-data"
              class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
            <div class="row center">
                <h4 class="textoCorPadrao2">Cadastrar site</h4>
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
                                echo "<option value='".$cliente->getIdCliente()."'>".$cliente->getNomeCliente()."</option>";
                            }
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
                                echo "<option value='".$projeto->getIdProjeto()."'>".$projeto->getNomeProjeto()."</option>";
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
                    <input type="text" name="dominio" id="dominio">
                    <label for="dominio">Dominio (sem https:// ou qualquer /)</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="nomeDb" id="nomeDb">
                    <label for="nomeDb">Banco de dados:</label>
                </div>
                <div class="row center">
                    <a href="../index.php" class="corPadrao3 btn">Voltar</a>
                    <input type="submit" class="btn corPadrao2" value="Cadastrar">
                </div>
            </div>
        </form>
    </div>
</main>
<script>
    $("#id_projeto").change(function () {
        $("#id_versao").load("../Tela/loadSelectVersao.php?id_projeto="+$("#id_projeto").val(), function () {
            $('select').formSelect();
        });
    });
    $('select').formSelect();
</script>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>

