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
                <form action="../Controle/patrimonioControle.php?function=inserirPatrimonio" class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
                    <div class="row center">
                        <h4 class="textoCorPadrao2">Cadastrar Patrimonio</h4>
                        <div class="input-field col s6">
                            <input type="text" name="nome">
                            <label>nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="id_desc">
                            <label>id_desc</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="localizacao">
                            <label>localizacao</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="estado">
                            <label>estado</label>
                        </div>
                    <div class="row center">
                        <a href="../index.php" class="corPadrao3 btn">Voltar</a>
                        <input type="submit" class="btn corPadrao2" value="Cadastrar">
                    </div>
                </form>
            </div>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    </body>
</html>

