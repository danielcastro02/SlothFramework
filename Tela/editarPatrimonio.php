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
        include_once '../Controle/patrimonioPDO.php';
        $Patrimonio = new patrimonioPDO();
            $stmt = $Patrimonio->selectPatrimonioPat($_GET['id']);
                $nomeNormal = new Patrimonio($stmt->fetch());
        ?>
        <main>
            <div class="row" style="margin-top: 10vh;">
                <form action="../Controle/patrimonioControle.php?function=editar" class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
                    <div class="row center">
                        <h4 class="textoCorPadrao2">Editar Patrimonio</h4>
                        <div class="input-field col s6" hidden>
                            <input type="text" name="pat" value="<?= $nomeNormal->getPat() ?>">
                            <label>pat</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="nome" value="<?= $nomeNormal->getNome() ?>">
                            <label>nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="id_desc" value="<?= $nomeNormal->getId_desc() ?>">
                            <label>id_desc</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="localizacao" value="<?= $nomeNormal->getLocalizacao() ?>">
                            <label>localizacao</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="estado" value="<?= $nomeNormal->getEstado() ?>">
                            <label>estado</label>
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

