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
include_once '../Controle/versaoPDO.php';
include_once '../Modelo/Versao.php';
$versaoPDO = new VersaoPDO();
$stmtVersao = $versaoPDO->selectId_versao($_GET['id_versao']);
$versao = new Versao($stmtVersao->fetch());
?>
<main>
    <div class="row" style="margin-top: 10vh;">
        <form action="../Controle/versaoControle.php?function=editar" enctype="multipart/form-data"
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
                                echo "<option value='" . $projeto->getIdProjeto() . "'".($projeto->getIdProjeto()==$versao->getIdVersao()?"selected":"").">" . $projeto->getNomeProjeto() . "</option>";
                            }
                        } else {
                            echo "<option value='0' disabled selected>Nenhum projeto</option>";
                        }
                        ?>
                    </select>
                    <label for="id_projeto">Projeto</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" name="nome_versao" id="nome_versao" value="<?php echo $versao->getNomeVersao()?>">
                    <input type="text" name="id_versao" value="<?php echo $versao->getIdVersao() ?>" hidden>
                    <label for="nome_versao">Nome</label>
                </div>
                <div class="input-field col s4">
                    <select name="nivel" id="nivel">
                        <option value="0" <?php echo ($versao->getNivel()==0?"selected":"") ?>>Teste</option>
                        <option value="1" <?php echo ($versao->getNivel()==1?"selected":"") ?>Produção</option>
                        <option value="2" <?php echo ($versao->getNivel()==2?"selected":"") ?>Correção</option>
                    </select>
                    <label for="nivel">Nível da versão</label>
                </div>
                <div class="input-field col s12">
                    <textarea type="text" name="descricao_versao" id="descricao_versao"
                              class="materialize-textarea"><?php echo $versao->getDescricaoVersao() ?></textarea>
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
    <div class="row center">
        <a id="excluir" href="../Controle/versaoControle.php?fnction=excluir&id_versao=<?php echo $versao->getIdVersao() ?>" class="btn red darken-3">Excluir</a>
    </div>
    <script>
        $("select").formSelect();
        $("#excluir").click(function () {
            if(confirm("Você tem certeza do que está fazendo??")){
                return confirm("Esta ação só é recomendada em caso de erro, ainda assim encorajamos que edite a versão ao invés de excluilo!\n" +
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

