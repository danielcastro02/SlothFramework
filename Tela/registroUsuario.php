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
        <form action="../Controle/usuarioControle.php?function=inserirUsuário" class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
            <div class="row center">
                <h4 class="textoCorPadrao2">Cadastrar Usuário</h4>
                <div class="input-field col s6">
                    <input type="text" name="nome" id="nome">
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="usuario" id="usuario">
                    <label for="usuario">Usuário</label>
                </div>
                <div class="input-field col s6">
                    <input type="password" name="senha1" id="senha1">
                    <label for="senha1">Senha</label>
                </div>
                <div class="input-field col s6">
                    <input type="password" name="senha2" id="senha2">
                    <label for="senha2">Repita a senha</label>
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

