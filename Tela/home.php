<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        include_once '../Base/header.php';
        ?>
    </head>
    <body>
        <?php
        include_once '../Base/navPadrao.php';
        ?><main>
            <main>
                <div class="row" style="margin-top: 15vh;">
                    <form action="../Controle/usuarioControle.php?function=login" class="card col l6 offset-l3 m8 offset-m2 s10 offset-s1" method="post">
                        <div class="row center">
                            <h4 class="textoCorPadrao2">Faça Login</h4>
                            <div class="input-field col s10 offset-s1">
                                <input type="text" name="usuario">
                                <label>Usuario</label>
                            </div>
                            <div class="input-field col s10 offset-s1">
                                <input type="password" name="senha">
                                <label>Senha</label>
                            </div>
                        </div>
                        <div class="row center">
                            <a href="../index.php" class="corPadrao3 btn">Voltar</a>
                            <input type="submit" class="btn corPadrao2" value="Login">
                            <div class='row'>
                                <?php
                                if (isset($_GET['msg'])) {
                                    if ($_GET['msg'] == "erro") {
                                        echo "LOGIN OU SENHA INCORRETOS!";
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </form>
                </div>
            </main>
        </main>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    </body>
</html>
