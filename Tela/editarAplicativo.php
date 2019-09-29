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
        include_once '../Controle/aplicativoPDO.php';
        $Aplicativo = new aplicativoPDO();
            $stmt = $Aplicativo->selectAplicativoId_aplicativo($_GET['id']);
                $nomeNormal = new Aplicativo($stmt->fetch());
        ?>
        <main>
            <div class="row" style="margin-top: 10vh;">
                <form action="../Controle/aplicativoControle.php?function=editar" class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
                    <div class="row center">
                        <h4 class="textoCorPadrao2">Editar Aplicativo</h4>
                        <div class="input-field col s6" hidden>
                            <input type="text" name="id_aplicativo" value="<?= $nomeNormal->getId_aplicativo() ?>">
                            <label>id_aplicativo</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="cliente" value="<?= $nomeNormal->getCliente() ?>">
                            <label>cliente</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="nome_pacote" value="<?= $nomeNormal->getNome_pacote() ?>">
                            <label>nome_pacote</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="chave" value="<?= $nomeNormal->getChave() ?>">
                            <label>chave</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="dominio" value="<?= $nomeNormal->getDominio() ?>">
                            <label>dominio</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="arquivo_firebase" value="<?= $nomeNormal->getArquivo_firebase() ?>">
                            <label>arquivo_firebase</label>
                        </div>
                    <div class="row center">
                        <a href="../index.php" class="corPadrao3 btn">Voltar</a>
                        <input type="submit" class="btn corPadrao2" value="Alterar">
                    </div>
                </form>
            </div>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    </body>
</html>

