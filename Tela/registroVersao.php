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
<main>
    <div class="row" style="margin-top: 10vh;">
        <form action="../Controle/versaoControle.php?function=inserir" enctype="multipart/form-data"
              class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
            <div class="row center">
                <h4 class="textoCorPadrao2">Cadastrar Versão</h4>
                <div class="input-field col s4">
                    <select name="id_projeto" id="id_projeto">
                        <?php
                        include_once __DIR__ . "/../Controle/projetoPDO.php";
                        include_once __DIR__ . "/../Modelo/Projeto.php";
                        $projetoPDO = new ProjetoPDO();
                        $stmt = $projetoPDO->selectAll();
                        if ($stmt->rowCount() > 0) {
                            while ($linha = $stmt->fetch()) {
                                $projeto = new Projeto($linha);
                                echo "<option value='" . $projeto->getIdProjeto() . "'>" . $projeto->getNomeProjeto() . "</option>";
                            }
                        } else {
                            echo "<option value='0' disabled selected>Nenhum projeto</option>";
                        }
                        ?>
                    </select>
                    <label for="id_projeto">Projeto</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" name="nome_versao" id="nome_versao">
                    <label for="nome_versao">Nome</label>
                </div>
                <div class="input-field col s4">
                    <select name="nivel" id="nivel">
                        <option value="0">Teste</option>
                        <option value="1">Produção</option>
                        <option value="2" selected>Correção</option>
                    </select>
                    <label for="nivel">Nível da versão</label>
                </div>
                <div class="input-field col s4">
                    <select name="id_anterior" id="id_anterior">

                    </select>
                    <label for="id_anterior">Versão anterior</label>
                </div>
                <div class="input-field col s12">
                    <textarea type="text" name="descricao_versao" id="descricao_versao"
                              class="materialize-textarea"></textarea>
                    <label for="descricao_versao">Descrição</label>
                </div>

                <div class="file-field col s12 input-field">
                    <div class="btn">
                        <span>Zip da versão</span>
                        <input type="file" name="arquivo">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="file-field col s12 input-field">
                    <div class="btn">
                        <span>Update SQL</span>
                        <input type="file" name="sql">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="file-field col s12 input-field">
                    <div class="btn">
                        <span>Full SQL</span>
                        <input type="file" name="full_sql">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="row center">
                    <a href="../index.php" class="corPadrao3 btn">Voltar</a>
                    <input type="submit" class="btn corPadrao2" value="Cadastrar">
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#id_projeto").change(function () {
            $("#id_anterior").load("../Tela/loadVersaoAnterior.php?id_projeto=" + $("#id_projeto").val(), function () {
                $('select').formSelect();
            });
        });

        $("select").formSelect();
    </script>
</main>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>

