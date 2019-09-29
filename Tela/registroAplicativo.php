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
                <form action="../Controle/aplicativoControle.php?function=inserirAplicativo" enctype="multipart/form-data" class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
                    <div class="row center">
                        <h4 class="textoCorPadrao2">Cadastrar Aplicativo</h4>
                        <div class="input-field col s6">
                            <input type="text" name="cliente">
                            <label>cliente</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="nome_pacote">
                            <label>nome_pacote</label>
                        </div>
                        <div class="input-field col s6">
                            Chave
                            <input type="file" name="chave">
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="dominio">
                            <label>dominio</label>
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
    </body>
</html>

